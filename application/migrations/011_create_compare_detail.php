<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_compare_detail extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => '5',
        'unsigned' => TRUE,
        'auto_increment' =>TRUE
      ),
      'compare_id' => array(
        'type' => 'INT',
        'constraint' => '5',
        'unsigned' => TRUE
      ),
      'fish_id' => array(
        'type' => 'INT',
        'constraint' => '5',
        'unsigned' => TRUE
      ),
      'amount' => array(
        'type' => 'VARCHAR',
        'constraint' => '3'
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('compare_detail', TRUE, array('ENGINE' => 'InnoDB'));
  }

  public function down()
  {
    $this->dbforge->drop_table('compare_detail');
  }

}
