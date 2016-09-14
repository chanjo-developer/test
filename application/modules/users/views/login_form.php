<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="panel-heading border login_heading">SIGN IN</div> 
       <?php 
      echo $this->session->flashdata('msg');?>   
       <?php echo form_open('users/login_process');?>
         <div class="form-group">
              <?php
              echo form_label('Enter User Name','username');
              echo form_error('username');
              echo form_input(['name' => 'username', 'id' => 'username', 'class' => 'form-control', 'placeholder' => 'Enter Username', 'AutoComplete'=>'Off']);
              ?>
          </div>
    <div class="form-group">
              <?php
              echo form_label('Enter Password','password');
              echo form_error('modulename_name');
              echo form_password(['name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'Enter Password']);
              ?>
    </div>
      
      <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">LOGIN</button>
      <p style="padding-top:21px"><a href="<?php echo base_url('users/forgot_password')?>">Forgot Password</a></p>
    <?php echo form_close();?>
<script type="text/javascript">
window.setTimeout(function() {
    $("#alert-message").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);

</script>
