<?php if ((int)$this->uri->segment(3) > 0) : ?>
  <?php $edit = ($this->session->id == $forum['posted_by'] || $this->session->role == 'admin') ? anchor('webboard/post/'.$forum['id'],'แก้ไข',array('class'=>'btn btn-warning pull-right')) :'';?>
  <?php $delete = ($this->session->id == $forum['posted_by'] || $this->session->role == 'admin') ? anchor('webboard/delete/'.$forum['id'],'ลบ',array('class'=>'btn btn-danger pull-right','onclick'=>"return confirm('ต้องการลบหัวข้อนี้?');")) :'';?>
  <div class="panel panel-success">
    <div class="panel-heading">
      <?=heading($forum['title'],'3',array('class'=>'panel-title')).$delete.$edit;?>
    </div>
    <div class="panel-body">
      <p>เมื่อ <?=$forum['date_create'].nbs(5).'โดย '.anchor_popup('member/profile/'.$posted_by['id'],$posted_by['fullname']).'</p>';?>
      <p><?=$forum['detail'].'</p>';?>
    </div>
  </div>
  <div class="col-sm-offset-1">
      <?php foreach ($comments as $_n => $n) : ?>
        <div class="panel panel-info">
        <?php $commented_by = $this->db->get_where('member',array('id'=>$n['commented_by']))->row_array(); ?>
        <div class="panel-heading">
          <?=($this->session->id === $commented_by['id']) ? anchor('webboard/delete_comment/'.$n['id'],'ลบ',array('class'=>'btn btn-warning pull-right','onclick'=>"return confirm('ลบคอมเม้นต์นี้ ?');")) : '';?>
          <?=heading("เมื่อ ".$n["date_create"].nbs(5)."โดย ".anchor_popup("member/profile/".$commented_by["id"],$commented_by["fullname"]),'4',array('class'=>'panel-title'));?>
        </div>
        <div class="panel-body">
          <?=$n['detail'];?>
        </div>
      </div>
      <?php endforeach; ?>
    <div class="pull-right"><?=$this->pagination->create_links();?></div>
    <?=br(4);?>
  </div>
    <?php if ($this->session->is_login === TRUE) : ?>
      <div class="well">
      <?=form_open(uri_string(),array('class'=>'form-horizontal'),array('webboard_id'=>$forum['id'],'commented_by'=>$this->session->id,'date_create'=>date('d/m/Y H:i:s')));?>
      <?=heading('คอมเม้นต์','4').hr();?>
      <div class="form-group">
        <?=form_label(ucfirst('เนื้อหา'),'detail',['class'=>'control-label text-right col-sm-3']);?>
        <div class="col-sm-9">
          <?=form_textarea(['name'=>'detail','class'=>'form-control ckeditor','required'=>TRUE]);?>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-3">
          <?=form_submit('','ยืนยัน',['class'=>'col-sm-2 btn btn-success','autocomplete'=>'off']);?>
          <?=form_reset('','ยกเลิก',['class'=>'btn btn-link','autocomplete'=>'off']);?>
        </div>
      </div>
      <?=form_close();?>
      <?=validation_errors('<div class="alert alert-warning">', '</div>');?>
    </div>
  <?php endif; ?>

<?php else: ?>

  <?=form_open('',['method'=>'get']);?>
  <div class="input-group">
    <?=form_input(['name'=>'search','class'=>'form-control']);?>
    <div class="input-group-addon">
      <?=form_submit('','ค้นหา');?>
    </div>
  </div>
  <?=form_close().hr();?>
  <?=($this->session->is_login) ? anchor('webboard/post','เริ่มหัวข้อใหม่',['class'=>'btn btn-primary pull-right']) : '';?>
  <?=heading('เว็บบอร์ดพี่น้องผู้นิยมการเลี้ยงปลาตามความเชื่อต่างๆ','4').hr();?>
  <?php foreach ($forum as $n) : ?>
    <div class="panel panel-info">
      <?php $edit = ($this->session->id == $n['posted_by'] || $this->session->role == 'admin') ? anchor('webboard/post/'.$n['id'],'แก้ไข',array('class'=>'btn btn-warning pull-right')) :'';?>
      <?php $delete = ($this->session->id == $n['posted_by'] || $this->session->role == 'admin') ? anchor('webboard/delete/'.$n['id'],'ลบ',array('class'=>'btn btn-danger pull-right','onclick'=>"return confirm('ต้องการลบหัวข้อนี้?');")) :'';?>
      <?php $comments = $this->db->where('webboard_id',$n['id'])->count_all_results('webboard_comment');?>
      <?php $posted_by = $this->db->get_where('member',array('id'=>$n['posted_by']))->row_array();?>
      <div class="panel-heading">
        <p class="panel-title">
          <?=anchor('webboard/forum/'.$n['id'],character_limiter($n['title'],'100')).$delete.$edit;?>
        </p>
      </div>
      <div class="panel-body">
        <?=character_limiter($n['detail'],'150');?>
      </div>
      <div class="panel-footer">
        <span>ผู้ถาม <?=anchor_popup('member/profile/'.$posted_by['id'],$posted_by['fullname']);?></span>
        <?=nbs(5).'<span class="label label-info">ผู้ตอบ '.$comments.'</span>';?>
        <?=nbs(5).'<span class="label label-info">ผู้อ่าน '.$n['views'].'</span>';?>
      </div>
    </div>
  <?php endforeach; ?>
  <div class="pull-right"><?=$this->pagination->create_links();?></div>

<?php endif; ?>
