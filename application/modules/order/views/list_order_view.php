<?php echo $this->session->flashdata('msg');  ?>
<div class="row">

    <div class="col-lg-12 col-sm-12">

      <a href="<?php echo site_url('order/create_order');?>" class="btn btn-primary state_change" id="create_order" value="Create Order">Create Request</a>
    </div>
  </div>
  </br>

  <div class="well well-sm"><b>Requests</b></div>
  </br>
<div class="row">
  

<div class="col-lg-12 col-sm-12">
 <div class="panel default blue_title h2">

              <div class="panel-body">
                <ul class="nav nav-tabs" id="myTab">

                  <li class="active"><a data-toggle="tab" href="#tab1"><b>Requests from me</b></a></li>
                  <li><a data-toggle="tab" href="#tab2"><b>Requests History</b></a></li>

                  </ul>
<div class="tab-content" id="">

    <div id="tab1" class="tab-pane fade in active">
        <form id="list_orders_fm">
<!--Listing Submitted Requests-->


    <table class="table table-bordered table-striped" id="list_orders_tbl">
        <thead>
                <tr><th>Request # </th><th>Date Created</th><th>Status</th><th>Action</th></tr>
        </thead>

        <tbody>
          <?php $option=1 ; ?>
        <?php foreach ($submitted_orders as $order) { 
         $ledger_url = base_url().'order/view_orders/'.$order['user_id'].'/'.$order['transaction_date'].'/'.$option.'/'.$order['id'].'/'.$order['status'];
         
         ?>
        
              <tr>
              <td><?php  echo $order['id']?></td>
              <td><?php echo $order['transaction_date']?></td>
              <td style="color:red"><?php echo $order['status']?></td>
              <td><a href="<?php  echo $ledger_url ?>" class="btn btn-danger btn-xs">View <i class="fa fa-eye"></i></a></td>
          <?php }?>
              </tr>
              <?php echo $this->pagination->create_links(); ?>
        </tbody>
        </table>
         
    </form>
  </div>

  <div id="tab2" class="tab-pane fade">
    <form id="list_orders_fm">
      <!--Listing Submitted Requests-->


    <table class="table table-bordered table-striped" id="list_orders_tbl">
        <thead>
                <tr><th>Request # </th><th>Date Created</th><th>Status</th><th>Action</th></tr>
        </thead>

        <tbody>
          <?php $option=2 ; ?>
        <?php foreach ($all_orders as $order) {
         $ledger_url = base_url().'order/view_orders/'.$order['user_id'].'/'.$order['transaction_date'].'/'.$option.'/'.$order['id'].'/'.$order['status'];
         ?>
        
              <tr>
              <td><?php echo $order['id']?></td>
              <td><?php echo $order['transaction_date']?></td>
              <td style="color:red"><?php echo $order['status']?></td>
              <td><a href="<?php  echo $ledger_url ?>" class="btn btn-danger btn-xs">View <i class="fa fa-eye"></i></a></td>
          <?php }?>
              </tr>

        </tbody>
        </table>
         <?php echo $this->pagination->create_links(); ?>
    </form>
  </div>

</div>
</div>
</div>
</div>
</div>

 <script type="text/javascript">

               window.setTimeout(function() {
                  $("#alert-message").fadeTo(500, 0).slideUp(500, function(){
                      $(this).remove(); 
                  });
              }, 5000);
        </script> 