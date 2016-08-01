<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        <?php echo $main_title; ?>
    </title>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link href="<?php echo base_url() ?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/css/animate.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/css/admin.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/plugins/jquery-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/plugins/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/plugins/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/plugins/formvalidation.io/dist/css/formValidation.min.css" rel="stylesheet" />

    <link href="<?php echo base_url() ?>assets/css/jquery-ui.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/css/MonthPicker.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/plugins/datatables/Editor/css/editor.bootstrap.css" rel="stylesheet" />

    <link href="<?php echo base_url() ?>assets/plugins/datatables/Buttons-1.1.0/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/plugins/datatables/Select-1.1.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/plugins/datatables/Editor/css/editor.dataTables.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/css/divbelow.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/css/chatlayout.css" rel="stylesheet" />



    <script src="<?php echo base_url() ?>assets/js/jquery-2.1.0.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
    <!-- <script src="<?php //echo base_url(); ?>assets/js/chat.js"></script>
    <script src="<?php //echo base_url(); ?>assets/js/tasks.js"></script>-->

    <script src="<?php echo base_url() ?>assets/js/moment.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery-daterangepicker/jquery.daterangepicker.js"></script>

    <script src="<?php echo base_url() ?>assets/plugins/highcharts/highcharts.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/highcharts/modules/no-data-to-display.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/highcharts/modules/exporting.js"></script>
</head>
<body style="background-color:fff !important">

<table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Username</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td rowspan="2">1</td>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <td>Mark</td>
          <td>Otto</td>
          <td>@TwBootstrap</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <td>3</td>
          <td colspan="2">Larry the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>

     <script src="<?php echo base_url() ?>assets/js/common-script.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/graph.js"></script>
    <script src="<?php echo base_url() ?>assets/js/edit-graph.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.bootstrap.wizard.js"></script>
    <script src="<?php echo base_url() ?>assets/js/MonthPicker.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.maskedinput.min.js"></script>

    <script src="<?php echo base_url() ?>assets/plugins/kalendar/kalendar.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/kalendar/edit-kalendar.js" type="text/javascript"></script>


    <script src="<?php echo base_url() ?>assets/plugins/datatables/DataTables-1.10.10/js/jquery.dataTables.js"></script>

    <script src="<?php echo base_url() ?>assets/plugins/datatables/Buttons-1.1.0/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables/Buttons-1.1.0/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables/Buttons-1.1.0/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables/KeyTable-2.1.0/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables/Select-1.1.0/js/dataTables.select.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables/Editor/js/dataTables.editor.js"></script>
    
    <script src="<?php echo base_url() ?>assets/plugins/formvalidation.io/dist/js/formValidation.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/formvalidation.io/dist/js/framework/bootstrap.min.js"></script>
    
    <script src="<?php echo base_url() ?>assets/plugins/data-tables/DT_bootstrap.js"></script>




    <script src="<?php echo base_url() ?>assets/plugins/knob/jquery.knob.min.js"></script>


    <script src="<?php echo base_url() ?>assets/js/jPushMenu.js"></script>
   
    <script src="<?php echo base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/side-chats.js"></script>
    <script src="<?php echo base_url() ?>assets/js/animated.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/scroll/jquery.nanoscroller.js"></script>

</body>

</html>