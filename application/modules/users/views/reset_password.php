<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div>
    <div class="panel-heading border login_heading">Reset Password</div>
    <p>Please enter your new password.</p>
    <?php 
        echo $this->session->flashdata('msg');
        echo form_open('users/reset_password');?>
                    <div class="form-group">
                    <?php
                    echo form_label('Enter New Password', 'password');
				    echo form_password(array('name' => 'password', 'required' => '','class' => 'form-control','placeholder' => 'Enter New Password'));
				    echo form_error('password');
                    ?>
                    </div>

                    <div class="form-group">
                    <?php
                    echo form_label('Confirm New Password', 'password');
				    echo form_password(array('name' => 'password', 'required' => '','class' => 'form-control', 'placeholder' => 'Confirm New Password'));
				    echo form_error('password');
                    ?>
                    </div>
                    <br>
                    <div>   
                        <input type="submit" class="btn btn-lg btn-danger btn-block" value="Save New Password" name="submit">
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
