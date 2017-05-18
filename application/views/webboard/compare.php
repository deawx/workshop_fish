<?php if ($this->uri->segment(3) > 0) : ?>
  <?php $edit = ($this->session->id == $member_id['id'] || $this->session->role == 'admin') ? anchor('webboard/compare_edit/'.$compare['id'],'แก้ไข',array('class'=>'btn btn-warning pull-right')) :'';?>
  <?php $delete = ($this->session->id == $member_id['id'] || $this->session->role == 'admin') ? anchor('webboard/delete_compare/'.$compare['id'],'ลบ',array('class'=>'btn btn-danger pull-right','onclick'=>"return confirm('ต้องการลบหัวข้อนี้?');")) :'';?>
  <div class="panel panel-primary">
    <div class="panel-heading">
      <?=heading($compare['pool_title'],'3',array('class'=>'panel-title')).$delete.$edit;?>
    </div>
    <div class="panel-body">
      <p>
        โพสต์เมื่อ <?=$compare['date_create'].' : ';?>
        แก้ไขเมื่อ <?=$compare["date_modify"].' : ';?>
        โดย <?=(isset($member_id['id'])) ? anchor_popup('member/profile/'.$member_id['id'],$member_id['fullname']) : 'บุคคลทั่วไป';?>
       </p>
      <?=heading('<u>รายการปลาทั้งหมด</u>','4');?>
      <div class="col-sm-12">
        <?php foreach ($compare_detil as $c) : ?>
          <?php $fish = $this->db->get_where('fish',array('id'=>$c['fish_id']))->row_array(); ?>
          <div class="col-md-2 portfolio-item">
            <?=img('assets/fish/'.$fish['picture'],'',array('class'=>'img-responsive','style'=>'width:200px;height:100px;'));?>
            <?=heading($fish['fullname'],'5');?>
            <?=p('จำนวน '.$c['amount']);?>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="col-sm-12">
        <br/><hr/>
        <?=heading('<u>หัวข้อ</u> '.$compare['pool_title'],'4');?>
        <?=p('<u>ชนิดของปลาที่เลี้ยง(จำนวน)</u>');?>
        <p style="text-indent:40px;line-height:1.8em;"><?=$compare['fish_amount'];?> ชนิด</p>
        <?=br();?>
        <?=p('<u>รายละเอียดบ่อปลา</u>');?>
        <p style="text-indent:40px;line-height:1.8em;"><?=$compare['pool_detail'];?></p>
        <?=br();?>
        <?=p('<u>ข้อมูลทางความเชื่อ</u>');?>
        <p style="text-indent:40px;line-height:1.8em;"><?=$compare['pool_believe'];?></p>
        <?=br();?>
      </div>
    </div>
  </div>
  <div class="col-sm-offset-1">
      <?php foreach ($comments as $_n => $n) : ?>
        <div class="panel panel-info">
        <?php $commented_by = $this->db->get_where('member',array('id'=>$n['commented_by']))->row_array(); ?>
        <div class="panel-heading">
          <?=($this->session->id === $commented_by['id']) ? anchor('webboard/delete_compare_comment/'.$n['id'],'ลบ',array('class'=>'btn btn-warning pull-right','onclick'=>"return confirm('ลบคอมเม้นต์นี้ ?');")) : '';?>
          <?=heading("โพสต์เมื่อ ".$n["date_create"].' : '.'แก้ไขเมื่อ '.$n["date_modify"].' : '."โดย ".anchor_popup("member/profile/".$commented_by["id"],$commented_by["fullname"]),'4',array('class'=>'panel-pool_title'));?>
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
      <?=form_open(uri_string(),array('class'=>'form-horizontal'),array('compare_id'=>$compare['id'],'commented_by'=>$this->session->id,'date_create'=>date('d/m/Y H:i:s')));?>
      <?=heading('คอมเม้นต์','4').hr();?>
      <div class="form-group">
        <?=form_label(ucfirst('เนื้อหา'),'detail',['class'=>'control-label text-right col-sm-3']);?>
        <div class="col-sm-9">
          <?=form_textarea(['name'=>'detail','class'=>'form-control','required'=>TRUE]);?>
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
  <?=heading('ข้อมูลการเลี้ยงปลาตามความเชื่อจากพี่น้อง','4').hr();?>
  <?php foreach ($compare as $_n => $n) : ?>
    <div class="panel panel-success">
      <?php $comments = $this->db->where('webboard_id',$n['id'])->count_all_results('webboard_comment');?>
      <?php $member_id = $this->db->get_where('member',array('id'=>$n['member_id']))->row_array();?>
      <div class="panel-heading">
        <p class="panel-title">
          <?=anchor('webboard/compare/'.$n['id'],character_limiter($n['pool_title'],'100'));?>
        </p>
      </div>
      <div class="panel-body">
        <?=character_limiter($n['pool_detail'],'150');?>
      </div>
      <div class="panel-footer">
        <span>โพสต์เมื่อ <?=$n['date_create'];?> : </span>
        <span>แก้ไขเมื่อ <?=$n['date_modify'];?> : </span>
        <span>ผู้ประกาศ <?=(isset($member_id['id'])) ? anchor_popup('member/profile/'.$member_id['id'],$member_id['fullname']) : 'บุคคลทั่วไป';?></span>
        <?=nbs(5).'<span class="label label-info">ผู้ตอบ '.$comments.'</span>';?>
        <?=nbs(5).'<span class="label label-info">ผู้อ่าน '.$n['views'].'</span>';?>
      </div>
    </div>
  <?php endforeach; ?>
  <div class="pull-right"><?=$this->pagination->create_links();?></div>
<?php endif; ?>
