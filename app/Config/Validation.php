<?php

namespace Config;

use App\Validation\UniqueColumnEdit;
use App\Validation\UsuarioValidation;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        UniqueColumnEdit::class,
        UsuarioValidation::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
    public $consulta = [
        'tipo' => [
            'label' => 'tipo de consulta',
            'rules' => 'required',
            'errors' => [
                'required' => 'El campo es requerido',
            ],
        ],
        'sugerencia' => [
            'label' => 'sugerencia',
            'rules' => 'required|max_length[254]|regex_match[/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ¿?., \s]+$/]',
            'errors' => [
                'required' => 'El campo es requerido',
                'max_length' => 'El campo debe tener máximo {param} caracteres',
                'regex_match' => 'El campo debe tener un formato válido puede contener letras, números, puntos, comas, espacios y signos de interrogación',
            ],
        ],
        'celular' => [
            'label' => 'celular',
            'rules' => 'required|min_length[8]|max_length[8]|regex_match[/^(7|6)?[0-9]{7}$/]',
            'errors' => [
                'required' => 'El campo es requerido',
                'min_length' => 'El campo debe tener mínimo {param} caracteres',
                'max_length' => 'El campo debe tener máximo {param} caracteres',
                'regex_match' => 'El número de celular debe tener un formato válido puede contener 8 números y debe empezar por 6 o 7',
            ],

        ],
        'nombre' => [
            'label' => 'nombre',
            'rules' => 'required|max_length[50]|regex_match[/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/]',
            'errors' => [
                'required' => 'El campo es requerido',
                'max_length' => 'El campo debe tener máximo {param} caracteres',
                'regex_match' => 'El campo debe tener un formato válido puede contener letras',
            ],
        ],
        'apellidos' => [
            'label' => 'apellidos',
            'rules' => 'max_length[50]|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+|(^$)/]',
            'errors' => [
                'required' => 'El campo es requerido',
                'max_length' => 'El campo debe tener máximo {param} caracteres',
                'regex_match' => 'El campo debe tener un formato válido puede contener letras',
            ],
        ],
        'result' => [
            'label' => 'captcha',
            'rules' => 'required',
            'errors' => [
                'required' => 'El campo es requerido',

            ],
        ],
    ];
}
