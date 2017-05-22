<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends Admin_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->data['content'] = '';
  }

  function about()
  {
    $post = $this->input->post();
    if ($post) :
      $save = $this->db->update('contact', $post);
      if ($save !== FALSE) :
        $this->session->set_flashdata(array('class'=>'success','value'=>'บันทีกข้อมูลเสร็จสิ้น'));
        redirect('admin/config/about');
      endif;
    endif;

    $config = $this->db->get('contact')->row_array();
    $this->data['content'] = $this->load->view('config/about', $config, true);
    $this->load->view('_layout_main', $this->data);
  }

}
