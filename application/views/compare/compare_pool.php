<?php
$head = ((int)$id > 0) ? '<u>แก้ไขข้อมูลหัวข้อและสถานที่เลี้ยงปลา</u>' : '<u>เพิ่มข้อมูลหัวข้อและสถานที่เลี้ยงปลา</u>';
$hidden = ((int)$id > 0) ? array('id'=>$id,'date_modify'=>date('d/m/Y')) : array('member_id'=>$this->session->id,'fish_amount'=>count($all_fish),'date_create'=>date('d/m/Y'));
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
<?php echo form_open(uri_string(),array(),$hidden);
foreach ($all_fish as $_f => $f) :
  echo form_hidden('amount['.$f['id'].']','1');
endforeach; ?>
<div class="row">
  <div class="col-sm-4"> <?=anchor('compare','ย้อนกลับ',array('class'=>'btn btn-info btn-block'));?> </div>
  <div class="col-sm-8"> <?=form_submit('','บันทึกข้อมูลการเปรียบเทียบ',array('class'=>'btn btn-success btn-block'));?> </div>
</div>
<?=hr();?>
<?=heading('<u>รายการปลาที่เลือกทั้งหมด '.count($this->session->compare).' รายการ</u>','4');?>
<br>
<div class="row">
  <?php foreach ($fish as $_f => $f) :
    $feed = $this->db->where('id',$f['feed_id'])->get('feed')->row_array();
    $nature = $this->db->where('id',$f['nature_id'])->get('nature')->row_array();
    $living = $this->db->where('id',$f['living_id'])->get('living')->row_array();
    $container = $this->db->where('id',$f['container_id'])->get('container')->row_array();
    $halo = $this->db->where('id',$f['halo_id'])->get('halo')->row_array(); ?>
    <table class="table table-bordered">
      <tbody>
        <tr> <th>ชื่อไทย</th> <td><?=$f['fullname'];?></td> </tr>
        <tr> <th>ชื่อสามัญ</th> <td><?=$f['org_name'];?></td> </tr>
        <tr> <th>ชื่อวิทยาศาสตร์</th> <td><?=$f['sci_name'];?></td> </tr>
        <tr> <th>ชื่อวงศ์</th> <td><?=$f['fam_name'];?></td> </tr>
        <tr> <th>ถิ่นอาศัย</th> <td><?=$f['local'];?></td> </tr>
        <tr> <th>ลักษณะทั่วไป</th> <td><?=$f['detail'];?></td> </tr>
        <tr> <th>อาหาร</th> <td><?=$feed['detail'];?></td> </tr>
        <tr> <th>อุปนิสัยของปลา</th> <td><?=$nature['detail'];?></td> </tr>
        <tr> <th>การเลี้ยงปลาในตู้</th> <td><?=$living['detail'];?></td> </tr>
        <tr> <th>การตกแต่งตู้ปลา</th> <td><?=$container['detail'];?></td> </tr>
        <tr> <th>ปลามงคลเสริมบารมี</th> <td><?=$halo['detail'];?></td> </tr>
        <tr> <th>ต้องการเลี้ยงปลากี่ตัว</th>
          <td> <?php $recommend = '';
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
            echo $recommend; ?>
          </td>
        </tr>
      </tbody>
    </table>
  <?php endforeach; ?>
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
