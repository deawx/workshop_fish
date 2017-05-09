<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_nature extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 5,
        'unsigned' => TRUE,
        'auto_increment' =>TRUE
      ),
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '100'
      ),
      'detail' => array(
        'type' => 'TEXT',
        'null' => FALSE
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('nature', TRUE, array('ENGINE' => 'InnoDB'));
  }

  public function down()
  {
    $this->dbforge->drop_table('nature');
  }

}
