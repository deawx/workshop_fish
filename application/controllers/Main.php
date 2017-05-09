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
    $slideshows = $this->db->select('picture,fullname')->order_by('id','RANDOM')->get('fish','10')->result_array();
    foreach ($slideshows as $_s => $s) :
      $this->data['slideshow'][] = array('picture'=>img('assets/fish/'.$s['picture'],'',array('style'=>'width:100%;height:350px;')),'fullname'=>$s['fullname']);
    endforeach;
    $config	= array(
      'base_url' => uri_string(),
      'total_rows' => $this->db->count_all_results('fish'),
      'per_page' => '6'
    );
    $offset = ($this->input->get('p') > 0) ? $this->input->get('p') : '0';
    $this->pagination->initialize($config);
    $this->data['fish'] = $this->db->get('fish',$config['per_page'],$offset)->result_array();
    $this->data['pagination'] = $this->pagination->create_links();
    // $this->data['fish'] = $this->db->get('fish')->result_array();
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
