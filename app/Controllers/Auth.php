<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Session\Session;

class Auth extends BaseController
{
    public $persona;
    public $usuario;
    public function __construct()
    {
        $this->persona = model('PersonaModel');
        $this->usuario = model('UsuarioModel');
    }
    public function index()
    {
        if (!session()->is_logged) {
            return view("auth/login");
        }
        return redirect()->route('dashboard');
    }

    public function recoverPassword()
    {
        return view("auth/recoverpassword");
    }

    public function signin()
    {
        if (!$this->validate([
            'correo' => 'required|valid_email',
            'clave' => 'required'
        ])) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $correo = trim($this->request->getVar('correo'));
        $clave = trim($this->request->getVar('clave'));
        $usuario = $this->usuario->getUserByEmail($correo);
        $persona = $this->persona->getPersonByEmail($correo);
        if (!$usuario && !$persona) {
            return redirect()->back()
                ->with('msg', [
                    'type' => 'danger',
                    'body' => 'El usuario no se encuentra registrado en el sistema.'
                ]);
        }

        if ($usuario['estado'] !== "ACTIVO") {
            return redirect()->back()
                ->with('msg', [
                    'type' => 'danger',
                    'body' => 'El usuario no se encuentra activo en el sistema.'
                ]);
        }

        if (!password_verify($clave, $usuario['clave'])) {
            return redirect()->back()
                ->with('msg', [
                    'type' => 'danger',
                    'body' => 'La contraseña no es correcta.'
                ]);
        }

        $rol = $this->usuario->getRoleId($usuario['persona_id']);
        if ($rol == null)
            $rol_user = 'admin';
        else
            $rol_user = $rol[0]->nombre;


        session()->set([
            'id' => $usuario['persona_id'],
            'nombres' => $persona['nombres'],
            'paterno' => $persona['paterno'],
            'materno' => $persona['materno'],
            'correo' => $persona['correo'],
            'usuario' => $usuario['usuario'],
            'rol' => $rol_user,
            'is_logged' => true
        ]);

        return redirect()->route('dashboard')->with('msg', [
            'type' => 'success',
            'body' => 'Bienvenido al sistema ' . $persona['nombres'] . ' ' . $persona['paterno'] . ' ' . $persona['materno'] . '.'
        ]);
    }

    public function signout()
    {
        session()->destroy();
        return redirect()->route('login');
    }
}
