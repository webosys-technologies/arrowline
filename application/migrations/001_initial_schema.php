<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Initial_Schema extends CI_Migration {

    public function up() {

        $this->dbforge->add_field(array(

            'id' => array(
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ),

            'project_name' => array(
                'type' => 'varchar',
                'constraint' => 100,
            ),

            'description' => array(
                'type' => 'text'
            ),

            'date_created' => array(
                'type' => 'datetime',
            ),

            'date_updated' => array(
                'type' => 'datetime',
            ),

            'status' => array(
                'type' => 'tinyint',
                'default' => 1
            ),

        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('flx_project');

        $this->dbforge->add_field(array(
            'blog_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'blog_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'blog_description' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('blog_id', TRUE);
        $this->dbforge->create_table('blog');

    }

    public function down() {
        $this->dbforge->drop_table('flx_project');
        $this->dbforge->drop_table('blog');
    }


}

?>