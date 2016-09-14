<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

echo $this->session->flashdata('msg'); 

$group = array();
$group[] = "Select One";
foreach ($magroups as $row) {
    $group[$row->id] = $row->name;

}
$level = array();
$level[] = "Select One";
foreach ($malevels as $row) {
    $level[$row->id] = $row->name;
}

$region = array();
$region[] = "Select One";
foreach ($maregion as $row) {
    $region[$row->id] = $row->region_name;
}


$nation = array('Select One', 'NVIP');
$national ="";
$regional ="";

?>


<div>
    <div class="panel-heading border login_heading">SIGN UP</div>
    <p>Please fill in the details to create an account.</p>  
    <?php echo form_open('users/register'); ?>

    <div class="form-group">
        <?php
        echo form_label('Enter First Name', 'f_name');
        echo form_error('f_name');
        echo form_input(['name' => 'f_name', 'id' => 'f_name', 'value' => '', 'required' => '', 'class' => 'form-control', 'placeholder' => 'Enter First Name']);?>
    </div>

    <div class="form-group">
        <?php
        echo form_label('Enter Last Name', 'l_name');
        echo form_error('l_name');
        echo form_input(['name' => 'l_name', 'id' => 'l_name', 'value' => '', 'required' => '', 'class' => 'form-control', 'placeholder' => 'Enter Last Name']);?>
    </div>

    <div class="form-group">
        <?php
        echo form_label('Enter Phone Number', 'phone');
        echo form_error('phone');
        echo form_input(['name' => 'phone', 'id' => 'phone', 'value' => '', 'required' => '', 'class' => 'form-control', 'placeholder' => 'Enter Phone Number']);?>
    </div>

    <div class="form-group">
        <?php
        echo form_label('Enter Email Address', 'email');
        echo form_error('email');
        echo form_input(['name' => 'email', 'id' => 'email', 'value' => '', 'required' => '', 'class' => 'form-control', 'placeholder' => 'Enter Email']);?>
    </div>

    <div class="form-group">
         <?php
        echo form_label('Enter User Name', 'username');
        echo form_error('username');
        echo form_input(['name' => 'username', 'id' => 'username', 'value' => '', 'required' => '', 'class' => 'form-control', 'placeholder' => 'Enter Username ']);?>
    </div>

    <div class="form-group">
        <?php
        echo form_label('Enter Password', 'password');
        echo form_error('password');
        echo form_password(['name' => 'password', 'id' => 'password', 'class' => 'form-control', 'required' => '', 'placeholder' => 'Enter Password']); ?>
    </div>

    <div class="form-group">
        <?php
        echo form_label('RE-Enter Password', 'password');
        echo form_error('password');
        echo form_password(['name' => 'passwordc', 'id' => 'passwordc', 'class' => 'form-control', 'required' => '', 'placeholder' => 'RE-Enter Password']);?>
    </div>

    <div class="form-group" id="user_group">
         <?php
        echo form_label('Enter User Group','user_group');
        echo form_error('user_group');
        echo form_dropdown('user_group', $group, 'id="user_group" class="form-control"');?>
        </div>
    </div>

    <div class="form-group" id="user_level">
        <?php
        echo form_label('Enter Access Level', 'user_level');
        echo form_error('user_level');
        echo form_dropdown('user_level', $level, 'id="user_level" class="form-control"'); ?>
         </div>
    </div>

    <div class="form-group" id="base1">
        <?php
        echo form_label('Enter National Base', 'national');
        echo form_error('national');
        echo form_dropdown('national', $nation,  'id="national" class="form-control"');?>
        </div>
    </div>
    <div class="form-group" id="base2">
        <?php
        echo form_label('Enter Regional Base ', 'regional');
        echo form_error('regional');
        echo form_dropdown('regional', $region, 'id="regional" class="form-control"');?>
    </div>
    <div class="form-group" id="base3">
        <?php echo form_label('Enter County Base'); 

        echo form_dropdown('countyuser', '', 'id="countyuser" class="form-control"');
        ?>
        
    </div>
    <div class="form-group" id="base4">
       <?php echo form_label('Enter Sub-county Base'); ?>
        <select name="subcountyuser" class="form-control" id="subcountyuser"></select>
    </div>
    <div class="form-group" id="base5">
        <?php echo form_label('Enter Facility Base'); ?>
            <select name="facilityuser" class="form-control" id="facilityuser"></select>
    </div>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        //start of user basestation assignment
        $("#base1").hide();
        $("#base2").hide();
        $("#base3").hide();
        $("#base4").hide();
        $("#base5").hide();

        $('#user_level select').change(function () {
            var selLevel = $(this).val();
            console.log(selLevel);

            if (selLevel == '1') {

                // console.log("Detected change... National");
                $("#base1").show();
                $("#base2").hide();
                $("#base3").hide();
                $("#base4").hide();
                $("#base5").hide();

            } else if (selLevel == '2') {
                // console.log("Detected change... Regional");
                $("#base1").show();
                $("#base2").show();
                $("#base3").hide();
                $("#base4").hide();
                $("#base5").hide();
            } else if (selLevel == '3') {
                // console.log("Detected change... County");
                $("#base1").show();
                $("#base2").show();
                $("#base3").show();
                $("#base4").hide();
                $("#base5").hide();


            } else if (selLevel == '4') {
                // console.log("Detected change... Subcounty");
                $("#base1").show();
                $("#base2").show();
                $("#base3").show();
                $("#base4").show();
                $("#base5").hide();
            } else if (selLevel == '5') {
                // console.log("Detected change... Facility");
                $("#base1").show();
                $("#base2").show();
                $("#base3").show();
                $("#base4").show();
                $("#base5").show();
            } else {
                //cleanup function

                $("#base1").hide();
                $("#base2").hide();
                $("#base3").hide();
                $("#base4").hide();
                $("#base5").hide();
            }

        });
        //End of user basestation assignment

    });


    $(document).ready(function () {
        $("#regional").change(function () {
            var regional = $(this).val();
            console.log(regional);
            var request = $.ajax({
                url: "<?php echo base_url(); ?>users/getCountyByRegion/" + regional,
                data: regional,
                type: "POST",
            });
            request.done(function (data) {
                data = JSON.parse(data);
                console.log(data);
                $("#countyuser option").remove();
                $('#countyuser').append("<option value=''>--Select County Base--</option> ");
                $.each(data, function (key, value) {
                    $('#countyuser').append("<option value='" + value.county_id + "'>" + value.county_name + "</option>");
                });
            });
            request.fail(function (jqXHR, textStatus) {
            });
        });
    });

    $(document).ready(function () {
        $("#countyuser").change(function () {
            var countyuser = $(this).val();
            console.log(countyuser);
            var request = $.ajax({
                url: "<?php echo base_url(); ?>users/getSubcountyByCounty/" + countyuser,
                data: countyuser,
                type: "POST",
            });
            request.done(function (data) {
                data = JSON.parse(data);
                console.log(data);
                $("#subcountyuser option").remove();
                $('#subcountyuser').append("<option value=''>--Select Sub County Base--</option> ");
                $.each(data, function (key, value) {
                    $('#subcountyuser').append("<option value='" + value.subcounty_id + "'>" + value.subcounty_name + "</option>");
                });
            });
            request.fail(function (jqXHR, textStatus) {
            });
        });
    });

    $(document).ready(function () {
        $("#subcountyuser").change(function () {
            var subcountyuser = $(this).val();
            console.log(subcountyuser);
            var request = $.ajax({
                url: "<?php echo base_url(); ?>users/getFacilityBySubcounty/" + subcountyuser,
                data: subcountyuser,
                type: "POST",
            });
            request.done(function (data) {
                data = JSON.parse(data);
                console.log(data);
                $("#facilityuser option").remove();
                $('#facilityuser').append("<option value=''>--Select Facility Base--</option> ");
                $.each(data, function (key, value) {
                    $('#facilityuser').append("<option value='" + value.facility_id + "'>" + value.facility_name + "</option>");
                });
            });
            request.fail(function (jqXHR, textStatus) {
            });
        });
    });

</script>

<script type="text/javascript">

    window.setTimeout(function () {
        $("#alert-message").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 5000);

</script>