<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarEstadistica extends Migration
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
            'link_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'ip' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'navegador' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            "fecha" => [
                "type" => "DATETIME",
                "null" => false,
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
        $this->forge->addForeignKey('link_id', 'link', 'id', 'CASCADE', 'NULL');
        $this->forge->createTable('estadistica');
    }

    public function down()
    {
        $this->forge->dropTable("estadistica");
    }
}
