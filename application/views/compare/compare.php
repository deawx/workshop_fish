<?php
$nature3 = array();
$nature4 = array();
$nature5 = array();
foreach ($fish as $_f => $f) :
  if ($f['nature_id'] === '3') :
    $nature3[] = $f;
  endif;
  if ($f['nature_id'] === '4') :
    $nature4[] = $f;
  endif;
  if ($f['nature_id'] === '5') :
    $nature5[] = $f;
  endif;
endforeach;
?>
<div class="row">
  <div class="col-sm-4"> <?=anchor('fish','ย้อนกลับ',array('class'=>'btn btn-info btn-block'));?> </div>
  <div class="col-sm-8"> <?php echo anchor('compare/compare_pool','เข้าสู่ขั้นตอนต่อไป &raquo',array('id'=>'btn-final','class'=>'btn btn-success btn-block')); ?> </div>
</div>
<?=hr();?>
<?=heading('<u>รายการปลาที่เลือกทั้งหมด มีดังนี้</u>','4');?>
<div class="row">
  <?php foreach ($fish as $_f => $f) : ?>
    <div class="col-md-2 portfolio-item">
      <?=anchor('fish/'.$f['id'],img('assets/fish/'.$f['picture'],'',array('class'=>'img-responsive','style'=>'width:200px;height:100px;')));?>
      <?=anchor('fish/compare/'.$f['id'],'ลบออกจากรายการ',array('class'=>'btn btn-warning btn-block'));?>
    </div>
  <?php endforeach; ?>
</div>
<br/>
<?=heading('<u>รายการปลาที่ไม่สามารถอยู่ร่วมกันได้ มีดังนี้</u>','4');?>
<div class="panel panel-warning">
  <div class="panel-heading"> <h3 class="panel-title">รายการปลาที่มีนิสัยก้าวร้าว</h3> </div>
  <div class="panel-body">
    <?php foreach ($nature3 as $_f => $f) : ?>
      <div class="media col-md-6 alert">
        <div class="media-left"><?=img('assets/fish/'.$f['picture'],'',array('class'=>'img-responsive','style'=>'width:150px;height:100px;'));?></div>
        <div class="media-body">
          <h4 class="media-heading"><?=$f['fullname'];?></h4>
          <?=p($f['feed_name']);?>
          <?=p($f['living_name']);?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<div class="panel panel-danger">
  <div class="panel-heading"> <h3 class="panel-title">รายการปลาที่มีนิสัยดุร้าย</h3> </div>
  <div class="panel-body">
    <?php foreach ($nature4 as $_f => $f) : ?>
      <div class="media col-md-6 alert">
        <div class="media-left"><?=img('assets/fish/'.$f['picture'],'',array('class'=>'img-responsive','style'=>'width:150px;height:100px;'));?></div>
        <div class="media-body">
          <h4 class="media-heading"><?=$f['fullname'];?></h4>
          <?=p($f['feed_name']);?>
          <?=p($f['living_name']);?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<div class="panel panel-danger">
  <div class="panel-heading"> <h3 class="panel-title">รายการปลาที่มีนิสัยหวงถิ่นอาศัย</h3> </div>
  <div class="panel-body">
    <?php foreach ($nature5 as $_f => $f) : ?>
      <div class="media col-md-6 alert">
        <div class="media-left"><?=img('assets/fish/'.$f['picture'],'',array('class'=>'img-responsive','style'=>'width:150px;height:100px;'));?></div>
        <div class="media-body">
          <h4 class="media-heading"><?=$f['fullname'];?></h4>
          <?=p($f['feed_name']);?>
          <?=p($f['living_name']);?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  if ($('.alert').length > 1) {
    $('#btn-final').on('click',function(){
      alert("พบรายการแจ้งเตือน! ปลาที่ไม่สามารถอยู่ร่วมกับปลาอื่นๆ ได้");
      return false;
    });
  }
});
</script>
