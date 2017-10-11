<div class="col-lg-3">
  <?php if ($this->session->is_login && $this->session->role === 'admin') : ?>
    <?php echo anchor('fish/create','เพิ่มข้อมูลปลาสวยงาม',array('class'=>'btn btn-primary btn-block')).br().hr();?>
  <?php endif; ?>
  <?=heading('<u>หมวดหมู่</u>','4');?>
  <?=form_open(uri_string(),array('method'=>'get'));?>
  <div class="panel panel-default">
    <div class="panel-heading"> <?=heading('ปลามงคลเสริมบารมี','3',array('class'=>'panel-title'));?> </div>
    <div class="panel-body">
      <?php foreach ($halo as $n) :
        $checked = isset($halo_id) ? ((in_array($n['id'],$halo_id)) ? TRUE : '') : '';
        echo form_checkbox(array('name'=>'halo_id[]'),$n['id'],$checked).$n['name'].br();
        endforeach; ?>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading"> <?=heading('เพศมงคลเสริมบารมี','3',array('class'=>'panel-title'));?> </div>
    <div class="panel-body">
      <?php foreach ($sex as $n) :
        $checked = isset($sex_id) ? ((in_array($n['id'],$sex_id)) ? TRUE : '') : '';
        echo form_checkbox(array('name'=>'sex_id[]'),$n['id'],$checked).$n['name'].br();
        endforeach; ?>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading"> <?=heading('วันมงคลเสริมบารมี','3',array('class'=>'panel-title'));?> </div>
    <div class="panel-body">
      <?php foreach ($day as $n) :
        $checked = isset($day_id) ? ((in_array($n['id'],$day_id)) ? TRUE : '') : '';
        echo form_checkbox(array('name'=>'day_id[]'),$n['id'],$checked).$n['name'].br();
        endforeach; ?>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading"> <?=heading('ช่วงอายุมงคลเสริมบารมี','3',array('class'=>'panel-title'));?> </div>
    <div class="panel-body">
      <?php foreach ($age as $n) :
        $checked = isset($age_id) ? ((in_array($n['id'],$age_id)) ? TRUE : '') : '';
        echo form_checkbox(array('name'=>'age_id[]'),$n['id'],$checked).$n['name'].br();
        endforeach; ?>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading"> <?=heading('อุปนิสัยของปลา','3',array('class'=>'panel-title'));?> </div>
    <div class="panel-body">
      <?php foreach ($nature as $n) :
        $checked = isset($nature_id) ? ((in_array($n['id'],$nature_id)) ? TRUE : '') : '';
        echo form_checkbox(array('name'=>'nature_id[]'),$n['id'],$checked).$n['name'].br();
      endforeach; ?>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading"> <?=heading('การเลี้ยงปลาในตู้','3',array('class'=>'panel-title'));?> </div>
    <div class="panel-body">
      <?php foreach ($living as $n) :
        $checked = isset($living_id) ? ((in_array($n['id'],$living_id)) ? TRUE : '') : '';
        echo form_checkbox(array('name'=>'living_id[]'),$n['id'],$checked).$n['name'].br();
      endforeach; ?>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading"> <?=heading('การตกแต่งตู้ปลา','3',array('class'=>'panel-title'));?> </div>
    <div class="panel-body">
      <?php foreach ($container as $n) :
        $checked = isset($container_id) ? ((in_array($n['id'],$container_id)) ? TRUE : '') : '';
        echo form_checkbox(array('name'=>'container_id[]'),$n['id'],$checked).$n['name'].br();
      endforeach; ?>
    </div>
  </div>
  <?=form_submit('','ค้นหาข้อมูลที่เลือก',array('class'=>'btn btn-info btn-block'));?>
  <?=form_close();?>
</div>
<div class="col-lg-9">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-body">
        <?=heading('<u>รายการปลาที่อยู่ในตู้</u>','4');?>
        <?php if ( ! is_null($this->session->userdata('compare')) && ! empty($this->session->userdata('compare'))) : ?>
          <?php foreach ($this->session->userdata('compare') as $f) : ?>
            <div class="col-sm-4 portfolio-item" style="height:250px;">
              <?=img('assets/fish/'.$f['picture'],'',array('class'=>'img-responsive','style'=>'width:350px;height:200px;'));?>
              <?=anchor('fish/compare/'.$f['id'],'ลบออกจากรายการเปรียบเทียบ',array('class'=>'btn btn-warning btn-block'));?>
            </div>
          <?php endforeach; ?>
          <div class="clearfix"></div>
          <?php echo anchor('compare/compare_pool','ยืนยัน!!! เพื่อไปยังรายการถัดไป &raquo',array('class'=>'btn btn-success btn-block'));?>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-body">
        <?=heading('<u>จำแนกจำนวน</u>','4');?>
        รายการปลาที่หมดที่มีคือ <?=$this->db->count_all_results('fish');?> รายการ
        <?php foreach ($fish as $f) : ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <div class="row">
    <table class="table table-bordered table-hover">
      <thead> <tr> <th>รูปภาพ</th> <th>ชื่อไทย</th> <th>อายุโดยเฉลี่ย(เดือน)</th> <th></th> </tr> </thead>
      <tbody>
        <?php foreach ($fish as $f) : ?>
          <tr>
            <td><?=img('assets/fish/'.$f['picture'],'',array('class'=>'img-responsive','style'=>'width:80px;height:80px;'));?></td>
            <td><?=heading(anchor('fish/'.$f['id'],$f['fullname']),'4');?></td>
            <td><?=$f['fullage'];?></td>
            <td>
              <?php if ( ! array_key_exists($f['id'],$this->session->compare)) : ?>
                <?=anchor('fish/compare/'.$f['id'],'เพิ่มในรายการเปรียบเทียบ',array('class'=>'btn btn-primary btn-block'));?>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php foreach ($fish as $f) : ?>
      <div class="col-sm-4 portfolio-item" style="height:422px;">
        <?=img('assets/fish/'.$f['picture'],'',array('class'=>'img-responsive','style'=>'width:350px;height:200px;'));?>
        <?php if ( ! array_key_exists($f['id'],$this->session->compare)) : ?>
          <?=anchor('fish/compare/'.$f['id'],'เพิ่มในรายการเปรียบเทียบ',array('class'=>'btn btn-primary btn-block'));?>
        <?php endif; ?>
        <?=heading(anchor('fish/'.$f['id'],$f['fullname']),'4');?>
        <?=p(character_limiter($f['detail'],'100'));?>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<div class="pull-right"> <?=$this->pagination->create_links();;?> </div>
