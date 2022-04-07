<?php

namespace App\Models;

use CodeIgniter\Model;

class SugerenciaReclamoModel extends Model
{
    protected $table            = 'sugerencia_reclamo';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'persona_externa_id',
        'link_id',
        'tipo',
        'descripcion',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';
    protected $deletedField  = 'eliminado_el';
}
