<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends MY_Model {

  public $table_name = 'member';
  public $rules = array(
    'login' => array(
      array(
        'field' => 'email',
        'label' => 'ชื่อผู้ใช้',
        'rules' => 'trim|required|max_length[30]'
      ),
      array(
        'field' => 'password',
        'label' => 'รหัสผ่าน',
        'rules' => 'trim|required|max_length[32]'
      )
    ),
    'register' => array(
      array(
        'field' => 'fullname',
        'label' => 'ชื่อผู้ใช้',
        'rules' => 'trim|required|max_length[100]'
      ),
      array(
        'field' => 'email',
        'label' => 'อีเมล์',
        'rules' => 'trim|required|max_length[50]|is_unique[member.email]'
      ),
      array(
        'field' => 'password',
        'label' => 'รหัสผ่าน',
        'rules' => 'trim|required|max_length[32]'
      )
    ),
    'edit' => array(
      array(
        'field' => 'fullname',
        'label' => 'ชื่อผู้ใช้',
        'rules' => 'trim|required|max_length[100]'
      ),
      array(
        'field' => 'birthdate',
        'label' => 'วันเดือนปีเกิด',
        'rules' => 'trim|required|max_length[10]'
      ),
      array(
        'field' => 'address',
        'label' => 'ที่อยู่',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'phone',
        'label' => 'เบอร์โทรศัพท์',
        'rules' => 'trim|required|max_length[15]'
      )
    ),
    'change_password' => array(
      array(
        'field' => 'new_password',
        'label' => 'รหัสผ่านใหม่',
        'rules' => 'trim|required|max_length[32]|differs[old_password]'
      ),
      array(
        'field' => 'new_password_confirm',
        'label' => 'รหัสผ่านใหม่(ยืนยัน)',
        'rules' => 'trim|required|max_length[32]|matches[new_password]'
      )
    ),
    'create' => array(
      array(
        'field' => 'fullname',
        'label' => 'ชื่อ-นามสกุล',
        'rules' => 'trim|required|max_length[100]'
      ),
      array(
        'field' => 'birthdate',
        'label' => 'วัน/เดือน/ปี เกิด',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'email',
        'label' => 'อีเมล์',
        'rules' => 'trim|required|max_length[100]|is_unique[member.email]'
      ),
      array(
        'field' => 'password',
        'label' => 'รหัสผ่าน',
        'rules' => 'trim|required|max_length[32]'
      ),
      array(
        'field' => 'address',
        'label' => 'ที่อยู่',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'phone',
        'label' => 'เบอร์โทรศัพท์',
        'rules' => 'trim|required|max_length[15]'
      )
    )
  );

  function login($post)
  {
    $this->form_validation->set_rules($this->rules['login']);
    if ($this->form_validation->run() === FALSE)
    return FALSE;

    unset($post['date_activity']);
    $data = $this->search($post);
    if ($data->num_rows() < 1)
      return FALSE;

    return $data->row_array();
  }

  function register($post)
  {
    $this->form_validation->set_rules($this->rules['register']);
    if ($this->form_validation->run() === FALSE)
      return FALSE;

    return $this->save($post);
  }

  function update($post)
  {
    if ($post['re_email'] !== $post['email'])
      $this->form_validation->set_rules('email', 'อีเมล์', 'trim|required|max_length[50]|is_unique[member.email]');

    if (in_array('password',$post))
      $this->form_validation->set_rules('password','รหัสผ่าน','trim|required|max_length[32]');

    $this->form_validation->set_rules($this->rules['edit']);
    if ($this->form_validation->run() === FALSE)
      return FALSE;

    if ($_FILES['picture']['name']) :
      $upload = array(
        'allowed_types'	=> 'jpg|jpeg|png',
        'upload_path'	=> realpath(APPPATH.'../assets/members/'),
        'file_name'		=> $post['email'].'.jpg',
        'file_ext_tolower' => TRUE,
        'overwrite' => TRUE
      );
      $this->load->library('upload',$upload);
      $this->upload->initialize($upload);
      if ($this->upload->do_upload('picture')) :
        $resize = array(
          'image_library' => 'gd2',
          'source_image' => $this->upload->data('full_path'),
          'maintain_ratio' => FALSE,
          'width' => '350',
          'height' => '350',
        );
        $this->image_lib->initialize($resize);
        $this->image_lib->resize();
        $post['picture'] = $this->upload->data('file_name');
      endif;
    endif;

    unset($post['re_email']);
    return $this->save($post);
  }

  function change_password($post)
  {
    if ($post['re_old_password'] !== $post['old_password'])
      $this->form_validation->set_rules('old_password', 'รหัสผ่านเดิม', 'callback_is_confirm');

    $this->form_validation->set_rules($this->rules['change_password']);
    if ($this->form_validation->run() === FALSE)
      return FALSE;

    return $this->save(array('password'=>$post['new_password'],'id'=>$post['id']));
  }

  function create($post)
  {
    $this->form_validation->set_rules($this->rules['create']);
    if ($this->form_validation->run() === FALSE)
      return FALSE;

    if ($_FILES['picture']['name']) :
      $upload = array(
        'allowed_types'	=> 'jpg|jpeg|png',
        'upload_path'	=> realpath(APPPATH.'../assets/members/'),
        'file_name'		=> $post['email'].'.jpg',
        'file_ext_tolower' => TRUE,
        'overwrite' => TRUE
      );
      $this->load->library('upload',$upload);
      $this->upload->initialize($upload);
      if ($this->upload->do_upload('picture')) :
        $resize = array(
          'image_library' => 'gd2',
          'source_image' => $this->upload->data('full_path'),
          'maintain_ratio' => FALSE,
          'width' => '350',
          'height' => '350',
        );
        $this->image_lib->initialize($resize);
        $this->image_lib->resize();
        $post['picture'] = $this->upload->data('file_name');
      endif;
    endif;

    return $this->save($post);
  }

  function search_compare($id)
  {
    return;
  }

  function delete($id)
  {
    if ( ! $id)
      return FALSE;

    $id = intval($id);
    if ($id < 2)
      return FALSE;

    return $this->remove($id);
  }

}
