<?php
$head = ((int)$id > 0) ? '<u>แก้ไขข้อมูลหัวข้อและสถานที่เลี้ยงปลา</u>' : '<u>เพิ่มข้อมูลหัวข้อและสถานที่เลี้ยงปลา</u>';
$hidden = ((int)$id > 0) ? array('id'=>$id,'date_modify'=>date('d/m/Y')) : array('member_id'=>$this->session->id,'fish_amount'=>count($all_fish),'date_create'=>date('d/m/Y'));
$form = [
  ['label'=>form_label('ชื่อหัวข้อที่ต้องการสื่อความหมาย','pool_title',array('class'=>'control-label text-right col-sm-3')),
  'input'=>form_input(array('name'=>'pool_title','class'=>'form-control','required'=>TRUE),set_value('pool_title',$compare['pool_title'])),
  'help'=>'']
];
echo form_open(uri_string(),array(),$hidden);
foreach ($all_fish as $_f => $f) :
  echo form_hidden('amount['.$f['id'].']','1');
endforeach;
?>
<div class="row">
  <div class="col-sm-4"> <?=anchor('compare','ย้อนกลับ',array('class'=>'btn btn-info btn-block'));?> </div>
  <div class="col-sm-8"> <?=form_submit('','บันทึกข้อมูลการเปรียบเทียบ',array('class'=>'btn btn-success btn-block'));?> </div>
</div>
<?=hr();?>
<?=heading('<u>รายการปลาที่เลือกทั้งหมด '.count($this->session->compare).' รายการ</u>','4');?>
<br>
<div class="row">
  <?php $ppfish = array();
  foreach ($fish as $_f => $f) :
    $ppfish[$_f]['fish'] = $f;
    $ppfish[$_f]['feed'] = $this->db->where('id',$f['feed_id'])->get('feed')->row_array();
    $ppfish[$_f]['nature'] = $this->db->where('id',$f['nature_id'])->get('nature')->row_array();
    $ppfish[$_f]['living'] = $this->db->where('id',$f['living_id'])->get('living')->row_array();
    $ppfish[$_f]['container'] = $this->db->where('id',$f['container_id'])->get('container')->row_array();
    $ppfish[$_f]['halo'] = $this->db->where('id',$f['halo_id'])->get('halo')->row_array();
    $ppfish[$_f]['day'] = $this->db->where('id',$f['day_id'])->get('day')->row_array();
    $ppfish[$_f]['element'] = $this->db->where('id',$f['element_id'])->get('element')->row_array();
    $ppfish[$_f]['amount'] = $this->db->where('id',$f['amount_id'])->get('amount')->row_array();
    $ppfish[$_f]['sex'] = $this->db->where('id',$f['sex_id'])->get('sex')->row_array();
  endforeach; ?>
    <table class="table table-bordered">
      <tbody>
        <tr>
          <th style="width:20%;"></th>
          <td style="width:40%;"><?=img('assets/fish/'.$ppfish[0]['fish']['picture'],'',array('class'=>'img-responsive','style'=>'max-width:300px;max-height:300px;'));?></td>
          <td style="width:40%;"><?=(!isset($ppfish[1]))?'':img('assets/fish/'.$ppfish[1]['fish']['picture'],'',array('class'=>'img-responsive','style'=>'max-width:300px;max-height:300px;'));?></td>
        </tr>
        <tr> <th>ชื่อไทย</th> <td><?=$ppfish[0]['fish']['fullname'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['fish']['fullname'];?></td></tr>
        <tr> <th>ชื่อสามัญ</th> <td><?=$ppfish[0]['fish']['org_name'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['fish']['org_name'];?></td></tr>
        <tr> <th>ชื่อวิทยาศาสตร์</th> <td><?=$ppfish[0]['fish']['sci_name'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['fish']['sci_name'];?></td></tr>
        <tr> <th>ชื่อวงศ์</th> <td><?=$ppfish[0]['fish']['fam_name'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['fish']['fam_name'];?></td></tr>
        <tr> <th>ถิ่นอาศัย</th> <td><?=$ppfish[0]['fish']['local'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['fish']['local'];?></td></tr>
        <tr> <th>ลักษณะทั่วไป</th> <td><?=$ppfish[0]['fish']['detail'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['fish']['detail'];?></td></tr>
        <tr> <th>อาหาร</th> <td><?=$ppfish[0]['feed']['detail'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['feed']['detail'];?></td></tr>
        <tr> <th>อุปนิสัยของปลา</th> <td><?=$ppfish[0]['nature']['detail'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['nature']['detail'];?></td></tr>
        <tr> <th>การเลี้ยงปลาในตู้</th> <td><?=$ppfish[0]['living']['detail'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['living']['detail'];?></td></tr>
        <tr> <th>การตกแต่งตู้ปลา</th> <td><?=$ppfish[0]['container']['detail'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['container']['detail'];?></td></tr>
        <tr> <th>ปลามงคลเสริมบารมี</th> <td><?=$ppfish[0]['halo']['detail'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['halo']['detail'];?></td></tr>
        <tr> <th>วันมงคลเสริมบารมี</th> <td><?=$ppfish[0]['day']['detail'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['day']['detail'];?></td></tr>
        <tr> <th>ธาตุมงคลเสริมบารมี</th> <td><?=$ppfish[0]['element']['detail'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['element']['detail'];?></td></tr>
        <tr> <th>เพศมงคลเสริมบารมี</th> <td><?=$ppfish[0]['sex']['detail'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['sex']['detail'];?></td></tr>
        <tr> <th>จะนวนปลาที่ควรเลี้ยง</th> <td><?=$ppfish[0]['amount']['detail'];?></td> <td><?=(!isset($ppfish[1]))?'':$ppfish[1]['amount']['detail'];?></td></tr>
      </tbody>
    </table>
</div>
<div class="row"> <?=$this->pagination->create_links();?> </div>
<hr>
<?=heading($head,'4');?>
<br>
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
