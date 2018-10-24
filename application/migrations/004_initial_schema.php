<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Initial_Schema4 extends CI_Migration {

    public function up() {

        $fields = array(
                'name' => array(
                        'name' => 'blog_name',
                        'type' => 'VARCHAR ',
                        'constraint' => 255 
                ),
        );
        $this->dbforge->modify_column('blog', $fields);

    }

    public function down() {
        $this->dbforge->drop_table('flx_project');
        $this->dbforge->drop_table('blog');
    }


}

?>