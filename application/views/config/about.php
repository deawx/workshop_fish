<?php
$id = (isset($id)) ? $id : '';
$address = (isset($address)) ? $address : '';
$email = (isset($email)) ? $email : '';
$phone = (isset($phone)) ? $phone : '';
$latt = (isset($latt)) ? $latt : '';
$longt = (isset($longt)) ? $longt : '';
$form = [
  ['label'=>form_label('ที่อยู่','address',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_textarea(['name'=>'address','class'=>'form-control ckeditor','required'=>TRUE,'value'=>$address]),
  'help'=>''],
  ['label'=>form_label('อีเมล์','email',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_email(['name'=>'email','class'=>'form-control'],set_value('email',$email)),
  'help'=>''],
  ['label'=>form_label('เบอร์โทรศัพท์','phone',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_input(['name'=>'phone','class'=>'form-control'],set_value('phone',$phone)),
  'help'=>''],
  ['label'=>form_label('ละติจุด','latt',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_input(['name'=>'latt','class'=>'form-control'],set_value('latt',$latt)),
  'help'=>''],
  ['label'=>form_label('ลองติจุด','longt',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_input(['name'=>'longt','class'=>'form-control'],set_value('longt',$longt)),
  'help'=>'']
];
?>
<?=form_open(uri_string(),array('class'=>'form-horizontal'),array('id'=>$id));?>
  <?=heading('บันทึกข้อมูลการติดต่อเรา','4').hr();?>
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
