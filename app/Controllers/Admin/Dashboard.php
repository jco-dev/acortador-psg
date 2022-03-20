<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public $link;
    public $persona;
    public $grupo;
    public function __construct()
    {
        $this->link = model('LinkModel');
        $this->persona = model('PersonaModel');
        $this->grupo = model('GrupoModel');
    }

    public function index()
    {
        if (!session()->is_logged) {
            return redirect()->route('login');
        }

        $this->data['cantidad_link'] = $this->link->countAll();
        $this->data['cantidad_persona'] = $this->persona->countAll();
        $this->data['cantidad_grupo'] = $this->grupo->countAll();
        $this->data['listado'] = $this->link->reports_links();
        return view('dashboard/index', $this->data);
    }
}
