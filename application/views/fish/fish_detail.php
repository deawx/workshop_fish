<div class="row">
  <div class="col-sm-8">
    <?=img('assets/fish/'.$fish['picture'],'',array('class'=>'img-responsive','style'=>'width:100%;height:300px;'));?>
    <div class="col-sm-12 panel panel-default">

      <?=heading('<u>ชื่อไทย</u> '.$fish['fullname'],'3');?>
      <?=heading('<u>ชื่อสามัญ</u> '.$fish['org_name'],'3');?>
      <?=heading('<u>ชื่อวิทยาศาสตร์</u> '.$fish['sci_name'],'3');?>
      <?=heading('<u>ชื่อวงศ์</u> '.$fish['fam_name'],'3');?>
      <?=br();?>

      <u>ถื่นอาศัย</u>
      <p style="text-indent:40px;line-height:1.8em;"><?=$fish['local'];?></p>
      <?=br();?>

      <u>ลักษณะทั่วไป</u>
      <p style="text-indent:40px;line-height:1.8em;"><?=$fish['detail'];?></p>
      <?=br();?>

      <u>อาหาร</u>
      <p style="line-height:1.8em;"><?=$feed['name'];?></p>
      <p style="text-indent:40px;line-height:1.8em;"><?=$feed['detail'];?></p>
      <?=br();?>

      <u>อุปนิสัยของปลา</u>
      <p style="line-height:1.8em;"><?=$nature['name'];?></p>
      <p style="text-indent:40px;line-height:1.8em;"><?=$nature['detail'];?></p>
      <?=br();?>

      <u>การเลี้ยงในตู้ปลา</u>
      <p style="line-height:1.8em;"><?=$living['name'];?></p>
      <p style="text-indent:40px;line-height:1.8em;"><?=$living['detail'];?></p>
      <?=br();?>

      <u>การตกแต่งตู้ปลา</u>
      <p style="line-height:1.8em;"><?=$container['name'];?></p>
      <p style="text-indent:40px;line-height:1.8em;"><?=$container['detail'];?></p>
      <?=br();?>

      <u>ปลามงคลเสริมบารมี</u>
      <p style="text-indent:40px;line-height:1.8em;"><?=$fish['believe'];?></p>
      <?=br();?>

    </div>
  </div>
  <div class="col-sm-4">
    <?php $lastpage = ($this->session->has_userdata('lastpage')) ? $this->session->lastpage : $this->agent->referrer(); ?>
    <?=anchor($lastpage,'ย้อนกลับ',array('class'=>'btn btn-default btn-block'));?>
    <?php if (array_key_exists($fish['id'],$this->session->compare)) : ?>
      <?=anchor('fish/compare/'.$fish['id'],'ลบออกจากรายการเปรียบเทียบ',array('class'=>'btn btn-warning btn-block'));?>
    <?php else: ?>
      <?=anchor('fish/compare/'.$fish['id'],'เพิ่มในรายการเปรียบเทียบ',array('class'=>'btn btn-primary btn-block'));?>
    <?php endif; ?>
    <?php if ($this->session->role === 'admin' || $this->session->id === $fish['member_id']) : ?>
      <?=anchor('fish/edit/'.$fish['id'],'แก้ไขข้อมูล',array('class'=>'btn btn-info btn-block'));?>
    <?php endif; ?>
    <?=br();?>
    <?=heading('<small>ขนาดความยาวสูงสุดโดยเฉลี่ย</small> '.$fish['fullsize'].' เซ็นติเมตร','4');?>
    <?=br();?>
    <?=heading('<small>อายุเฉลี่ยสูงสุด </small>'.$fish['fullage'].' ปี','4');?>
    <?=br(2).hr();?>
    <div class="col-sm-12">
      <ul class="list-group">
        <li class="list-group-item active">รารยการปลาที่น่าสนใจอื่นๆ</li>
        <?php foreach ($related as $r) : ?>
          <li class="list-group-item">
              <?=img('assets/fish/'.$r['picture'],'',array('class'=>'img-responsive','style'=>'width:300%;height:200px;'));?>
              <div class="caption">
                <?=heading(anchor('fish/'.$r['id'],$r['fullname']),'3');?>
                <p><?='<small>ขนาดความยาวสูงสุดโดยเฉลี่ย </small>'.$r['fullsize'].' เซ็นติเมตร';?></p>
                <p><?='<small>อายุเฉลี่ยสูงสุด </small>'.$r['fullage'].' ปี';?></p>
              </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
