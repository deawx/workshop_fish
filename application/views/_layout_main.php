<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('_parts/header'); ?>
<body>
  <?php $this->load->view('_parts/navigation'); ?>
  <div class="container">
    <?php $this->load->view('_parts/carousel'); ?>
    <div class="row">
      <?php $this->load->view('_parts/alert'); ?>
      <div class="col-lg-12">
        <?=$content;?>
      </div>
    </div>
  </div>
  <?php $this->load->view('_parts/footer'); ?>
</body>
</html>
