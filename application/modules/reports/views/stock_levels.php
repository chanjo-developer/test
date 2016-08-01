<div class="">
  <div style="min-height: 400px;" id="reports_display">
    <table  class="table table-bordered table-hover table-striped" id="" >
  <thead style="background-color: white">
  <tr>
    <th>Station</th>
    <th>Population</th>
    <th>BCG - (Doses)</th>
    <th>OPV (Doses) </th>
    <th>IPV (Doses)</th>
    <th>ROTA (Doses)</th>
    <th>MEASLE (Doses)</th>
    <th>TT (Doses)</th>
    <th>YF (Doses)</th>
    <th>Last Updated</th>
  </tr>
  </thead>

    <tbody>

    <?php
//echo '<pre>',print_r($query),'</pre>';exit;
        foreach ($query as $key => $value ) {

                //$formatdate = new DateTime($potential_exp->expiry_date);
                //$formated_date= $formatdate->format('d M Y');
				        //$ts1 = strtotime(date('d M Y'));
                //$ts2 = strtotime(date($potential_exp->expiry_date));

                ?>
            <tr>
              <td><?php echo $key; ?> </td>
              <td> <?php echo $population[$key]; ?>  </td>
              <td> <?php for ($i=0; $i < sizeof($value); $i++) {
                if ($value[$i]->vaccine_name=='BCG') {
                echo $value[$i]->balance;
              }
              }  ?>
                </td>

              <td><?php for ($i=0; $i < sizeof($value); $i++) {
                if ($value[$i]->vaccine_name=='OPV') {
                echo $value[$i]->balance;
              }
              }  ?>
              </td>

              <td><?php for ($i=0; $i < sizeof($value); $i++) {
                if ($value[$i]->vaccine_name=='IPV') {
                echo $value[$i]->balance;
              }
              }  ?></td>

              <td><?php for ($i=0; $i < sizeof($value); $i++) {
                if ($value[$i]->vaccine_name=='ROTA-Virus') {
                echo $value[$i]->balance;
              }
              }  ?></td>

              <td><?php for ($i=0; $i < sizeof($value); $i++) {
                if ($value[$i]->vaccine_name=='Measles_Diluent') {
                echo $value[$i]->balance;
              }
              }  ?></td>

              <td><?php for ($i=0; $i < sizeof($value); $i++) {
                if ($value[$i]->vaccine_name=='TT') {
                echo $value[$i]->balance;
              }
              }  ?></td>

              <td><?php for ($i=0; $i < sizeof($value); $i++) {
                if ($value[$i]->vaccine_name=='Yellow-Fever') {
                echo $value[$i]->balance;
              }
              }  ?></td>
              <td><?php

                echo date('d M,Y',strtotime($value[0]->timestamp));

              ?>

              </td>

            </tr>
          <?php } echo "<tr>
          <td></td>


          <td></td>
          <td></td>
          <td></td>
          <td></td>
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
