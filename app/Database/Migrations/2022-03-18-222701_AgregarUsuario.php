<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarUsuario extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'persona_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => TRUE
            ],
            'usuario' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'clave' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
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

        $this->forge->addKey('persona_id', true);
        $this->forge->addForeignKey('persona_id', 'persona', 'id', 'CASCADE', 'NULL');
        $this->forge->createTable('usuario');
    }

    public function down()
    {
        $this->forge->dropTable("usuario");
    }
}
