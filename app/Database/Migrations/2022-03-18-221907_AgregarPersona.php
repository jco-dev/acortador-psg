<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarPersona extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'ci' => [
                'type' => 'VARCHAR',
                'constraint' => '12',
                'null' => false,
                'unique' => true,
            ],
            'expedido' => [
                'type' => "VARCHAR",
                'constraint' => '5',
                'null' => true,
            ],
            'nombres' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'paterno' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'materno' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true
            ],
            'celular' => [
                'type' => 'INT',
                'constraint' => '10',
                'null' => false
            ],
            'correo' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => false,
                'unique' => true
            ],
            'creado_el timestamp default current_timestamp',
            'actualizado_el' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'eliminado_el' => [
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
        $this->forge->createTable('persona');
    }

    public function down()
    {
        $this->forge->dropTable('persona');
    }
}
