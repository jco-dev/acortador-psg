<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarPersonaExterna extends Migration
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
                'null' => true,
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
            'apellidos' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'celular' => [
                'type' => 'INT',
                'constraint' => '10',
                'null' => true
            ],
            'correo' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => true,
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
        $this->forge->createTable('persona_externa');
    }

    public function down()
    {
        $this->forge->dropTable('persona_externa');
    }
}
