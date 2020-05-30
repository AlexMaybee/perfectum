<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CommentMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'comment_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'user_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'           => TRUE,
            ],
            'email'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'comment' => [
                'type'           => 'TEXT',
            ],
            'reply_to_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => TRUE,
            ],
            'date_create datetime default current_timestamp',
            'date_update datetime default null on update current_timestamp',
        ]);
        $this->forge->addKey('comment_id', TRUE);
        $this->forge->createTable('comment');
    }

    public function down()
    {
        $this->forge->dropTable('comment');
    }
}
