<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_compare extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => '5',
        'unsigned' => TRUE,
        'auto_increment' =>TRUE
      ),
      'member_id' => array(
        'type' => 'INT',
        'constraint' => '5',
        'unsigned' => TRUE
      ),
      'pool_title' => array(
        'type' => 'VARCHAR',
        'constraint' => '100'
      ),
      'pool_shape' => array(
        'type' => 'TEXT'
      ),
      'pool_detail' => array(
        'type' => 'TEXT'
      ),
      'pool_believe' => array(
        'type' => 'TEXT'
      ),
      'fish_amount' => array(
        'type' => 'INT',
        'constraint' => '5'
      ),
      'views' => array(
        'type' => 'INT',
        'constraint' => '5'
      ),
      'date_create' => array(
        'type' => 'VARCHAR',
        'constraint' => '10'
      ),
      'date_modify' => array(
        'type' => 'VARCHAR',
        'constraint' => '10'
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('compare', TRUE, array('ENGINE' => 'InnoDB'));
  }

  public function down()
  {
    $this->dbforge->drop_table('compare');
  }

}
