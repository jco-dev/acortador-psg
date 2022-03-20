<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuario';
    protected $primaryKey       = 'persona_id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'persona_id',
        'usuario',
        'clave',
        'estado',
        'eliminado_el'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';
    protected $deletedField  = 'eliminado_el';

    // Functions
    public function getUserByEmail($email)
    {
        return $this->where('usuario', $email)->first();
    }

    public function getRoleId($id)
    {
        $builder = $this->db->table('grupo_usuario ug');
        $builder->select('g.nombre');
        $builder->join('grupo g', 'ug.grupo_id = g.id');
        $builder->where('ug.usuario_id', $id);
        $query = $builder->get();
        return $query->getResult();
    }
}
