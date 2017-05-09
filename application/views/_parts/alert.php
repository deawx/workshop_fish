<?php if ($this->session->flashdata()) : ?>
  <div class="alert alert-<?=$this->session->flashdata('class');?> alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>*</strong> <?=$this->session->flashdata('value');?>
  </div>
<?php endif; ?>
