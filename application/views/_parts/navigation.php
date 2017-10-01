<nav class="navbar <?=(in_array('admin',$this->uri->segment_array()) || in_array('admin',$this->uri->segment_array()))?'navbar-default':'navbar-inverse';?>">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">*</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <?php if (in_array('admin',$this->uri->segment_array())) : ?>
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <?=anchor('#','ข้อมูลสมาชิก <span class="caret"></span>',['class'=>'dropdown-toggle','data-toggle'=>'dropdown']);?>
            <ul class="dropdown-menu">
              <li><?=anchor('admin/member/create','เพิ่มข้อมูลสมาชิก');?></li>
              <li><?=anchor('admin/member','รายการข้อมูลสมาชิก');?></li>
            </ul>
          </li>
          <li class="dropdown">
            <?=anchor('#','ข้อมูลปลาสวยงาม <span class="caret"></span>',['class'=>'dropdown-toggle','data-toggle'=>'dropdown']);?>
            <ul class="dropdown-menu">
              <li><?=anchor('admin/fish/fish','บันทึกข้อมูลปลาสวยงาม');?></li>
              <li><?=anchor('admin/fish/nature','บันทึกข้อมูลอุปนิสัย');?></li>
              <li><?=anchor('admin/fish/feed','บันทึกข้อมูลการกินอาหาร');?></li>
              <li><?=anchor('admin/fish/living','บันทึกข้อมูลการอยู่อาศัย');?></li>
              <li><?=anchor('admin/fish/container','บันทึกข้อมูลสภาพแวดล้อมที่เหมาะสม');?></li>
              <li><?=anchor('admin/fish/halo','บันทึกข้อมูลการเสริมบารมี');?></li>
              <li><?=anchor('admin/fish','รายการข้อมูลปลาสวยงาม');?></li>
            </ul>
          </li>
          <li><?=anchor('admin/config/about','ข้อมูลการติดต่อ');?></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><?=anchor('','กลับหน้าหลัก');?></li>
        </ul>
      <?php elseif (in_array('member',$this->uri->segment_array())): ?>
        <ul class="nav navbar-nav navbar-right">
          <li><?=anchor('','กลับหน้าหลัก');?></li>
        </ul>
      <?php else: ?>
        <ul class="nav navbar-nav">
          <li><?=anchor('','หน้าหลัก');?></li>
          <li class="<?=(in_array('fish',$this->uri->segment_array()))?'active':'';?>"><?=anchor('fish','รายการปลาสวยงามน้ำจืด');?></li>
          <li class="<?=(in_array('webboard',$this->uri->segment_array()))?'active':'';?>"><?=anchor('webboard','เว็บบอร์ดให้ความรู้ปลาสวยงาม');?></li>
          <li class="<?=(in_array('about',$this->uri->segment_array()))?'active':'';?>"><?=anchor('main/about','ติดต่อเรา');?></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php if ($this->session->userdata('is_login')) : ?>
            <li class="dropdown">
              <?=anchor('#',$this->session->fullname.nbs(2).'<span class="caret"></span>',['class'=>'dropdown-toggle','data-toggle'=>'dropdown']);?>
              <ul class="dropdown-menu">
                <li><?=anchor('member/profile/'.$this->session->id,'ข้อมูลทั่วไป');?></li>
                <li><?=anchor('member/change_password/'.$this->session->id,'เปลี่ยนรหัสผ่าน');?></li>
                <?php if ($this->session->role == 'admin') : ?>
                  <li role="separator" class="divider"></li>
                  <li><?=anchor('admin/member','ระบบผู้ดูแล');?></li>
                <?php endif; ?>
                <li role="separator" class="divider"></li>
                <li><?=anchor('member/signout','ออกจากระบบ');?></li>
              </ul>
            </li>
          <?php else: ?>
            <li><?=anchor('member/signin','เข้าสู่ระบบ');?></li>
          <?php endif; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</nav>
