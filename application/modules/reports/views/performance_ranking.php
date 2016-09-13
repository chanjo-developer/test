<style>
tr:nth-child(-n+3) {
    color: #f00;
}
</style>
<div class="">
  <div style="min-height: 400px;" id="reports_display">
    <table  class="table table-bordered table-hover table-striped" id="" >
  <thead style="background-color: white">
  <tr style="color: black !important;">
    <th>Station</th>
    <th>Target Population</th>
    <th>BCG Coverage</th>
    <th>DPT1 Coverage</th>
    <th>DPT2 Coverage</th>
    <th>DPT3 Coverage</th>
    <th>OPV Coverage</th>
    <th>OPV 1 Coverage</th>
    <th>OPV 2 Coverage</th>
    <th>OPV 3 Coverage</th>
    <th>PCV 1 Coverage</th>
    <th>PCV 2 Coverage</th>
    <th>PCV 3 Coverage</th>

  </tr>
  </thead>

    <tbody>

    <?php

        foreach ($ranking as $key => $value ) {

                //$formatdate = new DateTime($potential_exp->expiry_date);
                //$formated_date= $formatdate->format('d M Y');
				        //$ts1 = strtotime(date('d M Y'));
                //$ts2 = strtotime(date($potential_exp->expiry_date));

                ?>
            <tr>
              <td><?php echo $value->station; ?> </td>
              <td><?php echo $value->population; ?> </td>
              <td><?php echo $value->bcg; ?> </td>
              <td><?php echo $value->dpt1; ?> </td>
              <td><?php echo $value->dpt2; ?> </td>
              <td><?php echo $value->dpt3; ?> </td>
              <td><?php echo $value->opv; ?> </td>
              <td><?php echo $value->opv1; ?> </td>
              <td><?php echo $value->opv2; ?> </td>
              <td><?php echo $value->opv3; ?> </td>
              <td><?php echo $value->pcv1; ?> </td>
              <td><?php echo $value->pcv2; ?> </td>
              <td><?php echo $value->pcv3; ?> </td>



            </tr>
          <?php } echo "<tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td></tr>";
          ?>


   </tbody>
</table>
  </div>

</div>
