<?php
$create = isset($topic) ? $topic['date_create'] : '';
$modify = isset($topic) ? $topic['date_modify'] : '';
$amount = isset($topic) ? $topic['fish_amount'] : '';
$title = isset($topic) ? $topic['pool_title'] : '';
$shape = isset($topic) ? $topic['pool_shape'] : '';
$detail = isset($topic) ? $topic['pool_detail'] : '';
$believe = isset($topic) ? $topic['pool_believe'] : '';
$id = isset($topic) ? $topic['id'] : '';

$heading = 'แก้ไขหัวข้อ : '.$title;
$hidden = array('id'=>$topic['id'],'date_modify'=>date('d/m/Y'));
$form = [
  ['label'=>form_label(ucfirst('บันทึกเมื่อ'),'title',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_input(['name'=>'','class'=>'form-control','disabled'=>TRUE],set_value('date_create',$create)),
  'help'=>''],
  ['label'=>form_label(ucfirst('แก้ไขล่าสุดเมื่อ'),'title',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_input(['name'=>'','class'=>'form-control','disabled'=>TRUE],set_value('date_modify',$modify)),
  'help'=>''],
  ['label'=>form_label(ucfirst('ชนิดของปลาที่เลี้ยง(จำนวน)'),'title',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_input(['name'=>'','class'=>'form-control','disabled'=>TRUE],set_value('fish_amount',$amount)),
  'help'=>''],
  ['label'=>form_label(ucfirst('หัวข้อ'),'title',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_input(['name'=>'pool_title','class'=>'form-control','required'=>TRUE],set_value('title',$title)),
  'help'=>''],
  ['label'=>form_label(ucfirst('รูปร่างบ่อเลี้ยงปลา'),'detail',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_textarea(['name'=>'pool_shape','class'=>'form-control','required'=>TRUE,'value'=>$shape]),
  'help'=>''],
  ['label'=>form_label(ucfirst('คุณลักษณะบ่อเลี้ยงปลา'),'detail',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_textarea(['name'=>'pool_detail','class'=>'form-control','required'=>TRUE,'value'=>$detail]),
  'help'=>''],
  ['label'=>form_label(ucfirst('ข้อมูลทางความเชื่อ'),'detail',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_textarea(['name'=>'pool_believe','class'=>'form-control','required'=>TRUE,'value'=>$believe]),
  'help'=>'']
];
?>
<?=form_open(uri_string(),array('class'=>'form-horizontal'),$hidden);?>
  <?=($id) ? anchor('webboard/delete/'.$id,'ลบหัวข้อนี้',array('class'=>'btn btn-warning pull-right','onclick'=>"return confirm('ต้องการลบหัวข้อนี้ ?');")) : '';?>
  <?=heading($heading,'4').hr();?>
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
      <?=form_submit('','ยืนยัน',['class'=>'col-sm-2 btn btn-success']);?>
      <?=form_reset('','ยกเลิก',['class'=>'btn btn-link']);?>
      <?=anchor('webboard/compare','ย้อนกลับ',array('class'=>'pull-right'));?>
    </div>
  </div>
<?=form_close();?>
<?=validation_errors('<div class="alert alert-warning">', '</div>');?>
