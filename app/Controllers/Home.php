<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EstadisticaModel;
use App\Models\LinkModel;

class Home extends BaseController
{
    public function index($url_corto)
    {
        $linkm = new LinkModel();
        $link = $linkm->where('url_corto', $url_corto)->first();
        if ($link == NULL) {
            header("Location: https://cursosposgrado.upea.bo");
            exit();
        } else {
            $estadistica = new EstadisticaModel();
            $estadistica->save([
                'link_id' => $link['id'],
                'fecha' => date('Y-m-d H:i:s')
            ]);
            header("Location:" . $link['link']);
            exit();
        }
    }
}
