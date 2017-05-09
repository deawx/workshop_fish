<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webboard extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Webboard_model','webboard');
  }

  function index()
  {
    $this->data['compare'] = $this->db->get('compare','10')->result_array();
    $this->data['forum'] = $this->db->get('webboard','10')->result_array();
    $this->data['content'] = $this->load->view('webboard/webboard',$this->data,TRUE);
    $this->load->view('_layout_main', $this->data);
  }

  function compare($id='')
  {
    if ((int)$id > 0) :
      $post = $this->input->post();
      if ($post) :
        $comment = $this->db->insert('compare_comment',$post);
        if ($comment !== FALSE) :
          $this->session->set_flashdata(array('class'=>'success','value'=>'คอมเม้นต์เรียบร้อยแล้ว'));
          redirect($this->agent->referrer());
        endif;
      endif;

      $config	= array(
        'base_url' => current_url(),
        'total_rows' => $this->db->where('compare_id',$id)->count_all_results('compare_comment'),
        'per_page' => 5
      );
      $offset = ($this->input->get('p') > 0) ? $this->input->get('p') : '0';
      $this->pagination->initialize($config);
      $this->data['compare'] = $this->db->get_where('compare',array('id'=>$id))->row_array();
      $this->data['compare_detil'] = $this->db->get_where('compare_detail',array('compare_id'=>$id))->result_array();
      $this->data['member_id'] = $this->db->get_where('member',array('id'=>$this->data['compare']['member_id']))->row_array();
      $this->data['comments'] = $this->db->limit($config['per_page'],$offset)->get_where('compare_comment',['compare_id'=>$id])->result_array();
      $this->db->where('id',$this->data['compare']['id'])->set('views','views+1',FALSE)->update('compare');
    else:
      $search = $this->input->get('search');
      $config	= array(
        'base_url' => uri_string(),
        'total_rows' => $this->db->like('pool_title',$search)->count_all_results('compare'),
        'per_page' => 5
      );
      $offset = ($this->input->get('p') > 0) ? $this->input->get('p') : '0';
      $this->pagination->initialize($config);
      $this->data['compare'] = $this->db->like('pool_title',$search)->limit($config['per_page'])->offset($offset)->order_by('id','DESC')->get('compare')->result_array();
    endif;
    $this->data['content'] = $this->load->view('webboard/compare',$this->data,TRUE);
    $this->load->view('_layout_main', $this->data);
  }

  function forum($id='')
  {
    if ((int)$id > 0) :
      $post = $this->input->post();
      if ($post) :
        $comment = $this->webboard->post_comment($post);
        if ($comment !== FALSE) :
          $this->session->set_flashdata(array('class'=>'success','value'=>'คอมเม้นต์เรียบร้อยแล้ว'));
          redirect($this->agent->referrer());
        endif;
      endif;

      $config	= array(
        'base_url' => current_url(),
        'total_rows' => $this->db->where('webboard_id',$id)->count_all_results('webboard_comment'),
        'per_page' => 5
      );
      $offset = ($this->input->get('p') > 0) ? $this->input->get('p') : '0';
      $this->pagination->initialize($config);
      $this->data['forum'] = $this->webboard->search_id($id)->row_array();
      $this->data['posted_by'] = $this->db->get_where('member',array('id'=>$this->data['forum']['posted_by']))->row_array();
      $this->data['comments'] = $this->db->limit($config['per_page'],$offset)->get_where('webboard_comment',['webboard_id'=>$id])->result_array();
      $this->db->where('id',$this->data['forum']['id'])->set('views','views+1',FALSE)->update('webboard');
    else:
      $search = $this->input->get('search');
      $config	= array(
        'base_url' => uri_string(),
        'total_rows' => $this->db->like('title',$search)->count_all_results('webboard'),
        'per_page' => 5
      );
      $offset = ($this->input->get('p') > 0) ? $this->input->get('p') : '0';
      $this->pagination->initialize($config);
      $this->data['forum'] = $this->db->like('title',$search)->limit($config['per_page'])->offset($offset)->order_by('id','DESC')->get('webboard')->result_array();
    endif;
    $this->data['content'] = $this->load->view('webboard/forum',$this->data,TRUE);
    $this->load->view('_layout_main', $this->data);
  }

  function post($id='')
  {
    if ( ! $this->session->is_login)
      redirect('webboard');

    $post = $this->input->post();
    if ($post) :
      $save = $this->webboard->post($post);
      if ($save !== FALSE) :
        $this->session->set_flashdata(array('class'=>'success','value'=>'บันทึกหัวข้อเว็บบอร์ดเรียบร้อยแล้ว'));
        redirect('webboard');
      endif;
    endif;

    if ((int)$id > 0) :
      $this->data['topic'] = $this->webboard->search_id($id)->row_array();
    endif;

    $this->data['content'] = $this->load->view('webboard/topic',$this->data,TRUE);
    $this->load->view('_layout_main', $this->data);
  }

  function delete($id)
  {
    $this->db->delete('webboard',array('id'=>$id));
    $this->session->set_flashdata(['class'=>'success','value'=>'ลบหัวข้อเรียบร้อยแล้ว']);
    redirect('webboard');
  }

  function delete_comment($id)
  {
    $this->db->delete('webboard_comment',array('id'=>$id));
    $this->session->set_flashdata(['class'=>'success','value'=>'ลบคอมเม้นต์เรียบร้อยแล้ว']);
    redirect($this->agent->referrer());
  }

  function delete_compare_comment($id)
  {
    $this->db->delete('compare_comment',array('id'=>$id));
    $this->session->set_flashdata(['class'=>'success','value'=>'ลบคอมเม้นต์เรียบร้อยแล้ว']);
    redirect($this->agent->referrer());
  }

}
