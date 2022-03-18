<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarEstadistica extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'link_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            "fecha" => [
                "type" => "DATETIME",
                "null" => false,
            ],
            'creado_el timestamp default current_timestamp',
            'actualizado_el' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'estado' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
                'null' => false,
                'default' => 'REGISTERED',
            ],
        ]);
        $this->forge->addForeignKey('link_id', 'link', 'id', 'CASCADE', 'NULL');
        $this->forge->createTable('estadistica');
    }

    public function down()
    {
        $this->forge->dropTable("estadistica");
    }
}
