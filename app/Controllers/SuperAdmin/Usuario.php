<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\PersonaModel;
use App\Models\UsuarioModel;
use App\Models\UsuarioGrupoModel;

class Usuario extends BaseController
{
    public $db;
    public $model;
    public $persona;
    public $grupoUsuario;
    public function __construct()
    {
        $this->db = db_connect();
        $this->model = new UsuarioModel();
        $this->persona = new PersonaModel();
        $this->grupoUsuario = new UsuarioGrupoModel();
    }

    public function index()
    {
        return view('usuario/index');
    }

    public function datatable()
    {
        $valor_buscado = mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getGet('search')['value'])), MB_CASE_UPPER);
        $table_map = [
            0 => "id",
            1 => "ci",
            2 => "usuario",
            3 => "celular",
            4 => "correo",
            5 => "up.creado_el",
            6 => "uu.estado",
        ];

        $sql_count = "SELECT COUNT(*) AS total
            FROM us_persona up
            INNER JOIN us_usuario uu ON up.id = uu.persona_id";
        $sql_data = "SELECT up.id,
                    concat_ws(' ', up.ci, up.expedido) AS ci,
                    concat_ws(' ', up.nombres, up.paterno, up.materno) AS usuario,
                    up.celular,
                    up.correo,
                    up.creado_el,
                    uu.estado
            FROM us_persona up
            INNER JOIN us_usuario uu ON up.id = uu.persona_id";
        $condition = "";

        if (!empty($valor_buscado)) {
            foreach ($table_map as $key => $value) {
                if ($key === 0) {
                    $condition .= " WHERE up." . $value . "::TEXT LIKE '%" . $valor_buscado . "%'";
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
        return view('usuario/new');
    }

    public function create()
    {
        $data = [
            'ci' => trim($this->request->getPost('ci')),
            'expedido' => trim($this->request->getPost('expedido')),
            'nombres' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('nombres'))), MB_CASE_UPPER),
            'paterno' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('paterno'))), MB_CASE_UPPER),
            'materno' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('materno'))), MB_CASE_UPPER),
            'celular' => url_title(trim($this->request->getPost('celular')), '-', true),
            'correo' => trim($this->request->getPost('correo')),
        ];

        if (!$this->validate([
            'ci' => 'required|min_length[5]|max_length[10]|is_unique[persona.ci]',
            'expedido' => 'required|min_length[2]|max_length[2]',
            'nombres' => 'required|min_length[3]|max_length[50]',
            'paterno' => 'required|max_length[50]',
            'materno' => 'max_length[50]',
            'celular' => 'required|min_length[8]|max_length[8]|is_unique[persona.celular]',
            'correo' => 'required|min_length[5]|max_length[50]|valid_email|is_unique[persona.correo]',
        ])) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        if ($this->persona->insert($data)) {
            $this->model->insert(
                [
                    'persona_id' => $this->persona->insertID,
                    'usuario' => trim($this->request->getPost('correo')),
                    'clave' => password_hash(trim($this->request->getPost('ci')), PASSWORD_DEFAULT),
                ]
            );

            $this->grupoUsuario->insert([
                'usuario_id'    => $this->persona->insertID,
                'grupo_id'      => 2,
                'fecha_inicio'  => date('Y-m-d'),
                'fecha_fin'  => date('Y-m-d'),
            ]);
            return redirect()->to('/superadmin/usuario')->with('msg', [
                'type' => 'success',
                'body' => 'Usuario registrado correctamente.',
            ]);
        }
    }

    public function edit($id = null)
    {
        if ($id != null) {
            $data = $this->persona->find($id);
            return view('usuario/edit', ['data' => $data]);
        }

        return redirect()->to('/superadmin/usuario')->with('msg', [
            'type' => 'info',
            'body' => 'Usuario no encontrado.',
        ]);
    }

    public function update($id = null)
    {
        if ($id != null && $this->persona->where('id', $id)->first()) {
            $data = [
                'ci' => trim($this->request->getPost('ci')),
                'expedido' => trim($this->request->getPost('expedido')),
                'nombres' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('nombres'))), MB_CASE_UPPER),
                'paterno' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('paterno'))), MB_CASE_UPPER),
                'materno' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('materno'))), MB_CASE_UPPER),
                'celular' => url_title(trim($this->request->getPost('celular')), '-', true),
                'correo' => trim($this->request->getPost('correo')),
            ];
            if (!$this->validate([
                'ci' => 'required|min_length[5]|max_length[10]|is_unique_persona[persona.ci,' . $id . ']',
                'expedido' => 'required|min_length[2]|max_length[2]',
                'nombres' => 'required|min_length[3]|max_length[50]',
                'paterno' => 'required|max_length[50]',
                'materno' => 'max_length[50]',
                'celular' => 'required|min_length[8]|max_length[8]|is_unique_persona[persona.celular,' . $id . ']',
                'correo' => 'required|min_length[5]|max_length[50]|valid_email|is_unique_persona[persona.correo,' . $id . ']',
            ])) {
                return redirect()->back()
                    ->with('errors', $this->validator->getErrors())
                    ->withInput();
            }

            if ($this->persona->update($id, $data)) {
                $this->model->update(
                    $id,
                    [
                        'usuario' => trim($this->request->getPost('correo')),
                        'clave' => password_hash(trim($this->request->getPost('ci')), PASSWORD_DEFAULT),
                    ]
                );
                return redirect()->to('/superadmin/usuario')->with('msg', [
                    'type' => 'success',
                    'body' => 'Usuario actualizado correctamente.',
                ]);
            }
        } else {
            return redirect()->to('/superadmin/usuario')->with('msg', [
                'type' => 'info',
                'body' => 'Usuario no encontrado.',
            ]);
        }
    }
    public function delete($id = null)
    {
        if ($id == null) {
            return redirect()->to('/superadmin/usuario')->with('msg', [
                'type' => 'info',
                'body' => 'Usuario no encontrado.',
            ]);
        }

        if ($this->model->delete($id) && $this->model->update($id, ['estado' => "ELIMINADO"])) {
            return $this->response->setJSON([
                'type' => 'success',
                'msg' => 'Usuario eliminado correctamente.',
            ]);
        }
    }

    public function active()
    {
        if ($this->request->getGet('id') == null) {
            return redirect()->to('/superadmin/usuario')->with('msg', [
                'type' => 'info',
                'body' => 'Usuario no encontrado.',
            ]);
        }

        if ($this->model->update(['persona_id' => $this->request->getGet('id')], ['estado' => "ACTIVO", 'eliminado_el' => null])) {
            return $this->response->setJSON([
                'type' => 'success',
                'msg' => 'Usuario activado correctamente.',
            ]);
        }
    }
}
