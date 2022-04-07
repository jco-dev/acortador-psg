<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarLink extends Migration
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
            'persona_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'responsable_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true,
            ],
            'tipo_link_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'url_corto' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => false,
                'unique' => true,
            ],
            'link' => [
                'type' => 'TEXT',
                'null' => false,
                'unique' => true,
            ],
            'redireccion_instantanea' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => true,
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
        $this->forge->addForeignKey('persona_id', 'persona', 'id', 'CASCADE', 'NULL');
        $this->forge->addForeignKey('tipo_link_id', 'tipo_link', 'id', 'CASCADE', 'NULL');
        $this->forge->addForeignKey('responsable_id', 'persona_externa', 'id', 'CASCADE', 'NULL');
        $this->forge->createTable('link');
    }

    public function down()
    {
        $this->forge->dropTable("link");
    }
}
