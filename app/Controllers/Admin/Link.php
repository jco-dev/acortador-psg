<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LinkModel;
use App\Models\PersonaExternaModel;
use App\Models\TipoLinkModel;

class Link extends BaseController
{
    public $db;
    public $model;
    public function __construct()
    {
        $this->db = db_connect();
        $this->model = new LinkModel();
    }

    public function index()
    {
        return view('link/index');
    }

    public function datatable()
    {
        $valor_buscado = mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getGet('search')['value'])), MB_CASE_UPPER);
        $table_map = [
            0 => "id",
            1 => "titulo",
            2 => "descripcion",
            3 => "url_corto",
            4 => "responsable",
            5 => "redireccion_instantanea",
            6 => "ul.creado_el",
        ];

        $sql_count = "SELECT COUNT(*) as total
            FROM us_link ul
            LEFT JOIN us_persona_externa upe ON ul.responsable_id = upe.id
            INNER JOIN us_tipo_link utl ON ul.tipo_link_id = utl.id";
        $sql_data = "SELECT ul.id,
                    utl.titulo,
                    ul.descripcion,
                    ul.url_corto,
                    concat_ws(' ', upe.nombres, upe.apellidos) AS responsable,
                    ul.redireccion_instantanea,
                    ul.creado_el,
                    ul.estado
            FROM us_link ul
            LEFT JOIN us_persona_externa upe ON ul.responsable_id = upe.id
            INNER JOIN us_tipo_link utl ON ul.tipo_link_id = utl.id";
        $condition = "";

        if (!empty($valor_buscado)) {
            foreach ($table_map as $key => $value) {
                if ($key === 0) {
                    $condition .= " WHERE ul." . $value . "::TEXT LIKE '%" . $valor_buscado . "%'";
                } elseif ($value == "responsable") {
                    $condition .= " OR CONCAT_WS(' ', upe.nombres, upe.apellidos) LIKE '%" . $valor_buscado . "%'";
                } else {
                    $condition .= " OR " . $value . "::TEXT LIKE '%" . $valor_buscado . "%'";
                }
            }
        }

        $sql_count = $sql_count . $condition;
        $sql_data = $sql_data . $condition;
        $total_count = $this->db->query($sql_count)->getRow();

        $sql_data .= " ORDER BY " . $table_map[$this->request->getGet('order')[0]['column']] . " " . $this->request->getGet('order')[0]['dir']
            . " LIMIT " . $this->request->getGet('length') . " OFFSET " . $this->request->getGet('start');
        $data = $this->db->query($sql_data)->getResult();

        // return var_dump($sql_count, $sql_data);
        $json_data = [
            'draw' => intval($this->request->getGet('draw')),
            'recordsTotal' => $total_count->total,
            'recordsFiltered' => $total_count->total,
            'data' => $data,
        ];
        echo json_encode($json_data);
    }

    public function new()
    {
        $tipoLink = new TipoLinkModel();
        $responsable = new PersonaExternaModel();
        $tipoLink = $tipoLink->findAll();
        $responsable = $responsable->findAll();
        return view('link/new', [
            'tipoLink' => $tipoLink,
            'responsable' => $responsable,
        ]);
    }

    public function create()
    {
        if ($this->request->getPost('redireccion_instantanea'))
            $r = true;
        else
            $r = false;

        $data = [
            'persona_id'              => session()->id,
            'responsable_id'          => $this->request->getPost('responsable_id'),
            'tipo_link_id'            => $this->request->getPost('tipo_link_id'),
            'descripcion'             => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('descripcion'))), MB_CASE_UPPER),
            'url_corto'               => url_title(trim($this->request->getPost('url_corto')), '-', true),
            'link'                    => trim($this->request->getPost('link')),
            'redireccion_instantanea' => $r
        ];

        if (!$this->validate([
            'tipo_link_id' => 'required',
            'descripcion'  => 'required|max_length[255]',
            'url_corto'    => 'required|max_length[100]|is_unique[link.url_corto]',
            'link'         => 'required|valid_url'
        ])) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        if ($this->model->insert($data)) {
            return redirect()->to('/admin/link')->with('msg', [
                'type' => 'success',
                'body' => 'Registro creado correctamente.',
            ]);
        }
    }

    public function edit($id = null)
    {
        if ($id != null) {
            $tipoLink = new TipoLinkModel();
            $tipoLink = $tipoLink->findAll();
            $data = $this->model->withDeleted()->find($id);
            $responsable = new PersonaExternaModel();
            $responsable = $responsable->findAll();
            return view('link/edit', ['data' => $data, 'tipoLink' => $tipoLink, 'responsable' => $responsable]);
        }

        return redirect()->to('/admin/link')->with('msg', [
            'type' => 'info',
            'body' => 'Registro no encontrado.',
        ]);
    }

    public function update($id = null)
    {
        if ($id != null && $this->model->withDeleted()->find($id)) {
            if ($this->request->getPost('redireccion_instantanea'))
                $r = true;
            else
                $r = false;

            $data = [
                'persona_id'              => session()->id,
                'responsable_id'          => $this->request->getPost('responsable_id'),
                'tipo_link_id'            => $this->request->getPost('tipo_link_id'),
                'descripcion'             => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('descripcion'))), MB_CASE_UPPER),
                'url_corto'               => url_title(trim($this->request->getPost('url_corto')), '-', true),
                'link'                    => trim($this->request->getPost('link')),
                'redireccion_instantanea' => $r
            ];
            if (!$this->validate([
                'tipo_link_id' => 'required',
                'descripcion'  => 'required|max_length[255]',
                'url_corto'    => 'required|max_length[100]|is_unique_edit[url_corto,' . $id . ']',
                'link'         => 'required|valid_url'
            ])) {
                return redirect()->back()
                    ->with('errors', $this->validator->getErrors())
                    ->withInput();
            }

            if ($this->model->update($id, $data)) {
                return redirect()->to('/admin/link')->with('msg', [
                    'type' => 'success',
                    'body' => 'Registro actualizado correctamente.',
                ]);
            }
        } else {
            return redirect()->to('/admin/link')->with('msg', [
                'type' => 'info',
                'body' => 'Registro no encontrado.',
            ]);
        }
    }

    public function delete($id = null)
    {
        if ($id == null) {
            return redirect()->to('/admin/link')->with('msg', [
                'type' => 'info',
                'body' => 'Registro no encontrado.',
            ]);
        }

        if ($this->model->delete($id) && $this->model->update($id, ['estado' => "ELIMINADO"])) {
            return $this->response->setJSON([
                'type' => 'success',
                'msg' => 'Registro eliminado correctamente.',
            ]);
        }
    }

    public function reports($id = null)
    {
        $data = $this->model->reports_all($id);
        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON([]);
        }
    }
}
