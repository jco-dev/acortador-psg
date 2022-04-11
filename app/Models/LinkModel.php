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
        'responsable_id',
        'tipo_link_id',
        'descripcion',
        'url_corto',
        'link',
        'redireccion_instantanea',
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
        $builder->where('ue.estado', 'REGISTRADO');
        $builder->groupBy("TO_CHAR(ue.fecha, 'DD-MM-YYYY')");
        $builder->orderBy(2, 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function reports_links($id = null)
    {
        $builder = $this->db->table('link ul');
        $builder->select("concat_ws(' ', upe.nombres, upe.apellidos) AS responsable, ul.descripcion,ul.url_corto,ul.creado_el,count(ue.link_id)AS total");
        $builder->join('estadistica ue', 'ul.id = ue.link_id');
        $builder->join('persona_externa upe', 'upe.id = ul.responsable_id', 'left');
        if ($id != null)
            $builder->where('ul.responsable_id', $id);
        $builder->where('ue.estado', 'REGISTRADO');
        $builder->groupBy("ue.link_id,upe.nombres,upe.apellidos,ul.descripcion,ul.url_corto,ul.creado_el");
        $builder->orderBy(5, 'DESC');
        $builder->limit(20);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function edit($id)
    {
        $builder = $this->db->table('link ul');
        $builder->select("*");
        $builder->where('ul.id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
