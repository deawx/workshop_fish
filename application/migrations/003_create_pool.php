<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_pool extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 5,
        'unsigned' => TRUE,
        'auto_increment' =>TRUE
      ),
      'shape' => array(
        'type' => 'VARCHAR',
        'constraint' => '100'
      ),
      'detail' => array(
        'type' => 'TEXT',
        'null' => FALSE
      ),
      'property' => array(
        'type' => 'TEXT',
        'null' => FALSE
      ),
      'describtion' => array(
        'type' => 'TEXT',
        'null' => FALSE
      ),
      'believe' => array(
        'type' => 'TEXT',
        'null' => FALSE
      ),
      'suggestion' => array(
        'type' => 'TEXT',
        'null' => FALSE
      ),
      'picture' => array(
        'type' => 'VARCHAR',
        'constraint' => '32'
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('pool', TRUE, array('ENGINE' => 'InnoDB'));
  }

  public function down()
  {
    $this->dbforge->drop_table('pool');
  }

}
