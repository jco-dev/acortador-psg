<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarTipoLink extends Migration
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
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => false,
                'unique' => true,
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('tipo_link');
    }

    public function down()
    {
        $this->forge->dropTable('tipo_link');
    }
}
