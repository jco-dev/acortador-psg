<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarUsuarioGrupo extends Migration
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
            'usuario_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => TRUE
            ],
            'grupo_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => TRUE
            ],
            'fecha_inicio' => [
                'type' => 'DATE',
                'null' => false
            ],
            'fecha_fin' => [
                'type' => 'DATE',
                'null' => false
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
        $this->forge->addForeignKey('usuario_id', 'usuario', 'persona_id', 'CASCADE', 'NULL');
        $this->forge->addForeignKey('grupo_id', 'grupo', 'id', 'CASCADE', 'NULL');
        $this->forge->createTable('grupo_usuario');
    }

    public function down()
    {
        $this->forge->dropTable("grupo_usuario");
    }
}
