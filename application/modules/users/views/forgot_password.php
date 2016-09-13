<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div>
    <div class="panel-heading border login_heading">Forgot Password</div>
    <p>Please enter your Email so we can send you an email to reset your password.</p>
    <?php 
        echo $this->session->flashdata('msg');
        echo form_open('users/forgot_password');?>
                    <div class="form-group">
                    <?php
                    echo form_label('Enter Email Address','email');
                    echo form_error('email');
                    echo form_input(['name' => 'email', 'id' => 'email', 'class' => 'form-control', 'required' => '']);
                    ?>
                    </div>
                    <br>
                    <div>   
                        <input type="submit" class="btn btn-lg btn-danger btn-block" value="Submit" name="submit">
                        <p style="padding-top:21px"><a href="<?php echo base_url()?>">Back to Login</a></p>
                    </div>

        <?php echo form_close();?>
</div>
<script type="text/javascript">
window.setTimeout(function() {
    $("#alert-message").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);

</script>
  