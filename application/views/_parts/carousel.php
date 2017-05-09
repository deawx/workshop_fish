<?php if ( ! $this->uri->segment('1') || $this->uri->segment('1') == 'main' && ! $this->uri->segment('2')) : ?>
  <?php $slideshow = isset($slideshow) ? (array)$slideshow : [] ; ?>
  <div id="blogCarousel" class="carousel slide">
    <div class="carousel-inner">
      <?php foreach ($slideshow as $_s => $s) : ?>
        <?php $active = ($_s == '1') ? 'active' : '' ; ?>
        <div class="item <?=$active;?>">
          <?=$s['picture'];?>
          <div class="carousel-caption">
            <?=$s['fullname'];?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <br/>
  <?=form_button('','&laquo;',['id'=>'btn-blog-prev','class'=>'btn btn-default']);?>
  <?=form_button('','&raquo;',['id'=>'btn-blog-next','class'=>'btn btn-default']);?>
  <hr/>
<?php endif; ?>
