<?php
$form = [
  ['label'=>form_label('','',['class'=>'col-sm-3']),
  'input'=>img('assets/members/'.$picture,'',['class'=>'text-center']),
  'help'=>''],
  ['label'=>form_label('คำนำหน้า','title',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_input(['name'=>'title','class'=>'form-control','required'=>TRUE,'disabled'=>TRUE],set_value('title',$title)),
  'help'=>''],
  ['label'=>form_label('ชื่อ-นามสกุล','fullname',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_input(['name'=>'fullname','class'=>'form-control','required'=>TRUE,'disabled'=>TRUE],set_value('fullname',$fullname)),
  'help'=>''],
  ['label'=>form_label('วัน/เดือน/ปี เกิด','birthdate',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_input(['name'=>'birthdate','class'=>'form-control','required'=>TRUE,'disabled'=>TRUE],set_value('birthdate',$birthdate)),
  'help'=>''],
  ['label'=>form_label('ที่อยู่','address',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_textarea(['name'=>'address','class'=>'form-control','required'=>TRUE,'value'=>$address,'disabled'=>TRUE]),
  'help'=>''],
  ['label'=>form_label('อีเมล์','email',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_email(['name'=>'email','class'=>'form-control','required'=>TRUE,'disabled'=>TRUE],set_value('email',$email)),
  'help'=>''],
  ['label'=>form_label('เบอร์โทรศัพท์','phone',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_number(['name'=>'phone','class'=>'form-control','required'=>TRUE,'disabled'=>TRUE],set_value('phone',$phone)),
  'help'=>'']
];
?>
<?php if ($this->session->id === $this->uri->segment('3')) : ?>
  <?=anchor('member/edit/'.$this->session->id,'แก้ไขข้อมูล',array('class'=>'btn btn-info'));?>
<?php endif; ?>
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
