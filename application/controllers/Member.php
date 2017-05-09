<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

  function __construct()
	{
		parent::__construct();
		$this->load->model('Member_model','member');
	}

	public function index()
	{
		$this->signin();
	}

  function signin()
	{
    if ($this->session->is_login)
      redirect('main');

		$post = $this->input->post();
		if ($post) :
			$login = $this->member->login($post);
			if ($login !== FALSE) :
				$this->session->set_userdata($login);
				$this->session->set_userdata('is_login',TRUE);
        redirect('main');
      else:
        $this->session->set_flashdata(array('class'=>'success','value'=>'ชื่อผู้ใช้หรือรหัสผ่านผิด'));
			endif;
		endif;
		$this->data['content'] = $this->load->view('member/signin','',TRUE);
		$this->load->view('_layout_main', $this->data);
	}

	function register()
	{
    if ($this->session->is_login)
      redirect('main');

		$post = $this->input->post();
		if ($post) :
			$register = $this->member->register($post);
			if ($register !== FALSE) :
				$this->session->set_flashdata(array('class'=>'success','value'=>'สมัครสมาชิกเสร็จสิ้น กรุณาเข้าสู่ระบบ'));
				redirect('member/signin');
			endif;
		endif;
		$this->data['content'] = $this->load->view('member/register','',TRUE);
		$this->load->view('_layout_main', $this->data);
	}

  function profile($id)
	{
		$id = intval($id);
		if ( ! $id)
			redirect('main');

		$data = $this->member->search_id($id);
		$this->data['content'] = $this->load->view('member/profile',$data->row_array(),TRUE);
		$this->load->view('_layout_main', $this->data);
	}

	function edit($id)
	{
		if ((int)$this->session->id !== (int)$id)
			redirect('main');

		$post = $this->input->post();
		if ($post) :
			$save = $this->member->update($post);
			if ($save !== FALSE) :
				$this->session->set_userdata($post);
				$this->session->set_flashdata(array('class'=>'success','value'=>'แก้ไขข้อมูลเสร็จสิ้น'));
				redirect('member/profile/'.$id);
			endif;
		endif;

		$data = $this->member->search_id($id);
		$this->data['content'] = $this->load->view('member/edit',$data->row_array(),TRUE);
		$this->load->view('_layout_main', $this->data);
	}

	function change_password($id)
	{
		if ((int)$this->session->id !== (int)$id)
			redirect('main');

		$post = $this->input->post();
		if ($post) :
			$changed = $this->member->change_password($post);
			if ($changed) :
				$this->session->set_userdata('password',$post['new_password']);
				$this->session->set_flashdata(array('class'=>'success','value'=>'เปลี่ยนรหัสผ่านเสร็จสิ้น'));
				redirect('main');
			endif;
		endif;

		$this->data['content'] = $this->load->view('member/change_password',array('id'=>$id),TRUE);
		$this->load->view('_layout_main', $this->data);
	}

  function signout()
  {
    if ( ! $this->session->is_login)
      return FALSE;

    $this->session->sess_destroy();
    redirect('main');
  }

}
