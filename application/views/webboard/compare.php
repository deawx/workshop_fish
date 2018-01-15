<?php if ($this->uri->segment(3) > 0) : ?>
  <?php //$edit = ($this->session->id == $member_id['id'] || $this->session->role == 'admin') ? anchor('webboard/compare_edit/'.$compare['id'],'แก้ไข',array('class'=>'btn btn-warning pull-right')) :'';?>
  <?php $edit = '';?>
  <?php $delete = ($this->session->id == $member_id['id'] || $this->session->role == 'admin') ? anchor('webboard/delete_compare/'.$compare['id'],'ลบ',array('class'=>'btn btn-danger pull-right','onclick'=>"return confirm('ต้องการลบหัวข้อนี้?');")) :'';?>

  <?=anchor('#','ย้อนกลับ',array('class'=>'btn btn-info','onclick'=>'history.back(); return false;'));?>

  <div class="panel panel-primary">
    <div class="panel-heading"> <?=heading($compare['pool_title'],'3',array('class'=>'panel-title')).$delete.$edit;?> </div>
    <div class="panel-body">
      <p>
        โพสต์เมื่อ <?=$compare['date_create'].' : ';?>
        แก้ไขเมื่อ <?=$compare["date_modify"].' : ';?>
        โดย <?=(isset($member_id['id'])) ? anchor_popup('member/profile/'.$member_id['id'],$member_id['fullname']) : 'บุคคลทั่วไป';?>
       </p>
      <?=heading('<u>รายการปลาทั้งหมด</u>','4');?>
      <div class="col-sm-12">
        <?php foreach ($compare_detil as $c) :
            $fish = $this->db->get_where('fish',array('id'=>$c['fish_id']))->row_array();
            $feed = $this->db->where('id',$fish['feed_id'])->get('feed')->row_array();
            $nature = $this->db->where('id',$fish['nature_id'])->get('nature')->row_array();
            $living = $this->db->where('id',$fish['living_id'])->get('living')->row_array();
            $container = $this->db->where('id',$fish['container_id'])->get('container')->row_array();
            $halo = $this->db->where('id',$fish['halo_id'])->get('halo')->row_array();
            $day = $this->db->where('id',$fish['day_id'])->get('day')->row_array();
            $element = $this->db->where('id',$fish['element_id'])->get('element')->row_array();
            $amount = $this->db->where('id',$fish['amount_id'])->get('amount')->row_array();
            $sex = $this->db->where('id',$fish['sex_id'])->get('sex')->row_array();
            ?>
            <table class="table table-bordered">
              <tbody>
                <tr> <td colspan="2"><?=img('assets/fish/'.$fish['picture'],'',array('class'=>'img-responsive','style'=>'width:400px;height:250px;margin:0px auto;'));?></td> </tr>
                <tr> <th style="width:20%;">ชื่อไทย</th> <td><?=$fish['fullname'];?></td> </tr>
                <tr> <th>ชื่อสามัญ</th> <td><?=$fish['org_name'];?></td> </tr>
                <tr> <th>ชื่อวิทยาศาสตร์</th> <td><?=$fish['sci_name'];?></td> </tr>
                <tr> <th>ชื่อวงศ์</th> <td><?=$fish['fam_name'];?></td> </tr>
                <tr> <th>ถิ่นอาศัย</th> <td><?=$fish['local'];?></td> </tr>
                <tr> <th>ลักษณะทั่วไป</th> <td><?=$fish['detail'];?></td> </tr>
                <tr> <th>อาหาร</th> <td><?=$feed['detail'];?></td> </tr>
                <tr> <th>อุปนิสัยของปลา</th> <td><?=$nature['detail'];?></td> </tr>
                <tr> <th>การเข้าสังคม</th> <td><?=$living['detail'];?></td> </tr>
                <tr> <th>การตกแต่งตู้ปลา</th> <td><?=$container['detail'];?></td> </tr>
                <tr> <th>ปลามงคลเสริมบารมี</th> <td><?=$halo['detail'];?></td> </tr>
                <tr> <th>วันมงคลเสริมบารมี</th> <td><?=$day['detail'];?></td> </tr>
                <tr> <th>ธาตุมงคลเสริมบารมี</th> <td><?=$element['detail'];?></td> </tr>
                <tr> <th>เพศมงคลเสริมบารมี</th> <td><?=$sex['detail'];?></td> </tr>
                <tr> <th>จะนวนปลาที่ควรเลี้ยง</th> <td><?=$amount['detail'];?></td> </tr>
            </tbody>
          </table>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <div class="col-sm-offset-1">
    <?php foreach ($comments as $_n => $n) : ?>
      <div class="panel panel-info">
        <?php $commented_by = $this->db->get_where('member',array('id'=>$n['commented_by']))->row_array(); ?>
        <div class="panel-heading">
          <?=($this->session->role === 'admin' OR $this->session->id === $commented_by['id']) ? anchor('webboard/delete_compare_comment/'.$n['id'],'ลบ',array('class'=>'btn btn-warning pull-right','onclick'=>"return confirm('ลบคอมเม้นต์นี้ ?');")) : '';?>
          <?=heading("โพสต์เมื่อ ".$n["date_create"].' : '.'แก้ไขเมื่อ '.$n["date_modify"].' : '."โดย ".anchor_popup("member/profile/".$commented_by["id"],$commented_by["fullname"]),'4',array('class'=>'panel-pool_title'));?>
        </div>
        <div class="panel-body">
          <?=$n['detail'];?>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="pull-right"><?=$this->pagination->create_links();?></div>
    <?=br(4);?>
  </div>
  <?php if ($this->session->is_login === TRUE) : ?>
    <div class="well">
      <?=form_open(uri_string(),array('class'=>'form-horizontal'),array('compare_id'=>$compare['id'],'commented_by'=>$this->session->id,'date_create'=>date('d/m/Y H:i:s')));?>
      <?=heading('คอมเม้นต์','4').hr();?>
      <div class="form-group">
        <?=form_label(ucfirst('เนื้อหา'),'detail',['class'=>'control-label text-right col-sm-3']);?>
        <div class="col-sm-9">
          <?=form_textarea(['name'=>'detail','class'=>'form-control','required'=>TRUE]);?>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-3">
          <?=form_submit('','ยืนยัน',['class'=>'col-sm-2 btn btn-success','autocomplete'=>'off']);?>
          <?=form_reset('','ยกเลิก',['class'=>'btn btn-link','autocomplete'=>'off']);?>
        </div>
      </div>
      <?=form_close();?>
      <?=validation_errors('<div class="alert alert-warning">', '</div>');?>
    </div>
  <?php endif; ?>

<?php else: ?>

  <div class="col-md-12">
    <div class="col-md-3"> <?=anchor('#','ย้อนกลับ',array('class'=>'btn btn-info','onclick'=>'history.back(); return false;'));?> </div>
    <div class="col-md-9">
      <?=form_open('',['method'=>'get']);?>
      <div class="input-group">
        <?=form_input(['name'=>'search','class'=>'form-control']);?>
        <div class="input-group-addon">
          <?=form_submit('','ค้นหา');?>
        </div>
      </div>
      <?=form_close();?>
    </div>
  </div>
  <div class="col-md-12">
    <hr>
    <?=heading('ข้อมูลการเลี้ยงปลาตามความเชื่อจากพี่น้อง','4').hr();?>
    <?php foreach ($compare as $_n => $n) : ?>
      <div class="panel panel-success">
        <?php $comments = $this->db->where('webboard_id',$n['id'])->count_all_results('webboard_comment');?>
        <?php $member_id = $this->db->get_where('member',array('id'=>$n['member_id']))->row_array();?>
        <div class="panel-heading">
          <p class="panel-title"> <?=anchor('webboard/compare/'.$n['id'],character_limiter($n['pool_title'],'100'));?> </p>
        </div>
        <div class="panel-body"> <?=character_limiter($n['pool_detail'],'150');?> </div>
        <div class="panel-footer">
          <span>โพสต์เมื่อ <?=$n['date_create'];?> : </span>
          <span>แก้ไขเมื่อ <?=$n['date_modify'];?> : </span>
          <span>ผู้ประกาศ <?=(isset($member_id['id'])) ? anchor_popup('member/profile/'.$member_id['id'],$member_id['fullname']) : 'บุคคลทั่วไป';?></span>
          <?=nbs(5).'<span class="label label-info">ผู้ตอบ '.$comments.'</span>';?>
          <?=nbs(5).'<span class="label label-info">ผู้อ่าน '.$n['views'].'</span>';?>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="pull-right"><?=$this->pagination->create_links();?></div>
  </div>

<?php endif; ?>
