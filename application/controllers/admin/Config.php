<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends Admin_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  function about()
  {
    $this->load->view('_layout_main', $this->data);
  }

}
