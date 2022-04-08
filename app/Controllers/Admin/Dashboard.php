<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PersonaExternaModel;

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
        $responsable = new PersonaExternaModel();
        $this->data['responsable'] = $responsable->findAll();
        $this->data['cantidad_link'] = $this->link->countAll();
        $this->data['cantidad_persona'] = $this->persona->countAll();
        $this->data['cantidad_grupo'] = $this->grupo->countAll();

        return view('dashboard/index', $this->data);
    }

    public function reports()
    {
        $listado = $this->link->reports_links($this->request->getGet('id'));
        $table =   '<table class="table table-centered table-hover mb-0" id="datatable">
                        <thead>
                            <tr>
                                <th class="border-top-0">Responsable</th>
                                <th class="border-top-0">descripción</th>
                                <th class="border-top-0">url corto</th>
                                <th class="border-top-0">Creado el</th>
                                <th class="border-top-0">Total</th>
                            </tr>
                        </thead>
                    <tbody>';
        if (count($listado) > 0) {
            foreach ($listado as $value) {
                $table .=   '<tr>
                    <td>
                        <img src="' . base_url('greeva/assets/images/users/avatar-2.jpg') . '" alt="user-pic" class="rounded-circle avatar-sm bx-shadow-lg" />
                        <span class="ml-2">' . $value['responsable'] . '</span>
                    </td>
                    <td>
                        <span class="ml-2">' . $value['descripcion'] . '</span>
                    </td>
                    <td>' . $value['url_corto'] . '</td>
                    <td>' . $value['creado_el'] . '</td>
                    <td><span class="badge badge-pill badge-purple text-dark">' . $value['total'] . '</span></td>
                </tr>';
            }
        } else {
            $table .= '<tr>
                <td colspan="5">No hay registros</td>
            </tr>';
        }
        $table .= '</tbody>
                </table>';
        echo $table;
    }
}
