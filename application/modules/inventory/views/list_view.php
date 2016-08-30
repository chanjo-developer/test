<div class="row">
<?php echo form_open('',array('id'=>'form'));?>
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
                <th><input name="select_all" value="1" id="select-all" type="checkbox"></th>
    
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th>Facility Name</th>
                <th>Matching Name</th>
                <th><input name="select_all" value="1" id="select-all" type="checkbox"></th>
                
            </tr>
        </tfoot>
    </table>


    <div class="col-lg-offset-4 col-lg-3">
    <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">Submit</button>    
    </div>
     <?php echo form_close();?>
</div>

<script type="text/javascript">
    function format ( d ) {
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
    sOut += '<td>'+d.immunizing_status+'</td>'
    sOut += '<td>'+d.catchment_pop+'</td>'
    sOut += '<td>'+d.live_birth_pop+'</td>'
    sOut += '<td>'+d.working_coldboxes+'</td>'
    sOut += '<td>'+d.working_vaccine_carriers+'</td>'
    sOut += '<td>'+d.ice_packs+'</td>'
    sOut += '<td>'+d.elec_availability+'</td>'
    sOut += '<td>'+d.make+'</td>'
    sOut += '<td>'+d.model+'</td>'
    sOut += '<td>'+d.age+'</td>'
    sOut += '<td>'+d.ft2_availability+'</td>'
    sOut += '</tr>'
    sOut += '</table>';

    return sOut;
}
 
$(document).ready(function() {
  
    var table = $('#table').DataTable( {
        "ajax": {
                "url": "<?php echo base_url()."docs/json/facilities.json" ?>",
                "dataSrc": ""
            },
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": '',
        
            },
            {   
                "orderable":      false,
                "data": "facility_name" 
            },
            {
                "data":           null,
                "orderable":      false,
                "defaultContent": '',
                "render": function (data, type, full, meta){
                            var selectO = '<select>';    
                            var selectE = '</select>';    
                            var option = new Array();
                               $.each(data.similarities ,function(key, value){
                                  value = '<option value="'+value.id+'">'+value.facility_name+'</option>';
                                  option.push(value);
                               });
                               return selectO+option+selectE;
                            }
        
            },
            {
                "orderable":      false,
                "data":           null,
                "render": function (data, type, full, meta){
                     return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                 }
        
            },

        ],
        "order": [[1, 'asc']]
    });
     
    // Add event listener for opening and closing details
    $('#table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });

// Handle click on "Select all" control
   $('#select-all').on('click', function(){
      // Get all rows with search applied
      var rows = table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

   // Handle click on checkbox to set state of "Select all" control
   $('#example tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control 
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });

   // Handle form submission event
   $('#form').on('submit', function(e){
      var form = this;

      // Iterate over all checkboxes in the table
      table.$('input[type="checkbox"]').each(function(){
         // If checkbox doesn't exist in DOM
         if(!$.contains(document, this)){
            // If checkbox is checked
            if(this.checked){
               // Create a hidden element 
               $(form).append(
                  $('<input>')
                     .attr('type', 'hidden')
                     .attr('name', this.name)
                     .val(this.value)
   

            );
            }
         } 
      });
    });

});


</script>