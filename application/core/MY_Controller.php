<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  public $data = array();

  public function __construct()
  {
    parent::__construct();
    $this->data['content'] = '';
  }

}

class Public_Controller extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    if ($this->session->is_login !== TRUE) :
      redirect('main');
    endif;
  }

}

class Admin_Controller extends Public_Controller {

  public function __construct()
  {
    parent::__construct();
    if ($this->session->role !== 'admin') :
      redirect('main');
    endif;
  }

}
