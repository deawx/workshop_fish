<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fish extends Admin_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Fish_model','fish');
    $this->data['content'] = '';
  }

  function index()
  {
    $this->table->set_heading(array('','ชื่อเต็ม','ขนาดตัวเต็มวัย','อายุเฉลี่ย',''));
    $tables = $this->fish->search()->result_array();
    foreach ($tables as $_t => $t) :
      $this->table->add_row(
        img('assets/fish/'.$t['picture'],'',array('style'=>'width:80px;height:80px;','class'=>'img-circle text-center')),
        $t['fullname'],
        $t['fullsize'],
        $t['fullage'],
        form_anchor_edit('admin/fish/fish/'.$t['id']).form_anchor_delete('admin/fish/delete/fish_'.$t['id'])
      );
    endforeach;
    $this->table->set_template(['table_open'=>'<table class="table table-bordered table-striped table-hover">']);
    $this->data['content'] = heading('รายการข้อมูลปลาสวยงาม','4').hr().br().$this->table->generate();
    $this->load->view('_layout_main',$this->data);
  }

  function fish($id='')
  {
    $post = $this->input->post();
    if ($post) :
      $save = $this->fish->fish_form($id,$post);
      if ($save !== FALSE) :
        $this->session->set_flashdata(array('class'=>'success','value'=>'เพิ่มข้อมูลเสร็จสิ้น'));
        redirect('admin/fish');
      endif;
    endif;

    $this->data['content'] = $this->fish->fish_form($id);
    $this->load->view('_layout_main', $this->data);
  }

  function nature($id='')
  {
    $post = $this->input->post();
    if ($post) :
      $save = $this->fish->fish_nature($id,$post);
      if ($save !== FALSE) :
        $this->session->set_flashdata(array('class'=>'success','value'=>'เพิ่มข้อมูลเสร็จสิ้น'));
        redirect('admin/fish/nature');
      endif;
    endif;

    $this->data['content'] = $this->fish->fish_nature($id);
    $this->table->set_heading(['#','ชื่อ','รายละเอียด','']);
    $tables = $this->db->get('nature')->result_array();
    foreach ($tables as $_t => $t) :
      $delete = ($t['id'] < 5) ? '' : form_anchor_delete('admin/fish/delete/nature_'.$t['id']);
      $this->table->add_row(
        ++$_t,
        $t['name'],
        $t['detail'],
        form_anchor_edit('admin/fish/nature/'.$t['id']).$delete
      );
    endforeach;
    $this->table->set_template(['table_open'=>'<table class="table table-bordered table-striped table-hover">']);
    $this->data['content'] .= heading('รายการข้อมูลอุปนิสัยโดยธรรมชาติ','4').hr().br().$this->table->generate();
    $this->load->view('_layout_main',$this->data);
  }

  function feed($id='')
  {
    $post = $this->input->post();
    if ($post) :
      $save = $this->fish->fish_feed($id,$post);
      if ($save !== FALSE) :
        $this->session->set_flashdata(array('class'=>'success','value'=>'เพิ่มข้อมูลเสร็จสิ้น'));
        redirect('admin/fish/feed');
      endif;
    endif;

    $this->data['content'] = $this->fish->fish_feed($id);
    $this->table->set_heading(['#','ชื่อ','รายละเอียด','']);
    $tables = $this->db->get('feed')->result_array();
    foreach ($tables as $_t => $t) :
      $delete = ($t['id'] < 5) ? '' : form_anchor_delete('admin/fish/delete/feed_'.$t['id']);
      $this->table->add_row(
        ++$_t,
        $t['name'],
        $t['detail'],
        form_anchor_edit('admin/fish/feed/'.$t['id']).$delete
      );
    endforeach;
    $this->table->set_template(['table_open'=>'<table class="table table-bordered table-striped table-hover">']);
    $this->data['content'] .= heading('รายการข้อมูลชนิดของอาหาร','4').hr().br().$this->table->generate();
    $this->load->view('_layout_main',$this->data);
  }

  function living($id='')
  {
    $post = $this->input->post();
    if ($post) :
      $save = $this->fish->fish_living($id,$post);
      if ($save !== FALSE) :
        $this->session->set_flashdata(array('class'=>'success','value'=>'เพิ่มข้อมูลเสร็จสิ้น'));
        redirect('admin/fish/living');
      endif;
    endif;

    $this->data['content'] = $this->fish->fish_living($id);
    $this->table->set_heading(['#','ชื่อ','รายละเอียด','']);
    $tables = $this->db->get('living')->result_array();
    foreach ($tables as $_t => $t) :
      $delete = ($t['id'] < 5) ? '' : form_anchor_delete('admin/fish/delete/living_'.$t['id']);
      $this->table->add_row(
        ++$_t,
        $t['name'],
        $t['detail'],
        form_anchor_edit('admin/fish/living/'.$t['id']).$delete
      );
    endforeach;
    $this->table->set_template(['table_open'=>'<table class="table table-bordered table-striped table-hover">']);
    $this->data['content'] .= heading('รายการข้อมูลลักษณะการอยู่อาศัย','4').hr().br().$this->table->generate();
    $this->load->view('_layout_main',$this->data);
  }

  function container($id='')
  {
    $post = $this->input->post();
    if ($post) :
      $save = $this->fish->fish_container($id,$post);
      if ($save !== FALSE) :
        $this->session->set_flashdata(array('class'=>'success','value'=>'เพิ่มข้อมูลเสร็จสิ้น'));
        redirect('admin/fish/container');
      endif;
    endif;

    $this->data['content'] = $this->fish->fish_container($id);
    $this->table->set_heading(['#','ชื่อ','รายละเอียด','']);
    $tables = $this->db->get('container')->result_array();
    foreach ($tables as $_t => $t) :
      $delete = ($t['id'] < 5) ? '' : form_anchor_delete('admin/fish/delete/container_'.$t['id']);
      $this->table->add_row(
        ++$_t,
        $t['name'],
        $t['detail'],
        form_anchor_edit('admin/fish/container/'.$t['id']).$delete
      );
    endforeach;
    $this->table->set_template(['table_open'=>'<table class="table table-bordered table-striped table-hover">']);
    $this->data['content'] .= heading('รายการข้อมูลภาชนะการเลี้ยงที่เหมาะสม','4').hr().br().$this->table->generate();
    $this->load->view('_layout_main',$this->data);
  }

  function halo($id='')
  {
    $post = $this->input->post();
    if ($post) :
      $save = $this->fish->fish_halo($id,$post);
      if ($save !== FALSE) :
        $this->session->set_flashdata(array('class'=>'success','value'=>'เพิ่มข้อมูลเสร็จสิ้น'));
        redirect('admin/fish/halo');
      endif;
    endif;

    $this->data['content'] = $this->fish->fish_halo($id);
    $this->table->set_heading(['#','ชื่อ','รายละเอียด','']);
    $tables = $this->db->get('halo')->result_array();
    foreach ($tables as $_t => $t) :
      $delete = ($t['id'] < 5) ? '' : form_anchor_delete('admin/fish/delete/halo_'.$t['id']);
      $this->table->add_row(
        ++$_t,
        $t['name'],
        $t['detail'],
        form_anchor_edit('admin/fish/halo/'.$t['id']).$delete
      );
    endforeach;
    $this->table->set_template(['table_open'=>'<table class="table table-bordered table-striped table-hover">']);
    $this->data['content'] .= heading('รายการข้อมูลการเสริมบารมี','4').hr().br().$this->table->generate();
    $this->load->view('_layout_main',$this->data);
  }

  function delete($id)
  {
    $table = explode('_',$id)[0];
    $id = explode('_',$id)[1];
    if ($table !== 'fish') :
      if ((int)$id < 4) :
        return FALSE;
      endif;
    endif;

    $this->db->delete($table,array('id'=>$id));
    $this->session->set_flashdata(['class'=>'success','value'=>'ลบข้อมูลเรียบร้อยแล้ว']);
    redirect('admin/fish/'.$table);
  }

}
