<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_fish extends CI_Migration {

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
      'fullname' => array(
        'type' => 'VARCHAR',
        'constraint' => '150'
      ),
      'fullsize' => array(
        'type' => 'VARCHAR',
        'constraint' => '5'
      ),
      'fullage' => array(
        'type' => 'VARCHAR',
        'constraint' => '5'
      ),
      'picture' => array(
        'type' => 'VARCHAR',
        'constraint' => '32'
      ),
      'detail' => array(
        'type' => 'TEXT',
        'null' => FALSE
      ),
      'believe' => array(
        'type' => 'TEXT',
        'null' => FALSE
      ),
      'nature_id' => array(
        'type' => 'INT',
        'constraint' => '5',
        'unsigned' => TRUE
      ),
      'feed_id' => array(
        'type' => 'INT',
        'constraint' => '5',
        'unsigned' => TRUE
      ),
      'living_id' => array(
        'type' => 'INT',
        'constraint' => '5',
        'unsigned' => TRUE
      ),
      'container_id' => array(
        'type' => 'INT',
        'constraint' => '5',
        'unsigned' => TRUE
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
    $this->dbforge->create_table('fish', TRUE, array('ENGINE' => 'InnoDB'));
  }

  public function down()
  {
    $this->dbforge->drop_table('fish');
  }

}
