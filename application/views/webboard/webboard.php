<?=heading(anchor('webboard/compare','ข้อมูลการเลี้ยงปลาตามความเชื่อจากพี่น้อง'),'4');?>
<?php foreach ($compare as $n) : ?>
  <?php $comments = $this->db->where('compare_id',$n['id'])->count_all_results('compare_comment');?>
  <?php $posted_by = $this->db->get_where('member',array('id'=>$n['member_id']))->row_array();?>
  <ul>
    <li>
      <?=anchor('webboard/compare/'.$n['id'],character_limiter($n['pool_title'],'100')).br();?>
      <span>โพสต์เมื่อ <?=$n['date_create'];?> : </span>
      <span>แก้ไขเมื่อ <?=$n['date_modify'];?> : </span>
      <span>ผู้ประกาศ <?=(isset($posted_by['id'])) ? anchor_popup('member/profile/'.$posted_by['id'],$posted_by['fullname']) : 'บุคคลทั่วไป';?></span>
      <?=nbs(5).'<span class="label label-info">ผู้ตอบ '.$comments.'</span>';?>
      <?=nbs(5).'<span class="label label-info">ผู้อ่าน '.$n['views'].'</span>'.hr();?>
    </li>
  </ul>
<?php endforeach; ?>
<br/>
<?=heading(anchor('webboard/forum','เว็บบอร์ดพี่น้องผู้นิยมการเลี้ยงปลาตามความเชื่อต่างๆ'),'4');?>
<?php foreach ($forum as $n) : ?>
  <?php $comments = $this->db->where('webboard_id',$n['id'])->count_all_results('webboard_comment');?>
  <?php $posted_by = $this->db->get_where('member',array('id'=>$n['posted_by']))->row_array();?>
  <ul>
    <li>
      <?=anchor('webboard/forum/'.$n['id'],character_limiter($n['title'],'100')).br();?>
      <p><?=character_limiter($n['detail'],'50');?></p><br/>
      <span>โพสต์เมื่อ <?=$n['date_create'];?> : </span>
      <span>แก้ไขเมื่อ <?=$n['date_modify'];?> : </span>
      <span>ผู้ถาม <?=anchor_popup('member/profile/'.$posted_by['id'],$posted_by['fullname']);?></span>
      <?=nbs(5).'<span class="label label-info">ผู้ตอบ '.$comments.'</span>';?>
      <?=nbs(5).'<span class="label label-info">ผู้อ่าน '.$n['views'].'</span>'.hr();?>
    </li>
  </ul>
<?php endforeach; ?>
