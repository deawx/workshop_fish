<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

  protected $CI;

  function __construction()
  {
    parent::__construct();
    $this->CI &= get_instance();
  }

  function valid_date($day)
  {
    $month = $_POST['month'];
    $year = $_POST['year'];
    return isset($month,$day,$year) ? checkdate($month,$day,$year) : FALSE;
  }

  function is_sure($str, $field)
  {
    sscanf($field, '%[^.].%[^.]', $table, $field);
		return isset($this->CI->db)
			? ($this->CI->db->limit('1')->get_where($table, array($field => $str))->num_rows() === 1)
			: FALSE;
  }

}
