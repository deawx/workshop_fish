<?php
$action = isset($action) ? (string)$action : uri_string();
$class = isset($class) ? (string)$class : '';
$head = isset($head) ? (string)$head : '';
$form = isset($form) ? (array)$form : [];
$hidden = isset($hidden) ? (array)$hidden : [];
$anchor = isset($anchor) ? (array)$anchor : [];
?>
<?=form_open_multipart($action,array('class'=>$class,'data-toggle'=>'validator'),$hidden);?>
  <?=heading($head,'4').hr();?>
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
      <?php foreach ($anchor as $_a => $a) : ?>
        <?=anchor($a['link'],$a['name'],['class'=>'btn btn-link']);?>
      <?php endforeach; ?>
    </div>
  </div>
<?=form_close();?>
<?=validation_errors('<div class="alert alert-warning">', '</div>');?>
<?=$this->upload->display_errors('<div class="alert alert-warning">','</div>');?>
