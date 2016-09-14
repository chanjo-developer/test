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
                <th>Matching Name</th>
                <th>
                    <input name="select_all" value="1" id="select-all" type="checkbox">
                </th>

            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th>Facility Name</th>
                <th>Matching Name</th>
                <th></th>

            </tr>
        </tfoot>
    </table>

    <div class="row">
        <div class="col-lg-offset-4 col-lg-3">
            <input type="button" name="btn" id = "send" data-toggle="modal" data-target="#confirm-submit" class="btn btn-danger" value="Submit"/>
        </div>
    </div>
    <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to submit the entered details?
            <div class="modal-footer">
                    <button type="button" name="cancel" id="cancel"class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" id="submit" class="btn btn-sm btn-danger"><i class="fa fa-paper-plane"></i>&nbsp;Submit<img id="loader" src="<?php echo base_url() ?>assets/images/loader.gif" alt="loading image" hidden></button>
                </div>
            </div>
        </div>
    </div>  
</div>
    <?php echo form_close();?>
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
        sOut += '<th>Make of</br> Equipment</th>'
        sOut += '<th>Model of</br> Equipment</th>'
        sOut += '<th>Age of</br> Equipment</th>'
        sOut += '<th>FT-2</th>'
        sOut += '</tr>'
        sOut += '<thead>'
        sOut += '<tr>'
        sOut += '<td>' + d.details.immunizing_status + '</td>'
        sOut += '<td>' + d.details.catchment_pop + '</td>'
        sOut += '<td>' + d.details.live_birth_pop + '</td>'
        sOut += '<td>' + d.details.working_coldboxes + '</td>'
        sOut += '<td>' + d.details.working_vaccine_carriers + '</td>'
        sOut += '<td>' + d.details.ice_packs + '</td>'
        sOut += '<td>' + d.details.elec_availability + '</td>'
        sOut += '<td>' + d.details.make + '</td>'
        sOut += '<td>' + d.details.model + '</td>'
        sOut += '<td>' + d.details.age + '</td>'
        sOut += '<td>' + d.details.ft2_availability + '</td>'
        sOut += '</tr>'
        sOut += '</table>';

        return sOut;
    }


    $(document).ready(function() {
        var rows_selected = [];
    
        var table = $('#table').DataTable({
             "paging": false,
            "ajax": {
                "url": "<?php echo base_url().'docs/json/facilities.json';?>"
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
                    "className": 'facility',
                    "data": null,
                    "orderable": false,
                    "defaultContent": '',
                    "render": function(data, type, full, meta) {
                        var selectO = '<select name="facility_id" id="facility_id" class="facility_id">';
                        var selectE = '</select>';
                        var option = new Array();
                        $.each(data.similarities, function(key, value) {
                            value = '<option value="' + value.id + '">' + value.facility_name + '</option>';
                            option.push(value);
                        });
                        return selectO + option + selectE;
                    }

                }, {
                    "orderable": false,
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                    }

                },

            ],
            "order": [
                [1, 'asc']
            ],
            "rowCallback": function(row, data, dataIndex) {
                // Get row ID
                var rowId = data[0];
                // If row ID is in the list of selected row IDs
                if ($.inArray(rowId, rows_selected) !== -1) {
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }
            }

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

        // Updates "Select all" control in a data table
        //
        function updateDataTableSelectAllCtrl(table) {
            var $table = table.table().node();
            var $chkbox_all = $('tbody input[type="checkbox"]', $table);
            var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
            var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);

            // If none of the checkboxes are checked
            if ($chkbox_checked.length === 0) {
                chkbox_select_all.checked = false;
                if ('indeterminate' in chkbox_select_all) {
                    chkbox_select_all.indeterminate = false;
                }

                // If all of the checkboxes are checked
            } else if ($chkbox_checked.length === $chkbox_all.length) {
                chkbox_select_all.checked = true;
                if ('indeterminate' in chkbox_select_all) {
                    chkbox_select_all.indeterminate = false;
                }

                // If some of the checkboxes are checked
            } else {
                chkbox_select_all.checked = true;
                if ('indeterminate' in chkbox_select_all) {
                    chkbox_select_all.indeterminate = true;
                }
            }
        }

        // Handle click on checkbox
        $('#table tbody').on('click', 'input[type="checkbox"]', function(e) {
            var $row = $(this).closest('tr');

            // Get row data
            var data = table.row($row).data();

            // Get row ID
            var rowId = table.row($row).index();
            //data.facility_id;
            var facilityId = $row.find('.facility_id').val();
            var rowData = { "rowId":rowId, "facilityId":facilityId};
            // Determine whether row ID is in the list of selected row IDs 
            //var index = $.inArray(rowId, rows_selected);
            var index = $.inArray(rowData, rows_selected);
            
            // If checkbox is checked and row ID is not in list of selected row IDs
            if (this.checked && index === -1) {
                
                rows_selected.push(rowData);               
                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }

            if (this.checked) {
                $row.addClass('selected');
            } else {
                $row.removeClass('selected');
            }

            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });


        // Handle table draw event
        table.on('draw', function() {
            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);
        });

        // Handle form submission event 
        $('#form').on('submit', function(e) {
            var form = this;
            var array = new Array();
           
            // Iterate over all selected checkboxes
            $.each(rows_selected, function(index, object) {
        
                x = table.row(object.rowId).data();
                save_data = {
                    "facility_id":x.facility_id,
                    "facility_name":x.facility_name,
                    "matching_id":object.facilityId,
                    "details":x.details
                    };

                array.push(save_data);
            });

            
            data = JSON.stringify(array);

            $.ajax(
                {
                    url: "<?php echo base_url().'inventory/save/';?>",
                    type: "POST",
                    data: {"data": data },
                    beforeSend: function(){
                       
                    },
                    success: function (data, textStatus, jqXHR) {
                        window.location.replace("<?php echo base_url().'inventory'?>");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {}
                });

            // Prevent actual form submission
            e.preventDefault();
        });
    });


    function cl(logstring) {
        if (navigator.appVersion.indexOf("MSIE 8") == -1) {
            return console.log(logstring);
        }
    }
</script>