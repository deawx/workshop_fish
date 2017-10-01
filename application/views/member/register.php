<?php if ($this->session->is_login) : ?>
  <?=br().hr().heading('เข้าสู่ระบบเรียบร้อยแล้ว','4',['class'=>'text-center']).hr().br();?>
<?php else: ?>
  <?=form_open(uri_string(),array('class'=>'form-horizontal'),array('date_create'=>date('d/m/Y')));?>
  <?=heading('สมัครสมาชิก','4').hr();?>
  <div class="form-group">
    <?=form_label('คำนำหน้า','title',['class'=>'control-label text-right col-sm-3']);?>
    <div class="col-sm-9">
      <?=form_dropdown(['name'=>'title','class'=>'form-control','required'=>TRUE],dropdown_title());?>
    </div>
  </div>
  <div class="form-group">
    <?=form_label('ชื่อ-นามสกุล','fullname',['class'=>'control-label text-right col-sm-3']);?>
    <div class="col-sm-9">
      <?=form_input(['name'=>'fullname','class'=>'form-control','required'=>TRUE],set_value('fullname'));?>
    </div>
  </div>
  <div class="form-group">
    <?=form_label('อีเมล์','email',['class'=>'control-label text-right col-sm-3']);?>
    <div class="col-sm-9">
      <?=form_email(['name'=>'email','class'=>'form-control','required'=>TRUE],set_value('email'));?>
    </div>
  </div>
  <div class="form-group">
    <?=form_label('รหัสผ่าน','password',['class'=>'control-label text-right col-sm-3']);?>
    <div class="col-sm-9">
      <?=form_password(['name'=>'password','class'=>'form-control','required'=>TRUE]);?>
    </div>
  </div>
  <div class="form-group">
    <?=form_label('รหัสผ่าน(ยืนยัน)','password_confirm',['class'=>'control-label text-right col-sm-3']);?>
    <div class="col-sm-9">
      <?=form_password(['name'=>'password_confirm','class'=>'form-control','required'=>TRUE]);?>
    </div>
  </div>
  <br/>
  <div class="form-group">
    <div class="col-sm-offset-3">
      <?=form_submit('','ยืนยัน',array('class'=>'col-sm-2 btn btn-success','autocomplete'=>'off'));?>
      <?=form_reset('','ยกเลิก',array('class'=>'btn btn-link','autocomplete'=>'off'));?>
      <?=anchor('member/signin','หรือ เข้าสู่ระบบ?',array('type'=>'button','class'=>'pull-right'));?>
    </div>
  </div>
  <?=form_close();?>
  <?=br().validation_errors('<div class="alert alert-danger">', '</div>');?>
<?php endif; ?>
