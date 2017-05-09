<?php foreach ($fish as $f) : ?>
  <div class="col-md-4 portfolio-item" style="min-height:400px;">
    <?=img('assets/fish/'.$f['picture'],'',array('class'=>'img-responsive','style'=>'width:350px;height:200px'));?>
    <?=heading(anchor('fish/'.$f['id'],$f['fullname']),'3');?>
    <p><?=character_limiter($f['detail'],'100');?></p>
  </div>
<?php endforeach; ?>
<div class="pull-right">
  <?=$this->pagination->create_links();;?>
</div>
