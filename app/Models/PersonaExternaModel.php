<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaExternaModel extends Model
{
    protected $table            = 'persona_externa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'ci',
        'expedido',
        'nombres',
        'apellidos',
        'celular',
        'correo',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';
    protected $deletedField  = 'eliminado_el';
}
