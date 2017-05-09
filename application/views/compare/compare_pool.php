<?php
$head = ((int)$id > 0) ? '<u>แก้ไขข้อมูลหัวข้อและสถานที่เลี้ยงปลา</u>' : '<u>เพิ่มข้อมูลหัวข้อและสถานที่เลี้ยงปลา</u>';
$hidden = ((int)$id > 0) ? array('id'=>$id,'date_modify'=>date('d/m/Y')) : array('member_id'=>$this->session->id,'fish_amount'=>count($fish),'date_create'=>date('d/m/Y'));
$form = [
  ['label'=>form_label('ชื่อหัวข้อที่ต้องการสื่อความหมาย','pool_title',array('class'=>'control-label text-right col-sm-3')),
  'input'=>form_input(array('name'=>'pool_title','class'=>'form-control','required'=>TRUE),set_value('pool_title',$compare['pool_title'])),
  'help'=>''],
  ['label'=>form_label('รูปร่างบ่อเลี้ยงปลา','pool_shape',array('class'=>'control-label text-right col-sm-3')),
  'input'=>form_input(array('name'=>'pool_shape','class'=>'form-control','required'=>TRUE),set_value('pool_shape',$compare['pool_shape'])),
  'help'=>''],
  ['label'=>form_label('คุณลักษณะบ่อเลี้ยงปลา','pool_detail',array('class'=>'control-label text-right col-sm-3')),
  'input'=>form_textarea(array('name'=>'pool_detail','class'=>'form-control','required'=>TRUE),set_value('pool_detail',$compare['pool_detail'])),
  'help'=>''],
  ['label'=>form_label('ข้อมูลทางความเชื่อ','pool_believe',array('class'=>'control-label text-right col-sm-3')),
  'input'=>form_textarea(array('name'=>'pool_believe','class'=>'form-control','required'=>TRUE),set_value('pool_believe',$compare['pool_believe'])),
  'help'=>'']
];
?>
<?=form_open(uri_string(),array(),$hidden);?>
<div class="row">
  <div class="col-sm-4">
    <?=anchor('compare','ย้อนกลับ',array('class'=>'btn btn-info btn-block'));?>
  </div>
  <div class="col-sm-8">
    <?=form_submit('','บันทึกข้อมูลการเปรียบเทียบ',array('class'=>'btn btn-success btn-block'));?>
  </div>
</div>
<?=hr();?>
<?=heading('<u>รายการปลาที่เลือกทั้งหมด</u>','4');?>
<div class="row">
  <?php foreach ($fish as $_f => $f) : ?>
    <div class="col-md-3 portfolio-item" style="min-height:350px;">
      <div class="thumbnail">
        <?=img('assets/fish/'.$f['picture'],'',array('class'=>'img-responsive','style'=>'width:200px;height:100px;'));?>
        <caption><?=heading($f['fullname'],'5');?></caption>
        <?=form_number(array('name'=>'amount['.$f['id'].']','class'=>'form-control','placeholder'=>'จำนวน','required'=>TRUE));?>
        <br>
        <div class="panel panel-warning">
          <div class="panel-heading"><h3 class="panel-title">คำแนะนำ</h3></div>
          <div class="panel-body">
            <?php
            $recommend = '';
            switch ($f['living_id']) :
              case '1':
                $recommend = '1ตัว เท่านั้น';
               break;
              case '2':
                $recommend = '1ตัว หรือ 1คู่ เท่านั้น';
               break;
              case '3':
                $recommend = 'มากกว่า 1ตัว ก็ได้';
               break;
              case '4':
                $recommend = 'เลี้ยงเป็นกลุ่ม 2ตัว ขึ้นไปเท่านั้น';
               break;
             default:
                $recommend = 'ตามความเหมาะสม';
               break;
            endswitch;
            ?>
            <?php echo $recommend; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<br/>
<?=heading($head,'4');?>
<?php foreach ($form as $_f => $f) : ?>
  <div class="form-group">
    <?=$f['label'];?>
    <div class="col-sm-9">
      <?=$f['input'];?>
      <span class="help-block"><?=$f['help'];?></span>
    </div>
  </div>
<?php endforeach; ?>
<?=form_close();?>
