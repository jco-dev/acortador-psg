<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LinkModel;

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
            4 => "usuario",
            5 => "ul.creado_el",
        ];

        $sql_count = "SELECT COUNT(*) as total
            FROM us_link ul
            INNER JOIN us_persona up ON ul.persona_id = up.id";
        $sql_data = "SELECT ul.id,
                    ul.titulo,
                    ul.descripcion,
                    ul.url_corto,
                    concat_ws(' ', up.nombres, up.paterno, up.materno) AS usuario,
                    ul.creado_el,
                    ul.estado
            FROM us_link ul
            INNER JOIN us_persona up ON ul.persona_id = up.id";
        $condition = "";

        if (!empty($valor_buscado)) {
            foreach ($table_map as $key => $value) {
                if ($key === 0) {
                    $condition .= " WHERE ul." . $value . "::TEXT LIKE '%" . $valor_buscado . "%'";
                } elseif ($value == "usuario") {
                    $condition .= " OR CONCAT_WS(' ', up.nombres, up.paterno, up.materno) LIKE '%" . $valor_buscado . "%'";
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
        return view('link/new');
    }

    public function create()
    {
        $data = [
            'persona_id' => session()->id,
            'titulo' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('titulo'))), MB_CASE_UPPER),
            'descripcion' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('descripcion'))), MB_CASE_UPPER),
            'url_corto' => url_title(trim($this->request->getPost('url_corto')), '-', true),
            'link' => trim($this->request->getPost('link')),
        ];

        if (!$this->validate([
            'titulo'      => 'required|max_length[100]',
            'descripcion' => 'required|max_length[255]',
            'url_corto'   => 'required|max_length[100]|is_unique[link.url_corto]',
            'link'        => 'required|valid_url|is_unique[link.link]'
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
            $data = $this->model->find($id);
            return view('link/edit', ['data' => $data]);
        }

        return redirect()->to('/admin/link')->with('msg', [
            'type' => 'info',
            'body' => 'Registro no encontrado.',
        ]);
    }

    public function update($id = null)
    {
        if ($id != null && $this->model->where('id', $id)->first()) {
            $data = [
                'persona_id' => session()->id,
                'titulo' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('titulo'))), MB_CASE_UPPER),
                'descripcion' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('descripcion'))), MB_CASE_UPPER),
                'url_corto' => url_title(trim($this->request->getPost('url_corto')), '-', true),
                'link' => trim($this->request->getPost('link')),
            ];
            if (!$this->validate([
                'titulo'      => 'required|max_length[100]',
                'descripcion' => 'required|max_length[255]',
                'url_corto'   => 'required|max_length[100]|is_unique_edit[url_corto,' . $id . ']',
                'link'        => 'required|valid_url|is_unique_edit[link,' . $id . ']'
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
