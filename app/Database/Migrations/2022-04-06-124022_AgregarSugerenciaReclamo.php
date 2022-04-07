<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarSugerenciaReclamo extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'persona_externa_id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => true,
                ],
                'link_id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => true,
                ],
                'tipo' => [
                    'type' => 'VARCHAR',
                    'constraint' => '25',
                    'null' => false,
                ],
                'descripcion' => [
                    'type' => 'TEXT',
                    'null' => false,
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
            ]
        );
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('persona_externa_id', 'persona_externa', 'id', 'CASCADE', 'NULL');
        $this->forge->addForeignKey('link_id', 'link', 'id', 'CASCADE', 'NULL');
        $this->forge->createTable('sugerencia_reclamo');
    }

    public function down()
    {
        $this->forge->dropTable('sugerencia_reclamo');
    }
}
