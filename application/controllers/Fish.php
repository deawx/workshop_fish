<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fish extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Fish_model','fish');

    if ( ! $this->session->userdata('compare'))
      $this->session->set_userdata('compare',array());
  }

  function index($id='')
  {
    if ((int)$id > 0) :

      if ($this->agent->referrer() !== site_url(uri_string()))
        $this->session->set_userdata('lastpage',$this->agent->referrer());

      $this->data['fish'] = $this->db->where('id',$id)->get('fish')->row_array();
      $this->data['nature'] = $this->db->where('id',$this->data['fish']['nature_id'])->get('nature')->row_array();
      $this->data['feed'] = $this->db->where('id',$this->data['fish']['feed_id'])->get('feed')->row_array();
      $this->data['living'] = $this->db->where('id',$this->data['fish']['living_id'])->get('living')->row_array();
      $this->data['container'] = $this->db->where('id',$this->data['fish']['container_id'])->get('container')->row_array();
      $this->data['related'] = $this->db->select(array('id','picture','fullname','fullsize','fullage'))->order_by('id','RANDOM')->where_not_in('id',$id)->get('fish','4')->result_array();
      $this->data['content'] = $this->load->view('fish/fish_detail',$this->data,TRUE);
    else:
      $search = $this->input->get();
      unset($search['p']);
      if ($search) :
        foreach ($search as $s => $_s) :
          foreach ($_s as $n => $_ss) :
            $this->data[$s][$_ss] = $_ss;
            $this->db->or_where($s,$_ss);
          endforeach;
        endforeach;
        $this->data['fish'] = $this->db->get('fish')->result_array();
      else:
        $config	= array(
          'base_url' => uri_string(),
          'total_rows' => $this->db->count_all_results('fish'),
          'per_page' => '6'
        );
        $offset = ($this->input->get('p') > 0) ? $this->input->get('p') : '0';
        $this->pagination->initialize($config);
        $this->data['fish'] = $this->db->get('fish',$config['per_page'],$offset)->result_array();
      endif;

      $this->data['nature'] = $this->db->get('nature')->result_array();
      $this->data['feed'] = $this->db->get('feed')->result_array();
      $this->data['living'] = $this->db->get('living')->result_array();
      $this->data['container'] = $this->db->get('container')->result_array();
      $this->data['content'] = $this->load->view('fish/fish',$this->data,TRUE);
      $this->data['pagination'] = $this->pagination->create_links();
    endif;

		$this->load->view('_layout_main', $this->data);
  }

  function create()
  {
    $post = $this->input->post();
    if ($post) :
      $save = $this->fish->fish_form('',$post);
      if ($save !== FALSE) :
        $this->session->set_flashdata(array('class'=>'success','value'=>'เพิ่มข้อมูลเรียบร้อยแล้ว'));
        redirect('fish');
      endif;
    endif;
    $this->data['content'] = $this->fish->fish_form();
    $this->load->view('_layout_main', $this->data);
  }

  function edit($id)
  {
    $post = $this->input->post();
    if ($post) :
      $save = $this->fish->fish_form($id,$post);
      if ($save !== FALSE) :
        $this->session->set_flashdata(array('class'=>'success','value'=>'แก้ไขข้อมูลเรียบร้อยแล้ว'));
        redirect('fish');
      endif;
    endif;

    $this->data['content'] = $this->fish->fish_form($id);
    $this->load->view('_layout_main', $this->data);
  }

  function compare($id)
  {
    $id = intval($id);
    if ( ! $id)
      return FALSE;

    $compares = $this->session->userdata('compare');
    if (array_key_exists($id,$compares)) :
      unset($compares[$id]);
    elseif (count($compares) > 9) :
      $this->session->set_flashdata(array('class'=>'warning','value'=>'ไม่สามารถเพิ่มได้มากกว่า 10'));
    else:
      $compares[$id] = $this->db->where('id',$id)->get('fish')->row_array();
    endif;

    $this->session->set_userdata('compare',$compares);

    redirect($this->agent->referrer());
  }

}
