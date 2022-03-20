<?php

namespace App\Models;

use CodeIgniter\Model;

class LinkModel extends Model
{
    protected $table            = 'link';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'persona_id',
        'titulo',
        'descripcion',
        'url_corto',
        'link',
        'estado'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';
    protected $deletedField  = 'eliminado_el';

    // Validation
    protected $validationRules = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;

    // Functions
    public function reports_all($id)
    {
        $builder = $this->db->table('estadistica ue');
        $builder->select("COUNT(*) AS total, TO_CHAR(ue.fecha, 'DD-MM-YYYY')  AS fecha");
        $builder->where('ue.link_id', $id);
        $builder->groupBy("TO_CHAR(ue.fecha, 'DD-MM-YYYY')");
        $builder->orderBy(1, 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
