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
    <div class="panel-heading"> <?=heading('ธาตุมงคลเสริมบารมี','3',array('class'=>'panel-title'));?> </div>
    <div class="panel-body">
      <?php foreach ($element as $n) :
        $checked = isset($element_id) ? ((in_array($n['id'],$element_id)) ? TRUE : '') : '';
        echo form_checkbox(array('name'=>'element_id[]'),$n['id'],$checked).$n['name'].br();
        endforeach; ?>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading"> <?=heading('จำนวนปลาที่ควรเลี้ยง','3',array('class'=>'panel-title'));?> </div>
    <div class="panel-body">
      <?php foreach ($amount as $n) :
        $checked = isset($amount_id) ? ((in_array($n['id'],$amount_id)) ? TRUE : '') : '';
        echo form_checkbox(array('name'=>'amount_id[]'),$n['id'],$checked).$n['name'].br();
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
    <div class="panel-heading"> <?=heading('การเข้าสังคม','3',array('class'=>'panel-title'));?> </div>
    <div class="panel-body">
      <?php foreach ($living as $n) :
        $checked = isset($living_id) ? ((in_array($n['id'],$living_id)) ? TRUE : '') : '';
        echo form_checkbox(array('name'=>'living_id[]'),$n['id'],$checked).$n['name'].br();
      endforeach; ?>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading"> <?=heading('การเลี้ยงปลาในตู้','3',array('class'=>'panel-title'));?> </div>
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
          <table class="table table-bordered table-hover">
            <thead> <tr> <th>รูปภาพ</th> <th>ชื่อไทย</th> <th>อายุโดยเฉลี่ย(เดือน)</th> <th></th> </tr> </thead>
            <tbody>
              <?php foreach ($this->session->userdata('compare') as $f) : ?>
                <tr>
                  <td><?=img('assets/fish/'.$f['picture'],'',array('class'=>'img-responsive','style'=>'width:80px;height:80px;'));?></td>
                  <td><?=heading(anchor('fish/'.$f['id'],$f['fullname']),'4');?></td>
                  <td><?=$f['fullage'];?></td>
                  <td><?=anchor('fish/compare/'.$f['id'],'ลบออกจากรายการเปรียบเทียบ',array('class'=>'btn btn-warning btn-block'));?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <div class="clearfix"></div>
          <?php echo anchor('compare','ยืนยัน!!! เพื่อไปยังรายการถัดไป &raquo',array('class'=>'btn btn-success btn-block'));?>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-body">
        <?=heading('<u>จำแนกจำนวน</u>','4');?>
        รายการปลาทั้งหมดที่มีคือ <?=$all_fish;?> รายการ <br>
        รายการปลาทั้งหมดที่ค้นหาคือ <?=$all_fish_search;?> รายการ <br>
        <?php
        $get = $this->input->get();
        unset($get['p']);
        $words = array('nature_id'=>'อุปนิสัยของปลา','feed_id'=>'การกินอาหาร','living_id'=>'การเลี้ยงปลาในตู้','container_id'=>'การตกแต่งตู้ปลา',
          'halo_id'=>'ปลามงคลเสริมบารมี','day_id'=>'วันมงคล','element_id'=>'ธาตุมงคล','amount_id'=>'ช่วงอายุมงคล','sex_id'=>'เพศมงคล');
        foreach ($get as $key => $value) : ?>
          รายการค้นหาจำแนกเป็น <u><?=$words[$key];?></u> จำนวน <?=count($value);?> รายการ<br>
          <?php $name = substr($key,0,-3);
          $column[$key] = array_column($fish,$key);
          $amount = array_count_values($column[$key]);
          foreach ($value as $_v => $v) :
            foreach ($$name as $_n => $n) :
              if (intval($n['id']) === intval($v)) : ?>
              <p style="text-indent:1em;">แบ่งเป็น <u><?=$n['name'];?></u> จำนวน <?=array_key_exists($v,$amount)?$amount[$v]:'0';?> รายการ</p>
          <?php endif;
            endforeach;
          endforeach;
        endforeach; ?>
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
  </div>
</div>
<div class="pull-right"> <?=$this->pagination->create_links();;?> </div>
