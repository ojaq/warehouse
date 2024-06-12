<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Item extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'itemid' => [
                'type' => 'CHAR',
                'constraint' => '10',
            ],
            'itemname' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'itemcatid' => [
                'type' => 'INT',
                'unsigned' => TRUE
            ],
            'itemunitid' => [
                'type' => 'INT',
                'unsigned' => TRUE
            ],
            'itemprice' => [
                'type' => 'DOUBLE',
            ],
            'itemimage' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'itemstock' => [
                'type' => 'INT',
                'constraint' => '100'
            ]
        ]);

        $this->forge->addPrimaryKey('itemid');
        $this->forge->addForeignKey('itemcatid', 'category', 'catid', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('itemunitid', 'unit', 'unitid', 'CASCADE', 'CASCADE');

        $this->forge->createTable('item');
    }

    public function down()
    {
        $this->forge->dropTable('item');
    }
}
