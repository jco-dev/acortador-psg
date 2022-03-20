<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;

class Grupo extends BaseController
{
    public $db;
    public $model;
    public function __construct()
    {
        $this->db = db_connect();
        $this->model = model('GrupoModel');
    }

    public function index()
    {
        return view('grupo/index');
    }

    public function datatable()
    {
        $valor_buscado = mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getGet('search')['value'])), MB_CASE_UPPER);
        $table_map = [
            0 => "id",
            1 => "nombre",
            2 => "descripcion",
            3 => "creado_el",
            4 => "estado",
        ];

        $sql_count = "SELECT COUNT(*) AS total
            FROM us_grupo ug";
        $sql_data = "SELECT * FROM us_grupo ug";
        $condition = "";

        if (!empty($valor_buscado)) {
            foreach ($table_map as $key => $value) {
                if ($key === 0) {
                    $condition .= " WHERE ug." . $value . "::TEXT LIKE '%" . $valor_buscado . "%'";
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

        $json_data = [
            'draw' => intval($this->request->getGet('draw')),
            'recordsTotal' => $total_count->total,
            'recordsFiltered' => $total_count->total,
            'data' => $data,
        ];
        echo json_encode($json_data);
    }
}
