<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Member_model','member');
    $this->data['content'] = '';
	}

	public function index()
	{
		$this->table->set_heading(array('','ชื่อ - นามสกุล','วันที่สมัคร',''));
		$tables = $this->member->search(array('role'=>'member'))->result_array();
		foreach ($tables as $_t => $t) :
			$this->table->add_row(
				(($t['picture']!="") AND file_exists(FCPATH.'assets/members/'.$t['picture']))
					? img('assets/members/'.$t['picture'],'',array('style'=>'width:80px;height:80px;','class'=>'img-circle text-center'))
					: img('assets/images/'.(($t['title']=="นาย") ? 'male' : 'female').'.jpg','',array('style'=>'width:80px;height:80px;','class'=>'img-circle text-center')),
				$t['title'].nbs(3).$t['fullname'].br().'<small>'.$t['email'].'</small>',
				$t['date_create'],
				form_anchor_edit('admin/member/edit/'.$t['id']).form_anchor_delete('admin/member/delete/'.$t['id']));
		endforeach;
		$this->table->set_template(['table_open'=>'<table class="table table-striped table-hover">']);
		$this->data['content'] = heading('รายการข้อมูลสมาชิก','4').hr().br().$this->table->generate();
		$this->load->view('_layout_main',$this->data);
	}

	function create()
	{
		$post = $this->input->post();
		if ($post) :
			unset($post['password_confirm']);
			$create = $this->member->create($post);
			if ($create !== FALSE) :
				$this->session->set_flashdata(array('class'=>'success','value'=>'เพิ่มข้อมูลเสร็จสิ้น'));
				redirect('admin/member');
			endif;
		endif;

		$this->data['content'] = $this->load->view('member/create','',TRUE);
		$this->load->view('_layout_main', $this->data);
	}

	function edit($id)
	{
		$post = $this->input->post();
		if ($post) :
			$save = $this->member->update($post);
			if ($save !== FALSE) :
				$this->session->set_flashdata(array('class'=>'success','value'=>'แก้ไขข้อมูลเสร็จสิ้น'));
				redirect($this->agent->referrer());
			endif;
		endif;

		$data = $this->member->search_id($id);
		$this->data['content'] = $this->load->view('member/edit',$data->row_array(),TRUE);
		$this->load->view('_layout_main', $this->data);
	}

	function delete($id)
	{
		$remove = $this->member->delete($id);
		if ($remove !== FALSE)
			$this->session->set_flashdata(array('class'=>'success','value'=>'ลบข้อมูลเสร็จสิ้น'));

		redirect($this->agent->referrer());
	}

}
