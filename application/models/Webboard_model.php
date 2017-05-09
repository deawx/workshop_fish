<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webboard_model extends MY_Model {

  public $table_name = 'webboard';

  function post($post)
  {
    return $this->save($post);
  }

  function post_comment($post)
  {
    return $this->db->insert('webboard_comment',$post);
  }

}
