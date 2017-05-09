<?php
$form = [
  ['label'=>form_label('รหัสผ่านเดิม','old_password',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_password(['name'=>'old_password','class'=>'form-control','required'=>TRUE]),
  'help'=>''],
  ['label'=>form_label('รหัสผ่านใหม่','new_password',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_password(['name'=>'new_password','class'=>'form-control','required'=>TRUE]),
  'help'=>''],
  ['label'=>form_label('รหัสผ่านใหม่(อีกครั้ง)','new_password_again',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_password(['name'=>'new_password_confirm','class'=>'form-control','required'=>TRUE]),
  'help'=>'']
];
?>
<?=form_open(uri_string(),array('class'=>'form-horizontal'),array('id'=>$id,'re_old_password'=>$this->session->password));?>
  <?=heading('เปลี่ยนรหัสผ่าน','4').hr();?>
  <?php foreach ($form as $_f => $f) : ?>
    <div class="form-group">
      <?=$f['label'];?>
      <div class="col-sm-9">
        <?=$f['input'];?>
        <span class="help-block"><?=$f['help'];?></span>
      </div>
    </div>
  <?php endforeach; ?>
  <br/>
  <div class="form-group">
    <div class="col-sm-offset-3">
      <?=form_submit('','ยืนยัน',['class'=>'col-sm-2 btn btn-success','autocomplete'=>'off']);?>
      <?=form_reset('','ยกเลิก',['class'=>'btn btn-link','autocomplete'=>'off']);?>
    </div>
  </div>
<?=form_close();?>
<?=validation_errors('<div class="alert alert-warning">', '</div>');?>
