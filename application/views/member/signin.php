<?php if ($this->session->is_login) : ?>
  <?=br().hr().heading('เข้าสู่ระบบเรียบร้อยแล้ว','4',['class'=>'text-center']).hr().br();?>
<?php else: ?>
  <?=form_open(uri_string(),array('class'=>'form-horizontal'),array('date_activity'=>date('d-m-Y')));?>
  <?=heading('เข้าสู่ระบบ','4').hr();?>
  <div class="form-group">
    <?=form_label('อีเมล์','email',array('class'=>'control-label text-right col-sm-3'));?>
    <div class="col-sm-9">
      <?=form_email(array('name'=>'email','class'=>'form-control','required'=>TRUE),set_value('email'));?>
    </div>
  </div>
  <div class="form-group">
    <?=form_label('รหัสผ่าน','password',array('class'=>'control-label text-right col-sm-3'));?>
    <div class="col-sm-9">
      <?=form_password(array('name'=>'password','class'=>'form-control','required'=>TRUE));?>
    </div>
  </div>
  <br/>
  <div class="form-group">
    <div class="col-sm-offset-3">
      <?=form_submit('','ยืนยัน',['class'=>'col-sm-2 btn btn-success','autocomplete'=>'off']);?>
      <?=form_reset('','ยกเลิก',['class'=>'btn btn-link','autocomplete'=>'off']);?>
      <?=anchor('member/register','หรือ สมัครสมาชิก?',array('type'=>'button','class'=>'pull-right'));?>
    </div>
  </div>
  <?=form_close();?>
  <?=br().validation_errors('<div class="alert alert-danger">', '</div>');?>
<?php endif; ?>
