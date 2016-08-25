<div class="row">
    <div class="col-lg-12">
        <?php
        $form_attributes = array('id' => 'request_form', 'method' => 'post', 'class' => '', 'role' => 'form');
        echo form_open('', $form_attributes); ?>

        <div class="well well-sm"><b>Request Details</b></div>

        <div class="row">
            <div class="col-lg-4">
                <div class="panel-body">
                    <b>Requestor's Name</b><br>
                    <?php $data = array('name' => 'requestor', 'id' => 'requestor', 'class' => 'form-control', 'value' =>$user_object['user_fname'] . ' ' . $user_object['user_lname'], 'readonly' => '');
                    echo form_input($data); ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel-body">
                    <b>Send order to</b><br>
                    <?php $data = array('name' => 'to_from', 'id' => 'to_from', 'class' => 'form-control', 'readonly' => '', 'value' => $user_object['statiton_above']);
                    echo form_input($data); ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel-body">
                    <b>Today's Date</b><br>
                    <?php $data = array('name' => 'date', 'id' => 'date', 'class' => 'form-control', 'readonly' => '', 'value' => date('Y-m-d', strtotime(date('Y-m-d'))));
                    echo form_input($data); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="panel-body">
                    <b>Lead Time</b><br>
                    <?php $data = array('name' => 'time', 'id' => 'time', 'class' => 'form-control', 'value' =>'', 'readonly' => '');
                    echo form_input($data); ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel-body">
                    <b>Last Order Date</b><br>
                    <?php $data = array('name' => 'time', 'id' => 'time', 'class' => 'form-control', 'value' =>'', 'readonly' => '');
                    echo form_input($data); ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel-body">
                    
                </div>
            </div>
        </div>
        <input type="hidden" name="transaction_type" class="transaction_type" value="1">
        <br/>

        <div class="table-responsive">
            <div class="well well-sm"><b>Vaccine Details</b></div>

            <div id="request_table">

                <table class="table table-bordered table-hover table-striped">
                    <thead>

                    <th align="center">Vaccine/Diluents</th>
                    <th align="center">Stock In Hand</th>
                    <th align="center">Minimum Stock</th>
                    <th align="center">Maximum Stock</th>
                    <th align="center">Quantity</th>
                    
                    </thead>
                    <tbody>

                   
                        <?php foreach ($quantities as $key => $value) {?>
                        <tr align="center">  
                       
                        <td class="col-xs-2"><?php echo $key; ?></td>
                       
                        <td hidden><?php $data = array('name' => 'vaccine', 'id' => 'vaccine', 'class' => 'form-control vaccine', 'readonly' => '', 'value' => $value['vaccine_id']);
                        echo form_input($data); ?> </td>

                        <td class="col-xs-2"><?php $data = array('name' => 'current_stock', 'id' => 'current_stock', 'class' => 'form-control current_stock', 'readonly' => '', 'value' => $value['current_stock']);
                        echo form_input($data); ?> </td>
                        
                        <td class="col-xs-2"><?php $data = array('name' => 'min_stock', 'id' => 'min_stock', 'class' => 'form-control min_stock', 'readonly' => '', 'value' => $value['min_stock']);
                        echo form_input($data); ?> </td>

                        <td class="col-xs-2"><?php $data = array('name' => 'max_stock', 'id' => 'max_stock', 'class' => 'form-control max_stock', 'readonly' => '', 'value' => $value['max_stock']);
                        echo form_input($data); ?> </td>


                        <td class="col-xs-2"><?php $data = array('name' => 'quantity', 'id' => 'quantity', 'class' => 'form-control quantity', 'type' => 'number', 'required' => '', 'min' => '0', 'value' => $value['order']);
                        echo form_input($data); ?> </td>
                        </tr>
                    <?php } ?> 
                    

                    </tbody>
                </table>

                <?php echo form_hidden('transaction_date', date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'))));  ?>
            </div>

            <input type="button" name="btn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-danger" value="Submit"/>

            <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            Confirm Submit
                        </div>
                        <div class="modal-body">
                            Are you sure you want to submit the entered details?
                        <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
                               <button type="submit" name="stock_received" id="stock_received" class="btn btn-sm btn-danger"><i class="fa fa-paper-plane"></i>&nbsp;Submit<img id="loader" src="<?php echo base_url() ?>assets/images/loader.gif" alt="loading image" hidden></button>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            

            <?php
            echo form_close(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">


    $("#request_form").submit(function (e) {
        $('.fa').removeClass("fa-paper-plane");
        $(this).find("button[type='submit']").prop('disabled',true);
        $(this).find("button[type='submit']").css('background','#fff');
        $(this).find("button[type='submit']").css('cursor','not-allowed');

        e.preventDefault();//STOP default action
        var vaccine_count = 0;
        $.each($(".vaccine"), function (i, v) {
            vaccine_count++;
        });

        
        // var formURL = "";
        var formURL = "<?php echo base_url();?>order/save_request";

        var to_from = retrieveFormValues('to_from');
        var transaction_date = retrieveFormValues('transaction_date');
        var vaccines = retrieveFormValues_Array('vaccine');
        var quantity = retrieveFormValues_Array('quantity');
        var current = retrieveFormValues_Array('current_stock');
        var max = retrieveFormValues_Array('max_stock');
        var min = retrieveFormValues_Array('min_stock');

        var dat = new Array();
        var get_requestor = requestor;
        var get_to_from = to_from;
        var get_transaction_date = transaction_date;

        for (var i = 0; i < vaccine_count; i++) {
            var data = new Array();
            var get_vaccine = vaccines[i];
            var get_quantity = quantity[i];
            var get_current = current[i];
            var get_max = max[i];
            var get_min = min[i];
    


            data = {
                "vaccine_id": get_vaccine,
                "quantity" : get_quantity,
                "current" : get_current,
                "max_stock" : get_max,
                "min_stock" : get_min   
            };
            dat.push(data);
        }
        batch = JSON.stringify(dat);
       
        $.ajax(
            {
                url: formURL,
                type: "POST",
                data: {
                    "transaction_date": get_transaction_date,
                    "to_from": get_to_from,
                    "batch": batch
                },
                beforeSend: function(){
                    $('#send').prop("hidden", true);
                    $('#cancel').prop("disabled", true);
                    $('#send').prop("disabled", true);
                    $('#loader').css('display','inline');
                   
                },
                success: function (data, textStatus, jqXHR) {
                    //data: return data from server
                    window.open('<?php echo base_url() . 'order/download_order_sheet'?>');
                    window.location.replace('<?php echo base_url() . 'order/list_orders'?>');


                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                }
            });

        // e.unbind(); //unbind. to stop multiple form submit.
    });

    function retrieveFormValues_Array(name) {
        var dump = new Array();
        var counter = 0;
        $.each($("input[name=" + name + "], select[name=" + name + "]"), function (i, v) {
            var theTag = v.tagName;
            var theElement = $(v);
            var theValue = theElement.val();
            /*dump[counter] = theElement.attr("value");*/
            dump[counter] = theValue;

            counter++;
        });
        return dump;
    }

    function retrieveFormValues(name) {
        var dump;
        $.each($("input[name=" + name + "], select[name=" + name + "]"), function (i, v) {
            var theTag = v.tagName;
            var theElement = $(v);
            var theValue = theElement.val();
            dump = theValue;
        });
        return dump;
    }

    
    function retrieveCommentValues_Array(name) {
        var dump = new Array();
        var counter = 0;
         $.each($("textarea[name=" + name + "]"), function (i, v) {
            var theTag = v.tagName;
            var theElement = $(v);
            var theValue = theElement.val();
            /*dump[counter] = theElement.attr("value");*/
            dump[counter] = theValue;

            counter++;
        });
        return dump;
    }

    window.onbeforeunload = function () {

    }

</script>