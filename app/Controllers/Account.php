<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PersonaModel;
use App\Models\UsuarioModel;

class Account extends BaseController
{
    public $persona;
    public $usuario;
    public $session;
    public function __construct()
    {
        $this->persona = new PersonaModel();
        $this->usuario = new UsuarioModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data = $this->persona->where('id', $this->session->get('id'))->first();
        return view('usuario/account', ['data' => $data]);
    }

    public function changePassword()
    {
        // password verify
        $data = $this->usuario->where('persona_id', $this->session->get('id'))->first();

        $clave = $this->request->getVar('contraseñaActual');
        if (!password_verify($clave, $data['clave'])) {
            return redirect()->back()
                ->with('msg', [
                    'type' => 'danger',
                    'body' => 'La contraseña actual no coincide.'
                ]);
        }

        $clave = $this->request->getVar('contraseñaNueva');
        $clave2 = $this->request->getVar('repetirContraseña');
        if ($clave !== $clave2) {
            return redirect()->back()
                ->with('msg', [
                    'type' => 'danger',
                    'body' => 'Por favor repita la contraseña nueva.'
                ]);
        }

        $data = [
            'clave' => password_hash($clave, PASSWORD_DEFAULT)
        ];
        if ($this->usuario->update(['persona_id' => $this->session->get('id')], $data)) {
            return redirect()->back()
                ->with('msg', [
                    'type' => 'success',
                    'body' => 'La contraseña se actualizó correctamente.'
                ]);
        } else {
            return redirect()->back()
                ->with('msg', [
                    'type' => 'danger',
                    'body' => 'Ocurrió un error al actualizar la contraseña.'
                ]);
        }
    }
}
