<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
 
 

 <div class="row">
    <div class="col-lg-3">
      <?php echo form_open_multipart('inventory/excel_upload',array('class'=>''));?>
      <div class="form-group">
        <?php
         echo form_label('Choose Document to Upload','userfile');
         echo form_error('userfile');
         echo form_upload(['name' => 'userfile', 'id' => 'userfile',  'class' => 'form-control']);
        ?>
      </div>
      <div >
      <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">Upload File</button>
      </div>
      
    </div>
    <div class="col-lg-6">
      <?php echo $this->session->flashdata('msg');  ?>
    </div>
  </div>

  <script type="text/javascript">
window.setTimeout(function() {
    $("#alert-message").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);
</script>
