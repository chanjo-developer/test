<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<div class="container-fluid" >
    <div >
        <div class="col-md-5">
            <img src="assets/images/coat_of_arms_small.png" class="pull-left" style="" />
        </div>
        <div class="col-md-7">
            <div style="margin-left:2%;">

                <p style="padding-top:14px;font-size:1.6em;font-weight:600;margin:auto">
                  Ministry of Health.
                </p>
                <p style="font-size:1.2em;font-weight:600">
                  National Vaccines & Immunization Program
                </p>
                <p style="font-size:12px;font-weight:400">
                  <?php echo $title; ?>
                </p>

          </div>

        </div>
  </div>
    <div class="col-md-12">
        <table  class="table table-striped table-bordered" id="" style="margin:auto;" >
        
            <thead style="background-color: white">
                <tr>
                    <th>Vaccine/Diluents</th>
                    <th>Stock In Hand</th>
                    <th>Minimum Stock</th>
                    <th>Maximum Stock</th>
                    <th>First Expiry</th>
                    <th>Quantity</th>
                 </tr>   
            </thead>
            <tbody>
                <?php foreach ($quantities as $key => $value) {?>
                <tr>  
                    <td class=""><?php echo $key; ?></td>
                    <td class="" style="width:20px;"><?php echo $value['current_stock']; ?> </td>
                    <td class=""><?php echo $value['min_stock']; ?> </td>
                    <td class=""><?php echo $value['max_stock']; ?> </td>
                    <td class=""><?php echo $value['expiry_date']; ?> </td>
                    <td class=""><?php echo $value['order']; ?> </td>
                    
                </tr>
                <?php } ?> 
                <tr style=";font-weight:600;">

                    <td class="">Name of Store Manager:</td>
                    <td class="" style="width:20px;"><?php echo $user_object['user_fname'] . ' ' . $user_object['user_lname']?></td>
                    <td class="">Sign</td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                </tr>
                <tfoot>
                </tfoot>

            </tbody>

        </table>
    </div>
</div>