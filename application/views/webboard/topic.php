<?php
$heading = isset($topic) ? 'แก้ไขหัวข้อ' : 'เริ่มหัวข้อใหม่';
$hidden = isset($topic) ? array('id'=>$topic['id']) : array('posted_by'=>$this->session->id,'date_create'=>date('d/m/Y H:i:s'));
$title = isset($topic) ? $topic['title'] : '';
$detail = isset($topic) ? $topic['detail'] : '';
$id = isset($topic) ? $topic['id'] : '';
$form = [
  ['label'=>form_label(ucfirst('หัวข้อ'),'title',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_input(['name'=>'title','class'=>'form-control','required'=>TRUE],set_value('title',$title)),
  'help'=>''],
  ['label'=>form_label(ucfirst('เนื้อหา'),'detail',['class'=>'control-label text-right col-sm-3']),
  'input'=>form_textarea(['name'=>'detail','class'=>'form-control ckeditor','required'=>TRUE,'value'=>$detail]),
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
      <?=anchor('webboard/forum','ย้อนกลับ',array('class'=>'pull-right'));?>
    </div>
  </div>
<?=form_close();?>
<?=validation_errors('<div class="alert alert-warning">', '</div>');?>
