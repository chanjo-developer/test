<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
 
 <?php if($user_object['user_level'] == 1 || $user_object['user_group'] == 1) { ?>
<style>
.custom-button {
        height: 40px !important;
        margin-left: 22.7%;
        border-radius: 0 !important;
    }
</style>
 <div class="row">
    <div class="col-lg-offset-1 col-lg-6">
        <?php echo $this->session->flashdata('msg');  ?>
    </div>
    <div class="col-lg-offset-1 col-lg-6">
      <?php echo form_open_multipart('inventory/excel_upload',array('class'=>''));?>
      <div class="form-group">
        <?php
         echo form_label('Choose Document to Upload','userfile');
         echo form_error('userfile');
         echo form_upload(['name' => 'userfile', 'id' => 'userfile',  'class' => 'form-control']);
        ?>
      </div>  
    </div>
    <div class="col-lg-3"><br>
        <button class="btn btn-danger custom-button" name="submit" type="submit"><i class="fa fa-upload"></i>Upload File</button>
      </div>
    
  </div>
<?php } ?>

<div class="row">
    <?php echo form_open( '',array( 'id'=>'form'));?>
    <style type="text/css">
        td.details-control {
            background: url('<?php echo base_url().'assets/plugins/advanced-datatable/images/details_open.png'?>') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('<?php echo base_url().'assets/plugins/advanced-datatable/images/details_close.png'?>') no-repeat center center;
        }
    </style>
    <table id="table" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Facility Name</th>
                <th>Make</th>
                <th>Model</th>
                <th>Age</th>
                <th>Functional Status</th>
               
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th>Facility Name</th>
                <th>Make</th>
                <th>Model</th>
                <th>Age</th>
                <th>Functional Status</th>

            </tr>
        </tfoot>
    </table>

</div>
    


<script type="text/javascript">
    function format(d) {
        // `d` is the original data object for the row
        var sOut = '<table cellspacing="0" class="table table-bordered">'
        sOut += '<thead>'
        sOut += '<tr>'
        sOut += '<th>Immunizing</br>Status</th>'
        sOut += '<th>Catchment</br> Population</th>'
        sOut += '<th>Live Births</br>Population</th>'
        sOut += '<th>Cold</br> Boxes</th>'
        sOut += '<th>Vaccine</br> Carriers</th>'
        sOut += '<th>Ice Packs</th>'
        sOut += '<th>KPLC Elec.</th>'
        sOut += '<th>FT-2</th>'
        sOut += '</tr>'
        sOut += '<thead>'
        sOut += '<tr>'
        sOut += '<td>' + d.functional_status + '</td>'
        sOut += '<td>' + d.catchment_pop + '</td>'
        sOut += '<td>' + d.live_birth_pop + '</td>'
        sOut += '<td>' + d.coldboxes + '</td>'
        sOut += '<td>' + d.vaccine_carriers + '</td>'
        sOut += '<td>' + d.ice_packs + '</td>'
        sOut += '<td>' + d.electricity + '</td>'
        sOut += '<td>' + d.ft2_availability + '</td>'
        sOut += '</tr>'
        sOut += '</table>';

        return sOut;
    }


    $(document).ready(function() {
        var rows_selected = [];
        var _url = "<?php echo base_url().'inventory/retrieve_inventory';?>";
        var table = $('#table').DataTable({
            "paging": true,
            "ajax": {
                "url": _url
            },
            "columns": [{
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": '',

                }, {
                    "orderable": false,
                    "data": "facility_name"
                }, {
                    "orderable": false,
                    "data": "Manufacturer"
                }, {
                    "orderable": false,
                    "data": "Model"
                }, {
                    "orderable": false,
                    "data": "age"
                }, {
                    "orderable": false,
                    "data": "working_status"
                }

            ],
            "order": [
                [1, 'asc']
            ]

        });

        // Add event listener for opening and closing details
        $('#table tbody').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });

      }); 

    function cl(logstring) {
        if (navigator.appVersion.indexOf("MSIE 8") == -1) {
            return console.log(logstring);
        }
    }
</script>
 
  <script type="text/javascript">
window.setTimeout(function() {
    $("#alert-message").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);
</script>
