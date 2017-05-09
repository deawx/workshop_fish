<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_webboard extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 5,
        'unsigned' => TRUE,
        'auto_increment' =>TRUE
      ),
      'posted_by' => array(
        'type' => 'INT',
        'constraint' => '5',
        'unsigned' => TRUE
      ),
      'title' => array(
        'type' => 'VARCHAR',
        'constraint' => '100'
      ),
      'detail' => array(
        'type' => 'TEXT',
        'null' => TRUE
      ),
      'views' => array(
        'type' => 'INT',
        'constraint' => '5'
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
    $this->dbforge->create_table('webboard', TRUE, array('ENGINE' => 'InnoDB'));
  }

  public function down()
  {
    $this->dbforge->drop_table('webboard');
  }

}
