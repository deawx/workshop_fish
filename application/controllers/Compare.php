<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compare extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Fish_model','fish');

    if ( ! count($this->session->compare))
      redirect('fish');

    foreach ($this->session->compare as $c) :
      $this->db->or_where('f.id',$c['id']);
    endforeach;
    $this->data['fish'] = $this->db
      ->select('fd.name as feed_name,l.name as living_name,f.*')
      ->join('feed as fd','fd.id = f.feed_id')
      ->join('living as l','l.id = f.living_id')
      ->get('fish as f')
      ->result_array();
  }

  function index()
  {
    foreach ($this->session->compare as $c) :
      $this->db->or_where('f.id',$c['id']);
    endforeach;
    $this->data['fish'] = $this->db
      ->select('fd.name as feed_name,l.name as living_name,f.*')
      ->join('feed as fd','fd.id = f.feed_id')
      ->join('living as l','l.id = f.living_id')
      ->get('fish as f')
      ->result_array();
    $nt = array();
    $fd = array();
    $lv = array();
    $ct = array();
    foreach ($this->data['fish'] as $l) :
      $nt[] = $l['nature_id'];
      $fd[] = $l['feed_id'];
      $lv[] = $l['living_id'];
      $ct[] = $l['container_id'];
    endforeach;
    $alert = array();
    if (in_array('3',$nt)) :
      $alert[] = 'อันตราย ! พบรายการปลาที่มีอุปนิสัยก้าวร้าว';
    elseif (in_array('4',$nt)) :
      $alert[] = 'อันตราย ! พบรายการปลาที่มีอุปนิสัยดุร้าย';
    elseif (in_array('5',$nt)) :
      $alert[] = 'อันตราย ! พบรายการปลาที่มีอุปนิสัยหวงถิ่นอาศัย';
    endif;
    $this->data['alert'] = $alert;
    $this->data['nature'] = $this->db->where_in('id',$nt)->get('nature')->result_array();
    $this->data['feed'] = $this->db->where_in('id',$fd)->get('feed')->result_array();
    $this->data['living'] = $this->db->where_in('id',$lv)->get('living')->result_array();
    $this->data['container'] = $this->db->where_in('id',$ct)->get('container')->result_array();
    $this->data['content'] = $this->load->view('compare/compare',$this->data,TRUE);
		$this->load->view('_layout_main', $this->data);
  }

  function compare_pool($id='')
  {
    $post = $this->input->post();
    if ($post) :
      if ( ! $this->session->is_login)
        return FALSE;

      $amount = $post['amount'];
      unset($post['amount']);
      $this->db->insert('compare',$post);
      $compare_id = $this->db->insert_id();
      foreach ($this->data['fish'] as $f) :
        $this->db->insert('compare_detail',array('compare_id'=>$compare_id,'fish_id'=>$f['id'],'amount'=>$amount[$f['id']]));
      endforeach;
      $this->session->unset_userdata('compare');
      $this->session->set_flashdata(array('class'=>'success','value'=>'บันทึกการเปรียบเทียบข้อมูลปลาเรียบร้อยแล้ว'));
      redirect('fish');
    endif;

    $this->data['id'] = $id;
    $this->data['compare'] = $this->db->get_where('compare',array('id'=>$id))->row_array();
    $this->data['compare_detail'] = $this->db->get_where('compare_detail',array('compare_id'=>'$id'))->result_array();

    $this->data['content'] = $this->load->view('compare/compare_pool',$this->data,TRUE);
    $this->load->view('_layout_main', $this->data);
  }

}
