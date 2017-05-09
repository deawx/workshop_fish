<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_member extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 5,
        'unsigned' => TRUE,
        'auto_increment' =>TRUE
      ),
      'title' => array(
        'type' => 'ENUM("นาย.","นาง.","นางสาว.")',
        'default' => 'นาย.'
      ),
      'fullname' => array(
        'type' => 'VARCHAR',
        'constraint' => '150'
      ),
      'birthdate' => array(
        'type' => 'VARCHAR',
        'constraint' => '10'
      ),
      'address' => array(
        'type' => 'TEXT',
        'null' => FALSE
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '50'
      ),
      'password' => array(
        'type' => 'VARCHAR',
        'constraint' => '32'
      ),
      'phone' => array(
        'type' => 'VARCHAR',
        'constraint' => '15'
      ),
      'date_create' => array(
        'type' => 'VARCHAR',
        'constraint' => '10'
      ),
      'date_activity' => array(
        'type' => 'VARCHAR',
        'constraint' => '19'
      ),
      'picture' => array(
        'type' => 'VARCHAR',
        'constraint' => '100'
      ),
      'role' => array(
        'type' => 'ENUM("admin","member")',
        'default' => 'member'
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('member', TRUE, array('ENGINE' => 'InnoDB'));
  }

  public function down()
  {
    $this->dbforge->drop_table('member');
  }

}
