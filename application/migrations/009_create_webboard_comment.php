<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_webboard_comment extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 5,
        'unsigned' => TRUE,
        'auto_increment' =>TRUE
      ),
      'webboard_id' => array(
        'type' => 'INT',
        'constraint' => '5',
        'unsigned' => TRUE
      ),
      'commented_by' => array(
        'type' => 'INT',
        'constraint' => '5',
        'unsigned' => TRUE
      ),
      'detail' => array(
        'type' => 'TEXT',
        'null' => TRUE
      ),
      'date_create' => array(
        'type' => 'VARCHAR',
        'constraint' => '19'
      ),
      'date_modify' => array(
        'type' => 'VARCHAR',
        'constraint' => '19'
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('webboard_comment', TRUE, array('ENGINE' => 'InnoDB'));
  }

  public function down()
  {
    $this->dbforge->drop_table('webboard_comment');
  }

}
