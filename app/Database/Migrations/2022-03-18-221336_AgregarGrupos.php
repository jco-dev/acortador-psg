<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarGrupos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'descripcion' => [
                'type' => 'TEXT',
            ],
            'creado_el timestamp default current_timestamp',
            'actualizado_el' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'estado' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
                'null' => false,
                'default' => 'REGISTRADO',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('grupo');
    }

    public function down()
    {
        $this->forge->dropTable('grupo');
    }
}
