<?php 
	$this->load->view('layout/header');

  $this->load->library('ion_auth');
    
  $data = $this->ion_auth->getUserRole($this->session->userdata('userId'));

  $userRole = array();
  foreach ($data as $value) {
    array_push($userRole, $value->name);
  }

  $this->session->set_userdata("userRole",$userRole);

  $user_session = $this->session->userdata('userRole');

?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script> -->
    <script type="text/javascript">
      // Load the Visualization API and the line package.
      google.charts.load('current', {'packages':['line']});
      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawLine);
        function drawLine() {
            $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>auth/get_data',
            success: function (data1) {
            // Create our data table out of JSON data loaded from server.
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Date');
                data.addColumn('number', 'Income');
                data.addColumn('number', 'Expense');
                data.addColumn('number', 'Profit');
                var jsonData = $.parseJSON(data1);
                for(var i = 0; i < jsonData.length; i++) 
                {
                    var date_shown ="";
                    if(jsonData[i].date!= "" && jsonData[i].date!=null)
                    {
                      date_shown = jsonData[i].date;
                    }


                    data.addRow([date_shown, parseInt(jsonData[i].i_amount), parseInt(jsonData[i].e_amount),parseInt(jsonData[i].profit)]);
                }
                var options = {
                  chart: {
                    title: 'Company Performance',
                    subtitle: 'Show Income, Expense And Profit of Company'
                  },
                  height: 500,
                  axes: {
                    x: {
                      0: {side: 'bottom'} 
                    }
                  }
                };
                var chart = new google.charts.Line(document.getElementById('line_chart'));
                chart.draw(data, options);
            }
         });
        }

        /*   Draw  Bar Chart */

        google.charts.load('current', {'packages':['bar']});
        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawBar);
        function drawBar() {
              $.ajax({
              type: 'POST',
              url: '<?php echo base_url();?>Auth/get_data',
              success: function (data1) {
              // Create our data table out of JSON data loaded from server.
              var data = new google.visualization.DataTable();
                      data.addColumn('string', 'Date');
                      data.addColumn('number', 'Income');
                      data.addColumn('number', 'Expense');
                      data.addColumn('number', 'Profit');
              var jsonData = $.parseJSON(data1);
              for(var i = 0; i < jsonData.length; i++) 
              { 
                  var date1 = jsonData[i].date;
                  //alert("Test"+d);
                  if(date1 == undefined)
                  {
                      date1=" ";
                  }
                  
                  
                  data.addRow([date1, parseInt(jsonData[i].i_amount), parseInt(jsonData[i].e_amount),parseInt(jsonData[i].profit)]);
              }

              var options = {
                chart: {
                  title: 'Company Performance',
                  subtitle: 'Show Rent,Expense and Income of Company'
                },
                /*width: 900,*/
                height: 500,
                axes: {
                  x: {
                    0: {side: 'bottom'}
                  }
                }
                /*colors: ['blue', 'red',] */
              };
              var chart = new google.charts.Bar(document.getElementById('bar_chart'));
              chart.draw(data, options);
               }
           });
          }

          /*  Drow Pie chart Function */

          // Load the Visualization API and the line package.
          google.charts.load('current', {'packages':['corechart']});
          // Set a callback to run when the Google Visualization API is loaded.
                                    google.charts.setOnLoadCallback(drawPie);

          function drawPie() {
              $.ajax({
                type: 'POST',
                url: '<?php echo base_url();?>auth/get_expense',
                success: function (data1) {
                  var data = new google.visualization.DataTable();
                  // Add legends with data type
                  data.addColumn('string', 'Expense');
                 data.addColumn('number', 'amount');
                 //Parse data into Json
                 var jsonData = $.parseJSON(data1);
                 for (var i = 0; i < jsonData.length; i++) {
                   data.addRow([jsonData[i].category, parseInt(jsonData[i].amount)]);
                 }
                 var options = {
                  legend: '',
                  pieSliceText: 'label',
                  title: 'Company Expense Details',
                  pieHole: 0.4,
                  slices: {  1: {offset: 0.2}}
                  //is3D: true
                };
  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
               }
            });
          }
    </script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i>
           <!-- Home -->
           <?php echo $this->lang->line('home');?>
          </a></li>
          <li class="active">
          <!-- Dashboard -->
          <?php echo $this->lang->line('sidebar_dashboard');?>
          </li>
        </ol>
        <!-- <small>Control panel</small> -->
      </h5>
    </section>    


    <?php echo $this->lang->line('welcome_msg');?>
    
    <!-- Main content -->
    <section class="content">
    <!-- <div id="line_chart"></div> -->
      <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title">Quick Links</h3>
            </div>
            <div class="box-body">
            <?php 
            if(isset($user_session)){
              if(in_array("manage_item",$user_session)){?>
              <a class="btn btn-app" href="<?php echo base_url();?>item/">
                <i class="fa fa-barcode"></i> Products
              </a>
            <?php }} ?>

            <?php 
              if (isset($user_session)) {
                if(in_array("manage_quotation",$user_session)){
                ?>
              <a class="btn btn-app" href="<?php echo base_url();?>quotation/">
                <i class="fa fa-inbox"></i> Sales Orders
              </a>
            <?php }} ?>

            <?php 
              if (isset($user_session)) {
                if(in_array("manage_invoice",$user_session)){
                ?>
              <a class="btn btn-app" href="<?php echo base_url();?>sales/">
                <i class="fa fa-truck"></i> Sales
              </a>
            <?php }} ?>

            <?php 
            if (isset($user_session)) {
              if(in_array("manage_purchase",$user_session)){?>
              <a class="btn btn-app" href="<?php echo base_url();?>purchases/">
                <i class="fa fa-shopping-cart"></i> Purchases
              </a>
            <?php }} ?>

            <?php if(isset($user_session)){
                if(in_array("manage_customer",$user_session)){?>
              <a class="btn btn-app" href="<?php echo base_url();?>customer/">
                <i class="fa fa-users"></i> Customers
              </a>
            <?php }} ?>

            <?php if(isset($user_session)){
                if(in_array("manage_supplier",$user_session)){?>
              <a class="btn btn-app" href="<?php echo base_url();?>supplier/">
                <i class="fa fa-user-plus"></i> Suppliers
              </a>
            <?php }} ?>

            <?php 
            if (isset($user_session)) {
            if(in_array("manage_bank_account",$user_session)){?>
              <a class="btn btn-app" href="<?php echo base_url();?>bank/">
                <i class="fa fa-bank"></i> Accounts
              </a>
            <?php }} ?>

            <?php 
              if (isset($user_session)) {
                if(in_array("manage_balance_transfer",$user_session)){?>
              <a class="btn btn-app" href="<?php echo base_url();?>transfer/">
                <i class="fa fa-exchange"></i>
                Balance Transfer
              </a>
            <?php }} ?>

            <?php 
            if (isset($user_session)) {
              if(in_array("manage_expense",$user_session)){?>
              <a class="btn btn-app" href="<?php echo base_url();?>expense/">
                <i class="fa fa-bullhorn"></i> Expense
              </a>
            <?php }} ?>

            <?php if(isset($user_session)){
               if(in_array("manage_tax",$user_session)){?>
              <a class="btn btn-app" href="<?php echo base_url();?>tax/">
                <i class="fa fa-percent"></i> Taxes
              </a>
            <?php }} ?>  

            <?php if(isset($user_session)){
                  if(in_array("manage_item_category",$user_session)){?>
              <a class="btn btn-app" href="<?php echo base_url();?>category/">
                <i class="fa fa-tags"></i> Item Category
              </a>
            <?php }} ?>

            <?php if(isset($user_session)){
              if(in_array("manage_company_setting",$user_session)){?>
              <a class="btn btn-app" href="<?php echo base_url();?>settings/">
                <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                <span class="sr-only">Loading...</span>
                Company Settings
              </a>
            <?php }} ?>

            <?php if(isset($user_session)){
               if(in_array("manage_currency",$user_session)){?>
              <a class="btn btn-app" href="<?php echo base_url();?>currency/">
                <i class="fa fa-rupee"></i> Currency
              </a>
            <?php }} ?>

            <?php if(isset($user_session)){
               if(in_array("manage_payment_term",$user_session)){?>
              <a class="btn btn-app" href="<?php echo base_url();?>paymentterms/">
                <i class="fa fa-chain"></i> Payment Term
              </a>
            <?php }} ?>

            <?php if(isset($user_session)){
               if(in_array("manage_payment_method",$user_session)){?>
              <a class="btn btn-app" href="<?php echo base_url();?>paymentmethod/">
                <i class="fa fa-credit-card"></i> Payment Method
              </a>
            <?php }} ?>

            <?php if(isset($user_session)) {
              if(in_array("manage_location",$user_session)){?>
              <a class="btn btn-app" href="<?php echo base_url();?>location/">
                <i class="fa fa-home"></i> Warehouse
              </a>
            <?php }} ?>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>


      <div class="row">
        <!--Graph Chart-->
          <div class="col-md-12">
            <!-- LINE CHART -->
            <div class="box box-warning">
              <div class="box-header with-border">
                <div id="row">
                  <div class="col-md-12">
                    <div class="text-center">
                     <strong>
                       <?php echo $this->lang->line('graph_header_title');?>
                     </strong>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-body">
                  <div id="line_chart"></div>              
              </div>
              <!-- /.box-body -->
              <div class="box-footer with-border">
                <div id="row">
                  <div class="col-md-1">
                    <div class="row">
                      <div class="col-md-4">
                      <div id="sale">
                      </div>
                      </div>
                      <div class="col-md-8 scp">
                        <?php echo $this->lang->line('income');?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="row">
                      <div class="col-md-4">
                      <div id="cost">
                      </div>
                      </div>
                      <div class="col-md-8 scp">
                        <?php echo $this->lang->line('expense');?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="row">
                      <div class="col-md-4">
                      <div id="profit">
                      </div>
                      </div>
                      <div class="col-md-8 scp">
                        <?php echo $this->lang->line('profit');?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box -->
          </div>
        <!--Graph Chart-->
      </div>


      <div class="row">
        <!--Graph Chart-->
        <div class="col-md-12">
          <!-- LINE CHART -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <div id="row">
                <div class="col-md-12">
                  <div class="text-center">
                    <strong>
                      <?php echo $this->lang->line('graph_header_title');?>
                    </strong>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-body">
                <div id="bar_chart"></div>              
            </div>
            <!-- /.box-body -->
            <div class="box-footer with-border">
              <div id="row">
                <div class="col-md-1">
                  <div class="row">
                    <div class="col-md-4">
                    <div id="sale">
                    </div>
                    </div>
                    <div class="col-md-8 scp">
                      <?php echo $this->lang->line('income');?>
                    </div>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="row">
                    <div class="col-md-4">
                    <div id="cost">
                    </div>
                    </div>
                    <div class="col-md-8 scp">
                      <?php echo $this->lang->line('expense');?>
                    </div>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="row">
                    <div class="col-md-4">
                    <div id="profit">
                    </div>
                    </div>
                    <div class="col-md-8 scp">
                      <?php echo $this->lang->line('profit');?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!--Graph Chart-->
      </div>


      <!-- /.box -->

      <!-- <div id="piechart" style="width: 900px; height: 500px;"></div> -->

      
      <div class="row">
          <div class="col-md-8">
            <!--- Start sale, revenue and profit-->
            <div class="box box-info">
                <div class="box box-body">
                <div style="font-weight:bold; font-size:20px; padding: 10px 0px;">
                  <!-- Income -->
                  <?php echo $this->lang->line('income');?>
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-center" style="">
                      <?php 
                        $unpaid = 0;
                        $paypercent =0;
                        $pending =0;

                        if($invoicedata->total!= NULL && $invoicedata->paid!=NULL){

                          $unpaid =$invoicedata->total - $invoicedata->paid;
                          $paypercent = $invoicedata->paid * 100 / $invoicedata->total;
                          $pending = $unpaid * 100 / $invoicedata->total;

                        }
                      ?>
                      <div class="progress" style="height:50px;">
                        <div class="progress-bar progress-bar-success" role="progressbar" style="width:<?php echo $paypercent;?>%">
                          completed
                          <?php echo number_format((float)$paypercent, 2, '.', '');?>%

                        </div>
                        <div class="progress-bar progress-bar-warning" role="progressbar" style="width:<?php echo $pending;?>%">
                          Pending
                          <?php echo number_format((float)$pending, 2, '.', '');?>%
                        </div>
                      </div>    
                    </div>
                  
                  </div>

                    <div class="row">
                        <div class="col-md-3">
                          <div style="font-weight: bold; font-size: 18px; padding-top: 10px;">
                            <!-- <?php echo $invoicedata->total;?>.00 -->
                            <?php if(isset($invoicedata->total)){echo number_format((float)$invoicedata->total, 2, '.', '');}?>
                          </div>
                          <?php echo $this->lang->line('openinvoice');?>
                        </div>

                        <div class="col-md-1">
                          <div style="font-weight: bold; font-size: 30px; padding-top: 10px;">
                          =
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div style="font-weight: bold; font-size: 18px; padding-top: 10px;">
                            <!-- <?php echo $invoicedata->paid?>.00 -->
                            <?php if(isset($invoicedata->paid)){echo number_format((float)$invoicedata->paid, 2, '.', '');}?>
                          </div>
                         <?php echo $this->lang->line('paidamount');?>
                        </div>

                        <div class="col-md-2">
                          <div style="font-weight: bold; font-size: 30px; padding-top: 10px;">
                          +
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div style="font-weight: bold; font-size: 18px; padding-top: 10px;">
                            <!-- <?php echo $invoicedata->total - $invoicedata->paid;?>.00 -->
                            <?php if(isset($invoicedata->total)){echo number_format((float)$invoicedata->total - $invoicedata->paid, 2, '.', '');}?>
                          </div>
                          <!-- Unpaid -->
                          <?php echo $this->lang->line('unpaidamount');?>
                        </div>
                    </div>
                </div>
            </div>
<!--Expense Category Graph Start-->
            <div class="box box-info">
                <div class="box box-body">
                    <div style="font-weight:bold; font-size:20px; padding: 10px 0px;">
                    <!-- Expenses -->
                    <?php echo $this->lang->line('expense');?>
                    </div>
                    <div class="row">

                    <div class="col-md-4">
                      <!-- <div style="font-weight: bold; font-size: 18px;">$83,000.00
                      </div> -->
                      <b>
                        <!-- Expense in last 30 days -->
                        <?php echo $this->lang->line('expense_header');?>  
                      </b>

                      <ul class="chart-legend clearfix">
                        <br>
                        <?php foreach ($exp_category  as $value) {?>
                          <li><i class="fa fa-circle text-blue"></i> <?php echo $value->name.' :  '.$value->expense;?></li>
                          <!-- <li><i class="fa fa-circle text-green"></i> $45000 Repair &amp; MaintEnance</li> -->
                        <?php } ?>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <div id="piechart" style="width: 90%; height: 100%;"></div>
                        
                    </div>

                    </div>
                </div>
            </div>    
<!--Expense Category Graph End-->

<!--Income Expense Start-->
            <!-- <div class="box box-info">
                <div class="box box-body">
                  <div style="font-weight:bold; font-size:20px; padding: 10px 0px;">
                    Profit &amp; Loss
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div>
                        <p style="font-weight: bold;font-size: 16px; margin: 0px;">$148,615.00</p>Net Income
                      </div>
                      <div style="margin : 7px 0px; border-left: 3px solid #286090;padding-left: 10px;">
                        <p style="font-size: 16px; margin: 0px;">$276,615.00</p> Income
                      </div>
                      <div style="margin : 7px 0px; border-left: 3px solid #C9302C;padding-left: 10px;">
                        <p style="font-size: 16px; margin: 0px;"> $128,000.00</p>Expenses
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div id="container" style="min-width: 310px; height: 300px; margin: 0 auto">
                        <div id="highcharts-wzy0qp1-0" class="highcharts-container "
                           style="position: relative; overflow: hidden; width: 400px; height: 300px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                           <svg version="1.1" class="highcharts-root" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="514" height="300">
                            <desc>Created with Highcharts 5.0.7</desc>
                            <defs>
                              <clipPath id="highcharts-wzy0qp1-1">
                                <rect x="0" y="0" width="417" height="159" fill="none"></rect>
                              </clipPath>
                            </defs>
                            <rect fill="#ffffff" class="highcharts-background" x="0" y="0" width="514" height="300" rx="0" ry="0"></rect>
                            <rect fill="none" class="highcharts-plot-background" x="87" y="10" width="417" height="159"></rect>
                            <g class="highcharts-grid highcharts-xaxis-grid ">
                              <path fill="none" class="highcharts-grid-line" d="M 156.5 10 L 156.5 169" opacity="1"></path>
                              <path fill="none" class="highcharts-grid-line" d="M 225.5 10 L 225.5 169" opacity="1"></path>
                              <path fill="none" class="highcharts-grid-line" d="M 295.5 10 L 295.5 169" opacity="1"></path>
                              <path fill="none" class="highcharts-grid-line" d="M 364.5 10 L 364.5 169" opacity="1"></path>
                              <path fill="none" class="highcharts-grid-line" d="M 434.5 10 L 434.5 169" opacity="1"></path>
                              <path fill="none" class="highcharts-grid-line" d="M 503.5 10 L 503.5 169" opacity="1"></path>
                              <path fill="none" class="highcharts-grid-line" d="M 86.5 10 L 86.5 169" opacity="1"></path>
                            </g>
                            <g class="highcharts-grid highcharts-yaxis-grid ">
                              <path fill="none" stroke="#e6e6e6" stroke-width="1" class="highcharts-grid-line" d="M 87 169.5 L 504 169.5" opacity="1"></path>
                              <path fill="none" stroke="#e6e6e6" stroke-width="1" class="highcharts-grid-line" d="M 87 116.5 L 504 116.5" opacity="1"></path>
                              <path fill="none" stroke="#e6e6e6" stroke-width="1" class="highcharts-grid-line" d="M 87 63.5 L 504 63.5" opacity="1"></path>
                              <path fill="none" stroke="#e6e6e6" stroke-width="1" class="highcharts-grid-line" d="M 87 9.5 L 504 9.5" opacity="1"></path>
                            </g>
                            <rect fill="none" class="highcharts-plot-border" x="87" y="10" width="417" height="159"></rect>
                            <g class="highcharts-axis highcharts-xaxis ">
                              <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1" d="M 156.5 169 L 156.5 179" opacity="1"></path>
                              <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1" d="M 225.5 169 L 225.5 179" opacity="1"></path>
                              <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1" d="M 295.5 169 L 295.5 179" opacity="1"></path>
                              <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1" d="M 364.5 169 L 364.5 179" opacity="1"></path>
                              <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1" d="M 434.5 169 L 434.5 179" opacity="1"></path>
                              <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1" d="M 504.5 169 L 504.5 179" opacity="1"></path>
                              <path fill="none" class="highcharts-tick" stroke="#ccd6eb" stroke-width="1" d="M 86.5 169 L 86.5 179" opacity="1"></path>
                              <path fill="none" class="highcharts-axis-line" stroke="#ccd6eb" stroke-width="1" d="M 87 169.5 L 504 169.5"></path>
                            </g>
                            <g class="highcharts-axis highcharts-yaxis ">
                              <text x="27.78125" text-anchor="middle" transform="translate(0,0) rotate(270 27.78125 89.5)" class="highcharts-axis-title" style="color:#666666;fill:#666666;" y="89.5">Values
                              </text>
                              <path fill="none" class="highcharts-axis-line" d="M 87 10 L 87 169"></path>
                            </g>
                            <g class="highcharts-series-group ">
                              <g class="highcharts-series highcharts-series-0 highcharts-column-series highcharts-color-0 highcharts-tracker " transform="translate(87,10) scale(1 1)" clip-path="url(#highcharts-wzy0qp1-1)">
                                <rect x="14.5" y="106.5" width="12" height="0" fill="#429BCE" class="highcharts-point highcharts-color-0" stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="84.5" y="72.5" width="12" height="34" fill="#429BCE" class="highcharts-point highcharts-color-0" stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="153.5" y="106.5" width="12" height="0" fill="#429BCE" class="highcharts-point highcharts-color-0" stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="223.5" y="106.5" width="12" height="0" fill="#429BCE" class="highcharts-point highcharts-color-0" stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="292.5" y="47.5" width="12" height="59" fill="#429BCE" class="highcharts-point highcharts-color-0 " stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="362.5" y="33.5" width="12" height="73" fill="#429BCE" class="highcharts-point highcharts-color-0 " stroke="#ffffff" stroke-width="1">
                                </rect>
                              </g>
                              <g class="highcharts-markers highcharts-series-0 highcharts-column-series highcharts-color-0 " transform="translate(87,10) scale(1 1)" clip-path="none">
                              </g>
                              <g class="highcharts-series highcharts-series-1 highcharts-column-series highcharts-color-1 highcharts-tracker " transform="translate(87,10) scale(1 1)" clip-path="url(#highcharts-wzy0qp1-1)">
                                <rect x="28.5" y="106.5" width="12" height="0" fill="#F56954" class="highcharts-point highcharts-color-1" stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="98.5" y="106.5" width="12" height="24" fill="#F56954" class="highcharts-point highcharts-negative highcharts-color-1" stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="167.5" y="106.5" width="12" height="0" fill="#F56954" class="highcharts-point highcharts-color-1 " stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="237.5" y="106.5" width="12" height="0" fill="#F56954" class="highcharts-point highcharts-color-1" stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="306.5" y="106.5" width="12" height="24" fill="#F56954" class="highcharts-point highcharts-negative highcharts-color-1 " stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="376.5" y="106.5" width="12" height="20" fill="#F56954" class="highcharts-point highcharts-negative highcharts-color-1" stroke="#ffffff" stroke-width="1">
                                </rect>
                              </g>
                              <g class="highcharts-markers highcharts-series-1 highcharts-column-series highcharts-color-1 " transform="translate(87,10) scale(1 1)" clip-path="none">
                              </g>
                              <g class="highcharts-series highcharts-series-2 highcharts-column-series highcharts-color-2 highcharts-tracker " transform="translate(87,10) scale(1 1)" clip-path="url(#highcharts-wzy0qp1-1)">
                                <rect x="42.5" y="106.5" width="12" height="0" fill="#2FB628" class="highcharts-point highcharts-color-2" stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="112.5" y="95.5" width="12" height="11" fill="#2FB628" class="highcharts-point highcharts-color-2 " stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="181.5" y="106.5" width="12" height="0" fill="#2FB628" class="highcharts-point highcharts-color-2" stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="251.5" y="106.5" width="12" height="0" fill="#2FB628" class="highcharts-point highcharts-color-2" stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="320.5" y="71.5" width="12" height="35" fill="#2FB628" class="highcharts-point highcharts-color-2 " stroke="#ffffff" stroke-width="1">
                                </rect>
                                <rect x="390.5" y="54.5" width="12" height="52" fill="#2FB628" class="highcharts-point highcharts-color-2" stroke="#ffffff" stroke-width="1">
                                </rect>
                              </g>
                              <g class="highcharts-markers highcharts-series-2 highcharts-column-series highcharts-color-2 " transform="translate(87,10) scale(1 1)" clip-path="none">
                              </g>
                            </g>
                            <g class="highcharts-legend" transform="translate(133,256)">
                              <rect fill="none" class="highcharts-legend-box" rx="0" ry="0" x="0" y="0" width="248" height="29" visibility="visible">
                              </rect>
                              <g>
                                <g>
                                  <g class="highcharts-legend-item highcharts-column-series highcharts-color-0 highcharts-series-0" transform="translate(8,3)">
                                    <text x="21" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" y="15">Income</text>
                                    <rect x="2" y="4" width="12" height="12" fill="#429BCE" rx="6" ry="6" class="highcharts-point">
                                    </rect>
                                  </g>
                                  <g class="highcharts-legend-item highcharts-column-series highcharts-color-1 highcharts-series-1" transform="translate(93.8125,3)">
                                    <text x="21" y="15" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start">Expense
                                    </text>
                                    <rect x="2" y="4" width="12" height="12" fill="#F56954" rx="6" ry="6" class="highcharts-point"></rect>
                                  </g>
                                  <g class="highcharts-legend-item highcharts-column-series highcharts-color-2 highcharts-series-2" transform="translate(185.90625,3)">
                                    <text x="21" y="15" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start">Profit</text>
                                    <rect x="2" y="4" width="12" height="12" fill="#2FB628" rx="6" ry="6" class="highcharts-point"></rect>
                                  </g>
                                </g>
                              </g>
                            </g>
                            <g class="highcharts-axis-labels highcharts-xaxis-labels ">
                              <text x="124.34272486435069" style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end" transform="translate(0,0) rotate(-45 124.34272486435069 185)" y="185" opacity="1">
                                <tspan>January-2017</tspan>
                              </text>
                              <text x="193.84272486435069" style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end" transform="translate(0,0) rotate(-45 193.84272486435069 185)" y="185" opacity="1">
                                <tspan>February-2017</tspan>
                              </text>
                              <text x="263.34272486435066" style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end" transform="translate(0,0) rotate(-45 263.34272486435066 185)" y="185" opacity="1">
                                <tspan>March-2017</tspan>
                              </text>
                              <text x="332.84272486435066" style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end" transform="translate(0,0) rotate(-45 332.84272486435066 185)" y="185" opacity="1">
                                <tspan>April-2017</tspan>
                              </text>
                              <text x="402.34272486435066" style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end" transform="translate(0,0) rotate(-45 402.34272486435066 185)" y="185" opacity="1">
                                <tspan>May-2017</tspan>
                              </text>
                              <text x="471.84272486435066" style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end" transform="translate(0,0) rotate(-45 471.84272486435066 185)" y="185" opacity="1">
                                <tspan>June-2017</tspan>
                              </text>
                            </g>
                            <g class="highcharts-axis-labels highcharts-yaxis-labels ">
                              <text x="72" style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end" transform="translate(0,0)" y="173" opacity="1">
                                <tspan>-100k</tspan>
                              </text>
                              <text x="72" style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end" transform="translate(0,0)" y="120" opacity="1">
                                <tspan>0</tspan>
                              </text>
                              <text x="72" style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end" transform="translate(0,0)" y="67" opacity="1">
                                <tspan>100k</tspan>
                              </text>
                              <text x="72" style="color:#666666;cursor:default;font-size:11px;fill:#666666;" text-anchor="end" transform="translate(0,0)" y="14" opacity="1">
                                <tspan>200k</tspan>
                              </text>
                            </g>
                            <g class="highcharts-label highcharts-tooltip highcharts-color-1" style="cursor:default;pointer-events:none;white-space:nowrap;" transform="translate(214,-9999)" opacity="0" visibility="visible">
                              <path fill="none" class="highcharts-label-box highcharts-tooltip-box" d="M 3.5 0.5 L 91.5 0.5 C 94.5 0.5 94.5 0.5 94.5 3.5 L 94.5 44.5 C 94.5 47.5 94.5 47.5 91.5 47.5 L 52.5 47.5 46.5 53.5 40.5 47.5 3.5 47.5 C 0.5 47.5 0.5 47.5 0.5 44.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isShadow="true" stroke="#000000" stroke-opacity="0.049999999999999996" stroke-width="5" transform="translate(1, 1)"></path>
                              <path fill="none" class="highcharts-label-box highcharts-tooltip-box" d="M 3.5 0.5 L 91.5 0.5 C 94.5 0.5 94.5 0.5 94.5 3.5 L 94.5 44.5 C 94.5 47.5 94.5 47.5 91.5 47.5 L 52.5 47.5 46.5 53.5 40.5 47.5 3.5 47.5 C 0.5 47.5 0.5 47.5 0.5 44.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isShadow="true" stroke="#000000" stroke-opacity="0.09999999999999999" stroke-width="3" transform="translate(1, 1)"></path>
                              <path fill="none" class="highcharts-label-box highcharts-tooltip-box" d="M 3.5 0.5 L 91.5 0.5 C 94.5 0.5 94.5 0.5 94.5 3.5 L 94.5 44.5 C 94.5 47.5 94.5 47.5 91.5 47.5 L 52.5 47.5 46.5 53.5 40.5 47.5 3.5 47.5 C 0.5 47.5 0.5 47.5 0.5 44.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isShadow="true" stroke="#000000" stroke-opacity="0.15" stroke-width="1" transform="translate(1, 1)"></path>
                              <path fill="rgba(247,247,247,0.85)" class="highcharts-label-box highcharts-tooltip-box" d="M 3.5 0.5 L 91.5 0.5 C 94.5 0.5 94.5 0.5 94.5 3.5 L 94.5 44.5 C 94.5 47.5 94.5 47.5 91.5 47.5 L 52.5 47.5 46.5 53.5 40.5 47.5 3.5 47.5 C 0.5 47.5 0.5 47.5 0.5 44.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" stroke="#F56954" stroke-width="1"></path>
                              <text x="8" style="font-size:12px;color:#333333;fill:#333333;" y="20">
                                <tspan style="font-size: 10px">March-2017</tspan>
                                <tspan style="fill:#F56954" x="8" dy="15">●</tspan>
                                <tspan dx="0"> Expense: </tspan>
                                <tspan style="font-weight:bold" dx="0">0</tspan>
                              </text>
                            </g>
                          </svg>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>     -->
          </div>

      <div class="col-md-4">
        <!-- Account List-->
        <div class="box box-info">
          <div class="box-header">
              <div style="font-weight:bold; font-size:20px;">
                     <!--  Bank Accounts -->
                     <?php echo $this->lang->line('bank_account_title');?>  
              </div>
          </div>
          <div class="box box-body">
        
            <?php foreach ($account as $value) {?>  
            <div style="min-height:60px;border-bottom: 1px solid gray;padding: 5px 0px;">
              <div style="width:60%;float: left;">
                <div style="font-weight: bold; min-height: 25px;"><?php echo $value->bank_name?></div><div class="clearfix"></div>
                  <div style="margin-bottom: 5px;min-height: 25px;"><?php echo $value->account_type;?> Account</div>
                 <!--  <div class="clearfix"></div> -->
              </div>
              <div style="width:40%;float: left;text-align: right;font-weight: bold;">
                    <?php echo $value->opening_balance;?>
              </div>
            </div>
            <?php } ?>
        </div>
        </div>
<!-- Income List-->
    <div class="box box-info">
        <div class="box-header">
          <div style="font-weight:bold; font-size:20px;">
         <!--  Latest Income -->
         <?php echo $this->lang->line('latest_income_title');?>
          </div>
        </div>
        <div class="box box-body">           
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center">
                  <!-- Date -->
                  <?php echo $this->lang->line('date');?>
                </th>
                <th class="text-center">
                 <?php echo $this->lang->line('description');?>
                </th>
                <th class="text-center">
                  <?php echo $this->lang->line('amount');?>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                  <?php
                  foreach ($deposit as $value) {
                  ?>
                    <td align="center"><?php echo $value->date;?></td>
                    <td align="center"><?php echo $value->description;?></td>
                    <td align="center"><?php echo $value->amount;?></td>        
              </tr>
              <?php
                 }
              ?>
            </tbody>
          </table>
        </div>
    </div>

<!-- Expense List-->
    <div class="box box-info">
        <div class="box-header">
          <div style="font-weight:bold; font-size:20px;">
          <!-- Latest Expenses -->
          <?php echo $this->lang->line('latest_expense_title');?>
          </div>
        </div>
        <div class="box box-body">                 
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">
                  <!-- Date -->
                  <?php echo $this->lang->line('date');?>
                </th>
                <th class="text-center">
                  <!-- Description -->
                  <?php echo $this->lang->line('description');?>
                </th>
                <th class="text-center">
                  <!-- Amount($) -->
                  <?php echo $this->lang->line('amount');?>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                foreach ($expense as $value) {
                ?>
                <td align="center"><?php echo $value->date;?></td>
                <td align="center"><?php echo $value->description;?></td>
                <td align="center"><?php echo $value->amount;?></td>        
              </tr>
              <?php
                 }
              ?>
            </tbody>
          </table>  
        </div>
    </div>
  </div>
</div>

  </section>
</div>

 <?php 
  $this->load->view('layout/footer');
?>



