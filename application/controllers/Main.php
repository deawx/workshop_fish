<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $this->data['slideshow'] = array();
    $slideshows = $this->db->select('picture')->get('fish','5')->result_array();
    foreach ($slideshows as $_s => $s) :
      $this->data['slideshow'][] = array('picture'=>img('assets/fish/'.$s['picture'],'',array('style'=>'width:100%;height:350px;')),'caption'=>'text');
    endforeach;
    $this->data['fish'] = $this->db->get('fish')->result_array();
    $this->data['content'] = $this->load->view('main', $this->data, TRUE);
		$this->load->view('_layout_main', $this->data);
  }

  function about()
  {
    $this->data['about'] = '';
    $this->data['content'] = $this->load->view('about', $this->data['about'], TRUE);
    $this->load->view('_layout_main', $this->data);
  }

}
