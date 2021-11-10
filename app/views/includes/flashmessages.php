<?php if ($this->session->flashdata('success-msg')) { ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('success-msg'); ?></div>
<?php } ?>
<?php if ($this->session->flashdata('error-msg')) { ?>
    <div class="alert alert-danger"><?php echo $this->session->flashdata('error-msg'); ?></div>
<?php } ?>