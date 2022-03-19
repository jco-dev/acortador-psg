<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Link extends BaseController
{
    public $db;
    public function __construct()
    {
        $this->db = db_connect();
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
}
