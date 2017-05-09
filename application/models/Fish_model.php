<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fish_model extends MY_Model {

  public $table_name = 'fish';
  public $rules = array(
    'options' => array(
      array(
        'field' => 'name',
        'label' => 'ชื่อ',
        'rules' => 'trim|required|max_length[100]'
      ),
      array(
        'field' => 'detail',
        'label' => 'ชื่อ',
        'rules' => 'trim|required'
      )
    )
  );
  private $params = array();

  function fish_options($table)
  {
    $array = ['เลือกข้อมูล'];
    $tables = $this->db->order_by('id ASC')->get($table)->result_array();
    foreach ($tables as $_f => $f) :
      $array[$f['id']] = $f['name'];
    endforeach;
    return $array;
  }

  function fish_form($id='',$post='')
  {
    if ($post) :
      if ($_FILES['picture']['name']) :
        $upload = [
          'allowed_types'	=> 'jpg|jpeg|png',
          'upload_path'	=> realpath(APPPATH.'../assets/fish'),
          'file_name'		=> $post['fullname'].'_'.$id,
          'file_ext_tolower' => TRUE,
          'overwrite' => TRUE
        ];
        $this->upload->initialize($upload);
        if ($this->upload->do_upload('picture')) :
          $resize = [
            'image_library' => 'gd2',
            'source_image' => $this->upload->data('full_path'),
            'maintain_ratio' => FALSE,
            'width' => '600',
            'height' => '600',
          ];
          $this->image_lib->initialize($resize);
          $this->image_lib->resize();
          $post['picture'] = $this->upload->data('file_name');
        endif;
      endif;
      return $this->save($post);
    endif;

    $data = $this->search_id($id)->row_array();
    $this->params['head'] = ((int)$id > 0) ? 'แก้ไขข้อมูลปลาสวยงาม' : 'บันทึกข้อมูลปลาสวยงาม';
    $this->params['hidden'] = ((int)$id > 0) ? ['id'=>$id,'date_modify'=>date('d/m/Y')] : ['member_id'=>$this->session->id];
    $this->params['form'] = [
      ['label'=>form_label('','',['class'=>'col-sm-3']),
      'input'=>img('assets/fish/'.$data['picture'],'',['class'=>'text-center']),
      'help'=>''],
      ['label'=>form_label('','picture',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_upload(array('name'=>'picture','class'=>'form-control')),
      'help'=>''],
      ['label'=>form_label('ชื่อเต็ม','fullname',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_input(array('name'=>'fullname','class'=>'form-control','required'=>TRUE),set_value('fullname',$data['fullname'])),
      'help'=>''],
      ['label'=>form_label(('ขนาดเต็มวัย(เซ็นติเมตร)'),'fullsize',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_number(array('name'=>'fullsize','class'=>'form-control','required'=>TRUE,'min'=>'0','maxlength'=>'3'),set_value('fullsize',$data['fullsize'])),
      'help'=>'ขนาดความยาวตัวโตเต็มที่ มีหน่วยเป็นเซ็นติเมตร'],
      ['label'=>form_label(('อายุเฉลี่ย(ปี)'),'fullage',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_number(array('name'=>'fullage','class'=>'form-control','required'=>TRUE,'min'=>'0','maxlength'=>'3'),set_value('fullage',$data['fullage'])),
      'help'=>'อายุเฉลี่ยมากที่สุด มีหน่วยเป็นปี'],
      ['label'=>form_label(('ข้อมูลด้านความเชื่อ'),'believe',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_textarea(array('name'=>'believe','class'=>'form-control','required'=>TRUE,'value'=>$data['believe'])),
      'help'=>''],
      ['label'=>form_label(('ข้อมูลจำเพาะ'),'detail',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_textarea(array('name'=>'detail','class'=>'form-control','required'=>TRUE,'value'=>$data['detail'])),
      'help'=>''],
      ['label'=>form_label(('อุปนิสัย'),'nature_id',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_dropdown(array('name'=>'nature_id','class'=>'form-control'),$this->fish_options('nature'),set_value('nature_id',$data['nature_id'])),
      'help'=>''],
      ['label'=>form_label(('อาหาร'),'feed_id',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_dropdown(array('name'=>'feed_id','class'=>'form-control'),$this->fish_options('feed'),set_value('feed_id',$data['feed_id'])),
      'help'=>''],
      ['label'=>form_label(('สังคม'),'living_id',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_dropdown(array('name'=>'living_id','class'=>'form-control'),$this->fish_options('living'),set_value('living_id',$data['living_id'])),
      'help'=>''],
      ['label'=>form_label(('ภาชนะที่เหมาะสม'),'container_id',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_dropdown(array('name'=>'container_id','class'=>'form-control'),$this->fish_options('container'),set_value('container_id',$data['container_id'])),
      'help'=>'']
    ];
    return $this->load->view('_elements/form', $this->params, TRUE);
  }

  function fish_nature($id='',$post='')
  {
    if ($post) :
      if ($id) :
        return $this->db->set($post)->where('id',$id)->update('nature');
      else:
        return $this->db->insert('nature',$post);
      endif;
    endif;

    $disabled = ($id !== '') ? (($id < 5) ? 'disabled' : '') : '';
    $data = $this->db->get_where('nature',array('id'=>$id))->row_array();
    $this->params['head'] = ((int)$id > 0) ? 'แก้ไขข้อมูลอุปนิสัยโดยธรรมชาติ' : 'บันทึกข้อมูลอุปนิสัยโดยธรรมชาติ';
    $this->params['hidden'] = ((int)$id > 0) ? ['id'=>$id] : [];
    $this->params['form'] = [
      ['label'=>form_label(('ชื่อ'),'name',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_input(array('name'=>'name','class'=>'form-control','required'=>TRUE,$disabled=>TRUE),set_value('name',$data['name'])),
      'help'=>''],
      ['label'=>form_label(('คำอธิบาย'),'detail',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_textarea(array('name'=>'detail','class'=>'form-control','required'=>TRUE),set_value('detail',$data['detail'])),
      'help'=>'']
    ];
    return $this->load->view('_elements/form', $this->params, TRUE);
  }

  function fish_feed($id='',$post='')
  {
    if ($post) :
      if ($id) :
        return $this->db->set($post)->where('id',$id)->update('feed');
      else:
        return $this->db->insert('feed',$post);
      endif;
    endif;

    $disabled = ($id !== '') ? (($id < 5) ? 'disabled' : '') : '';
    $data = $this->db->get_where('feed',array('id'=>$id))->row_array();
    $this->params['head'] = ((int)$id > 0) ? 'แก้ไขข้อมูลชนิดของอาหาร' : 'บันทึกข้อมูลชนิดของอาหาร';
    $this->params['hidden'] = ((int)$id > 0) ? ['id'=>$id] : [];
    $this->params['form'] = [
      ['label'=>form_label(('ชื่อ'),'name',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_input(array('name'=>'name','class'=>'form-control','required'=>TRUE,$disabled=>TRUE),set_value('name',$data['name'])),
      'help'=>''],
      ['label'=>form_label(('คำอธิบาย'),'detail',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_textarea(array('name'=>'detail','class'=>'form-control','required'=>TRUE),set_value('detail',$data['detail'])),
      'help'=>'']
    ];
    return $this->load->view('_elements/form', $this->params, TRUE);
  }

  function fish_living($id='',$post='')
  {
    if ($post) :
      if ($id) :
        return $this->db->set($post)->where('id',$id)->update('living');
      else:
        return $this->db->insert('living',$post);
      endif;
    endif;

    $disabled = ($id !== '') ? (($id < 5) ? 'disabled' : '') : '';
    $data = $this->db->get_where('living',array('id'=>$id))->row_array();
    $this->params['head'] = ((int)$id > 0) ? 'แก้ไขข้อมูลลักษณะการอยู่อาศัย' : 'บันทึกข้อมูลลักษณะการอยู่อาศัย';
    $this->params['hidden'] = ((int)$id > 0) ? ['id'=>$id] : [];
    $this->params['form'] = [
      ['label'=>form_label(('ชื่อ'),'name',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_input(array('name'=>'name','class'=>'form-control','required'=>TRUE,$disabled=>TRUE),set_value('name',$data['name'])),
      'help'=>''],
      ['label'=>form_label(('คำอธิบาย'),'detail',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_textarea(array('name'=>'detail','class'=>'form-control','required'=>TRUE),set_value('detail',$data['detail'])),
      'help'=>'']
    ];
    return $this->load->view('_elements/form', $this->params, TRUE);
  }

  function fish_container($id='',$post='')
  {
    if ($post) :
      if ($id) :
        return $this->db->set($post)->where('id',$id)->update('container');
      else:
        return $this->db->insert('container',$post);
      endif;
    endif;

    $disabled = ($id !== '') ? (($id < 5) ? 'disabled' : '') : '';
    $data = $this->db->get_where('container',array('id'=>$id))->row_array();
    $this->params['head'] = ((int)$id > 0) ? 'แก้ไขข้อมูลภาชนะการเลี้ยงที่เหมาะสม' : 'บันทึกข้อมูลภาชนะการเลี้ยงที่เหมาะสม';
    $this->params['hidden'] = ((int)$id > 0) ? ['id'=>$id] : [];
    $this->params['form'] = [
      ['label'=>form_label(('ชื่อ'),'name',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_input(array('name'=>'name','class'=>'form-control','required'=>TRUE,$disabled=>TRUE),set_value('name',$data['name'])),
      'help'=>''],
      ['label'=>form_label(('คำอธิบาย'),'detail',array('class'=>'control-label text-right col-sm-3')),
      'input'=>form_textarea(array('name'=>'detail','class'=>'form-control','required'=>TRUE),set_value('detail',$data['detail'])),
      'help'=>'']
    ];
    return $this->load->view('_elements/form', $this->params, TRUE);
  }

}
