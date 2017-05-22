<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_contact extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => '5',
        'unsigned' => TRUE,
        'auto_increment' =>TRUE
      ),
      'address' => array(
        'type' => 'TEXT',
        'null' => TRUE
      ),
      'email' => array(
        'type' => 'TINYTEXT',
        'null' => TRUE
      ),
      'phone' => array(
        'type' => 'TINYTEXT',
        'null' => TRUE
      ),
      'lat' => array(
        'type' => 'TINYTEXT',
        'null' => TRUE
      ),
      'long' => array(
        'type' => 'TINYTEXT',
        'null' => TRUE
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('contact', TRUE, array('ENGINE' => 'InnoDB'));
  }

  public function down()
  {
    $this->dbforge->drop_table('contact');
  }

}
