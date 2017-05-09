<?php
$form = [
  ['label'=>form_label('รูปภาพ','picture',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_upload(['name'=>'picture','class'=>'form-control']),
  'help'=>''],
  ['label'=>form_label('คำนำหน้า','title',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_dropdown(['name'=>'title','class'=>'form-control','required'=>TRUE],dropdown_title(),set_value('title')),
  'help'=>''],
  ['label'=>form_label('ชื่อ-นามสกุล','fullname',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_input(['name'=>'fullname','class'=>'form-control','required'=>TRUE],set_value('fullname')),
  'help'=>''],
  ['label'=>form_label('วัน/เดือน/ปี เกิด','birthdate',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_input(['name'=>'birthdate','class'=>'form-control datepicker','required'=>TRUE],set_value('birthdate')),
  'help'=>''],
  ['label'=>form_label('ที่อยู่','address',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_textarea(['name'=>'address','class'=>'form-control','required'=>TRUE]),
  'help'=>''],
  ['label'=>form_label('อีเมล์','email',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_email(['name'=>'email','class'=>'form-control','required'=>TRUE],set_value('email')),
  'help'=>''],
  ['label'=>form_label('เบอร์โทรศัพท์','phone',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_number(['name'=>'phone','class'=>'form-control','required'=>TRUE],set_value('phone')),
  'help'=>''],
  ['label'=>form_label('รหัสผ่าน','password',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_input(['name'=>'password','class'=>'form-control','required'=>TRUE],set_value('password')),
  'help'=>'']
];
?>

<?=form_open_multipart(uri_string(),array('class'=>'form-horizontal'));?>
  <?=heading('เพิ่มข้อมูลผู้ใช้','4').hr();?>
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
<?=$this->upload->display_errors('<div class="alert alert-warning">','</div>');?>
