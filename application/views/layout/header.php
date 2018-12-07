<?php
  $this->load->library('ion_auth');
  $data = $this->ion_auth->getUserRole($this->session->userdata('userId'));
  $userRole = array();
  foreach ($data as $value) {
    array_push($userRole, $value->name);
  }
  $this->session->set_userdata("userRole",$userRole);
  $user_session = $this->session->userdata('userRole');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url();?>assets/logo/bill.png" />
  <title>
    Billing | Dashboard
  </title>
  <!-- Auto Complete -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/autocomplite/jquery.auto-complete.css">

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fullcalendar/fullcalendar.min.css">
  <!-- Graph -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!-- Close Graph -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fullcalendar/fullcalendar.print.css" media="print">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/iCheck/all.css">
   <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/select2/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/skins/_all-skins.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>documentation/style.css">

  <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-3.1.1.js"></script> 
  <!-- Bootstrap 3.3.6 -->
  <!-- <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script> -->
  <!-- Bootstrap 3.3.6 -->

  <script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url();?>assets/plugins/knob/jquery.knob.js"></script>
  <!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url();?>assets/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>

  </script>
  <style type="text/css">
    .big-icon {
        font-size: 18px;
    }
  </style>
</head>
<body class="hold-transition skin-purple-light sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>auth/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b>ill</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Bill</b>ing & Accounting</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        
         <link rel="shortcut icon" type="image/png" href="<?php echo base_url();?>assets/logo/bill.png" />
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">


          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-plus-circle big-icon"></i>    
              <span class="label label-warning">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Use menu to add data</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">

                  <?php 
                  if (isset($user_session)) {
                  if(in_array("add_quotation",$user_session)){?>
                  <li>
                    <a href="<?php echo base_url();?>quotation/add_form">
                      <i class="fa fa-plus text-aqua"></i> Add Sales Orders
                    </a>
                  </li>
                  <?php }} ?>
                  
                  
                    <?php 
                  if (isset($user_session)) {
                  if(in_array("add_invoice",$user_session)){?>
                  <li>
                    <a href="<?php echo base_url();?>sales/sales_order">
                      <i class="fa fa-plus text-yellow"></i> Sales Order
                    </a>
                  </li>
                  <?php }} ?>
                  

                  <?php 
                  if (isset($user_session)) {
                  if(in_array("add_invoice",$user_session)){?>
                  <li>
                    <a href="<?php echo base_url();?>sales/add_form">
                      <i class="fa fa-plus text-yellow"></i> Add Sales
                    </a>
                  </li>
                  <?php }} ?>

                  <?php 
                  if (isset($user_session)) {
                  if(in_array("add_purchase",$user_session)){?>
                  <li>
                    <a href="<?php echo base_url();?>purchases/add_purchase">
                      <i class="fa fa-plus text-red"></i> Add Purchases
                    </a>
                  </li>
                  <?php }} ?>

                  <?php  
                  if (isset($user_session)) {
                    if(in_array("add_customer",$user_session)){?>
                  <li>
                    <a href="<?php echo base_url();?>customer/add_customer">
                      <i class="fa fa-plus text-green"></i> Add New Customer
                    </a>
                  </li>
                  <?php }} ?>

                  <?php  
                  if (isset($user_session)) {
                    if(in_array("add_supplier",$user_session)){?>
                  <li>
                    <a href="<?php echo base_url();?>supplier/add_supplier">
                      <i class="fa fa-plus text-aqua"></i> Add New Supplier
                    </a>
                  </li>
                  <?php }} ?>

                  <?php 
                  if (isset($user_session)) {
                  if(in_array("add_bank_account",$user_session)){?>
                  <li>
                    <a href="<?php echo base_url();?>bank/view">
                      <i class="fa fa-plus text-yellow"></i> Add Account
                    </a>
                  </li>
                  <?php }} ?>

                  <?php if (isset($user_session)) { 
                       if(in_array("add_expense",$user_session)){?>
                  <li>
                    <a href="<?php echo base_url();?>expense/add">
                      <i class="fa fa-plus text-red"></i> Add Expense
                    </a>
                  </li>
                  <?php }} ?>

                  <?php 
                    if (isset($user_session)) { 
                    if(in_array("add_tax",$user_session)){?>
                  <li>
                    <a href="<?php echo base_url();?>tax/add">
                      <i class="fa fa-plus text-green"></i> Add Taxes
                    </a>
                  </li>
                  <?php }} ?>

                  <?php if(isset($user_session)){
                    if(in_array("manage_company_setting",$user_session)){?>
                  <li>
                    <a href="<?php echo base_url();?>settings/">
                      <i class="fa fa-plus text-blue"></i> Company Settings
                    </a>
                  </li>
                  <?php }} ?>

                </ul>
              </li>
              <!-- <li class="footer"><a href="#">View all</a></li> -->
            </ul>
          </li>

          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-language lang-lg" aria-hidden="true" ></i>
              <!-- <i class="fa fa-american-sign-language-interpreting"></i> -->

              <span class="label label-warning">6</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Select Language</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="<?php echo base_url()?>auth/switchLang/<?php echo 'english'?>">
                      <!-- <i class="fa fa-users text-aqua"></i> -->
                      <span><img src="<?php echo base_url();?>assets/logo/language/english.png" height="35" width="30"></span>&nbsp; English
                    </a>
                  </li>
                  <!--<li>
                    <a href="<?php echo base_url()?>auth/switchLang/<?php echo 'french'?>">
                      <span><img src="<?php echo base_url();?>assets/logo/language/french.png" height="35" width="30"></span>&nbsp; French
                    </a>
                  </li>-->
                  <li>
                    <a href="<?php echo base_url()?>auth/switchLang/<?php echo 'chinese'?>">
                      <span><img src="<?php echo base_url();?>assets/logo/language/chinese.png" height="35" width="30"></span>&nbsp; Chinese
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo base_url()?>auth/switchLang/<?php echo 'russian'?>">
                      <span><img src="<?php echo base_url();?>assets/logo/language/russian.png" height="35" width="30"></span>&nbsp; Russian
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo base_url()?>auth/switchLang/<?php echo 'spanish'?>">
                      <span><img src="<?php echo base_url();?>assets/logo/language/spanish.png" height="35" width="30"></span>&nbsp; Spanish
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo base_url()?>auth/switchLang/<?php echo 'arabic'?>">
                      <span><img src="<?php echo base_url();?>assets/logo/language/arabic.png" height="35" width="30"></span>&nbsp; Arabic
                    </a>
                  </li>
                </ul>
              </li>
              <!-- <li class="footer"><a href="#">View all</a></li> -->
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php 
                $profile = $this->session->userdata('profile');
                if(!empty($profile))
                {
                ?>
                  <img src="<?php echo base_url();?>assets/images/<?php echo $this->session->userdata('profile');?>" class="user-image">
                <?php
                  }
                else{
                ?>
                  <img src="<?php echo base_url();?>assets/logo/user.png" class="user-image" alt="User Image">  
                <?php }?>

              <span class="hidden-xs">
                <?php  echo $this->session->userdata("first_name").' '.$this->session->userdata("last_name");?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                
                <!-- <img src="<?php echo base_url();?>assets/images/<?php echo $this->session->userdata('profile');?>" class="img-circle" alt="User Image"> -->
                <?php
                if(!empty($profile))
                {
                ?>
                  <img src="<?php echo base_url();?>assets/images/<?php echo $this->session->userdata('profile');?>" class="img-circle">
                <?php
                  }
                else{
                ?>
                  <img src="<?php echo base_url();?>assets/logo/user.png" class="img-circle" alt="User Image">  
                <?php }?>

                <p>
                  <?php  echo $this->session->userdata("first_name").' '.$this->session->userdata("last_name");?> 
                  <small>Member since <?php echo $this->session->userdata("created_on");?></small>
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url();?>auth/set/<?php echo $this->session->userdata("userId");?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url()?>auth/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <!-- <img src="<?php echo base_url();?>assets/images/<?php echo $this->session->userdata('profile');?>" class="img-circle" alt="User Image"> -->
          <?php
          if(!empty($profile))
          {
          ?>
            <img src="<?php echo base_url();?>assets/images/<?php echo $this->session->userdata('profile');?>" width="100" height="150">
          <?php
            }
          else{
          ?>
            <img src="<?php echo base_url();?>assets/logo/user.png" class="img-circle" alt="User Image">  
          <?php }?>
        </div>
        <div class="pull-left info">
          <p><?php  echo $this->session->userdata("first_name").' '.$this->session->userdata("last_name");?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
  
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">  <?php echo $this->lang->line('sidebar_label');?>  </li>
        <li class="active treeview">
          <a href="<?php echo base_url();?>auth">
            <i class="fa fa-dashboard text-primary"></i> 
            <span><?php echo $this->lang->line('sidebar_dashboard');?></span>
            <span class="pull-right-container">
              <!-- <i class="fa fa-angle-left pull-right"></i> -->
            </span>
          </a>
        </li>

        <?php 
          if(isset($user_session)){

          if(in_array("manage_relationship",$user_session)){?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users text-aqua"></i>
                <span> <?php echo $this->lang->line('sidebar_relationship');?> </span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">

              <?php if(isset($user_session)){
                if(in_array("manage_customer",$user_session)){?>
                <li><a href="<?php echo base_url();?>customer/"><i class="fa fa-user text-red"></i> <?php echo $this->lang->line('sidebar_customers');?> </a></li>
              <?php }} ?>

              <?php if(isset($user_session)){
                if(in_array("manage_supplier",$user_session)){?>
                <li><a href="<?php echo base_url();?>supplier/"><i class="fa fa-users text-yellow"></i>  <?php echo $this->lang->line('sidebar_supplier');?>  </a></li>
              <?php }} ?>
                
                 <?php if(isset($user_session)){
                if(in_array("manage_supplier",$user_session)){?>
                <!--<li><a href="<?php echo base_url();?>staff/"><i class="fa fa-users text-blue"></i>  <?php echo "Staff";?>  </a></li>-->
              <?php }} ?>
              </ul>
            </li>
          <?php }} ?>

        <?php 
          if(isset($user_session)){
          if(in_array("manage_item",$user_session)){?>
            <li class="treeview">
              <a href="<?php echo base_url();?>item/">
                <i class="fa fa-list-alt text-yellow"></i> 
                <span>
                    <?php echo "Products";?>
                </span>
                <span class="pull-right-container">
                  <!-- <i class="fa fa-angle-left pull-right"></i> -->
                </span>
              </a>
            </li>
        <?php }} ?>

        <?php 
          if (isset($user_session)) {
          if(in_array("manage_sale",$user_session)){
          ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-truck text-red"></i>
              <span> 
                  <?php echo $this->lang->line('sidebar_sales');?>
              </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php 
              if (isset($user_session)) {
                if(in_array("manage_quotation",$user_session)){
                ?>  
                <li>
                  <a href="<?php echo base_url();?>quotation/"><i class="fa fa-inbox text-red"></i>
                      <?php echo $this->lang->line('sidebar_quotation');?>
                  </a>
                </li>
              <?php }} ?>
                
                
                   <?php 
              if (isset($user_session)) {
                if(in_array("manage_invoice",$user_session)){
                ?>
              <li>
                <a href="<?php echo base_url();?>Order/"><i class="fa fa-shopping-bag text-aqua"></i>
                     <?php echo "Order" ;?>
                </a>
              </li>
              <?php }} ?>
                

              <?php 
              if (isset($user_session)) {
                if(in_array("manage_invoice",$user_session)){
                ?>
              <li>
                <a href="<?php echo base_url();?>sales/"><i class="fa fa-shopping-bag text-aqua"></i>
                     <?php echo $this->lang->line('sidebar_invoice');?>
                </a>
              </li>
              <?php }} ?>

              <?php 
              if (isset($user_session)) {
                if(in_array("manage_payment",$user_session)){
                ?>
                  <li>
                    <a href="<?php echo base_url();?>payment/"><i class="fa fa-credit-card text-yellow"></i>
                      <?php echo $this->lang->line('sidebar_payment');?>
                    </a>
                  </li>
              <?php }} ?>
            </ul>
          </li>
        <?php }} ?>

        <?php 
          if (isset($user_session)) {
          if(in_array("manage_purchase",$user_session)){?>
        <li class="treeview">
          <a href="<?php echo base_url();?>purchases/">
            <i class="fa fa-shopping-cart text-green"></i>
            <span>
                <?php echo $this->lang->line('sidebar_purchase');?>
            </span>
            <span class="pull-right-container">
              <!-- <i class="fa fa-angle-left pull-right"></i> -->
            </span>
          </a>
        </li>
        <?php }} ?>

        <li class="treeview">
          <a href="<?php echo base_url();?>log/">
            <i class="fa fa-shopping-cart text-green"></i>
            <span>
                Purchases Log
                <!-- <?php echo $this->lang->line('sidebar_purchase');?> -->
            </span>
            <span class="pull-right-container">
              <!-- <i class="fa fa-angle-left pull-right"></i> -->
            </span>
          </a>
        </li>

        <?php 
          if (isset($user_session)) {
          if(in_array("manage_banking_transaction",$user_session)){?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-bank text-aqua"></i>
              <span>
                 <?php echo $this->lang->line('sidebar_bank_trans');?>
              </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

            <?php 
            if (isset($user_session)) {
            if(in_array("manage_bank_account",$user_session)){?>
              <li><a href="<?php echo base_url();?>bank/"><i class="fa fa-home text-success"></i> 
                <?php echo $this->lang->line('sidebar_account');?>
              </a></li>
            <?php }} ?>

            <?php 
            if (isset($user_session)) {
            if(in_array("manage_deposit",$user_session)){?>
              <li><a href="<?php echo base_url();?>deposit/"><i class="fa fa-money text-info"></i> 
                 <?php echo $this->lang->line('sidebar_deposit');?>
                <!-- Bank Account Deposits -->
                </a>
              </li>
            <?php }} ?>

            <?php 
            if (isset($user_session)) {
            if(in_array("manage_balance_transfer",$user_session)){?>
              <li><a href="<?php echo base_url();?>transfer/"><i class="fa fa-exchange text-danger"></i> 
               <?php echo $this->lang->line('sidebar_transfer');?>
              <!-- Bank Account Transfers -->
              </a></li>
            <?php }} ?>

            <?php 
            if (isset($user_session)) {
            if(in_array("manage_banking_transaction",$user_session)){?>
              <li><a href="<?php echo base_url();?>transaction/"><i class="fa fa-history text-yellow"></i> 
                <?php echo $this->lang->line('sidebar_transaction');?>
              <!-- Transactions -->
              </a></li>
            <?php }} ?>

            </ul>
          </li>
        <?php }} ?>

        <?php 
          if (isset($user_session)) {
          if(in_array("manage_expense",$user_session)){?>
        <li class="treeview">
          <a href="<?php echo base_url();?>expense/">
            <i class="fa fa-dollar text-maroon"></i>  
            <span>
              <?php echo $this->lang->line('sidebar_expense');?>
              <!-- Expenses -->
              </span>
            <span class="pull-right-container">
              <!-- <i class="fa fa-angle-left pull-right"></i> -->
            </span>
          </a>
        </li>
        <?php }} ?>

        <li class="treeview">
            <a href="#">
              <i class="fa fa-navicon text-red"></i>
              <span> 
                  GST Return
                  <!-- <?php echo $this->lang->line('sidebar_sales');?> -->
              </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <li>
                  <a href="<?php echo base_url();?>gst_return/"><i class="fa fa-gg text-red"></i>
                      <!-- <?php echo $this->lang->line('sidebar_quotation');?> -->
                      GSTR1
                  </a>
                </li>
            </ul>
        </li>


        <li class="treeview">
          <a href="<?php echo base_url();?>credit_debit_note/">
            <i class="fa fa-outdent text-green"></i>
            <span>
                Credit/Debit Note
            </span>
            <span class="pull-right-container">
              <!-- <i class="fa fa-angle-left pull-right"></i> -->
            </span>
          </a>
        </li>
  
        
                <?php 
          if(isset($user_session)){

          if(in_array("manage_relationship",$user_session)){?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users text-aqua"></i>
                <span> <?php echo "Lead Management"?> </span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">

              <?php if(isset($user_session)){
                if(in_array("manage_customer",$user_session)){?>
                <li><a href="<?php echo base_url();?>Management/lead_customer"><i class="fa fa-user text-red"></i> <?php echo "Lead Customer";?> </a></li>
              <?php }} ?>

           
              </ul>
            </li>
          <?php }} ?>
        

           <li class="treeview">
          <a href="<?php echo base_url();?>Ledger/">
            <i class="fa fa-outdent text-red"></i>
            <span>
                Ledger
            </span>
            <span class="pull-right-container">
              <!-- <i class="fa fa-angle-left pull-right"></i> -->
            </span>
          </a>
        </li>
        
           <li class="treeview">
          <a href="<?php echo base_url();?>Voucher/">
            <i class="fa fa-outdent text-red"></i>
            <span>
                Voucher
            </span>
            <span class="pull-right-container">
              <!-- <i class="fa fa-angle-left pull-right"></i> -->
            </span>
          </a>
        </li>
        
        
        <?php 
          if (isset($user_session)) {
          if(in_array("manage_report",$user_session)){?>
        <li class="treeview">
          <a href="">
            <i class="fa fa-flag text-yellow"></i>
            <span> 
              <!-- Reports -->
              <?php echo $this->lang->line('sidebar_reports');?>
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <?php 
            if (isset($user_session)) {
            if(in_array("manage_stock_on_hand",$user_session)){?>
              <li><a href="<?php echo base_url();?>inventorystockhand/"><i class="fa fa-stack-overflow text-info"></i> 
              <!-- Inventory Stock On Hand -->
               <?php echo $this->lang->line('sidebar_inventory');?>
              </a></li>
            <?php }} ?>


            <?php 
            if (isset($user_session)) {
            if(in_array("manage_sale_report",$user_session)){?>
              <li><a href="<?php echo base_url();?>salesreport/"><i class="fa fa-shopping-cart text-danger"></i> 
                <!-- Sales Reports -->
                <?php echo $this->lang->line('sidebar_salesreports');?>
              </a></li>
            <?php }} ?>


            <?php 
            if (isset($user_session)) {
            if(in_array("manage_sale_history_report",$user_session)){?>
              <li><a href="<?php echo base_url();?>reports/sales_report"><i class="fa fa-bar-chart text-success"></i> 
                <!-- Sales History Reports -->
                <?php echo $this->lang->line('sidebar_saleshistory');?>
              </a></li>
            <?php }} ?>


            <?php 
            if (isset($user_session)) {
              if(in_array("manage_purchase_report",$user_session)){?>
            <li><a href="<?php echo base_url();?>purchasereport/"><i class="fa fa-camera-retro text-warning"></i> 
              <?php echo $this->lang->line('sidebar_purhcasereport');?>
              <!-- Purchase Reports -->
            </a></li>
            <?php }} ?>

            <?php 
            if (isset($user_session)) {
              if(in_array("manage_expense_report",$user_session)){?>
              <li><a href="<?php echo base_url();?>reportexpense/"><i class="fa fa-credit-card text-aqua"></i> 
                <!-- Expense Report -->
                 <?php echo $this->lang->line('sidebar_expensereport');?>
                </a></li>
            <?php }} ?>


            <?php 
            if (isset($user_session)) {
              if(in_array("manage_income_report",$user_session)){?>
            <li><a href="<?php echo base_url();?>reports/"><i class="fa fa-usd text-yellow"></i> 
            <!-- Income Reports -->
              <?php echo $this->lang->line('sidebar_income');?>
            </a></li>
            <?php }} ?>

            <?php 
            if (isset($user_session)) {
              if(in_array("manage_income_vs_expense",$user_session)){?>
            <li><a href="<?php echo base_url();?>incomevsexpense/"><i class="fa fa-heartbeat text-red"></i> 
              <!-- Income VS Expense -->
              <?php echo $this->lang->line('sidebar_incomeexpensereports');?>
            </a></li>
            <?php }} ?>

            <li><a href="<?php echo base_url();?>reports/receivable_payment/"><i class="fa fa-youtube-square text-yellow"></i> 
              receivable payment
              <!-- <?php echo $this->lang->line('sidebar_incomeexpensereports');?> -->
            </a></li>

          </ul>
        </li>        
        <?php }} ?>


        <!-- <?php 
          if (isset($user_session)) {
          if(in_array("manage_setting",$user_session)){
          ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog"></i>
            <span> 
              <?php echo $this->lang->line('sidebar_settings');?>
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php 
            if (isset($user_session)) {
              if(in_array("manage_company_setting",$user_session)){?>
              <li>
                <a href="<?php echo base_url();?>settings/"><i class="fa fa-circle-o text-red"></i> 
                <?php echo $this->lang->line('sidebar_companydetails');?>
                </a>
              </li>
            <?php }} ?>

            <?php 
            if (isset($user_session)) {
              if(in_array("manage_general_setting",$user_session)){?>
            <li><a href="<?php echo base_url();?>category/"><i class="fa fa-circle-o text-yellow"></i> 
              <?php echo $this->lang->line('sidebar_general');?>
            </a></li>
            <?php }} ?>


            <?php 
            if (isset($user_session)) {
              if(in_array("manage_finance",$user_session)){?>
            <li><a href="<?php echo base_url();?>tax/"><i class="fa fa-circle-o text-yellow"></i> 
            <?php echo $this->lang->line('sidebar_finance');?></a></li>
            <?php }} ?>
          </ul>
        </li>  
        <?php }} ?> -->


        <?php 
          if (isset($user_session)) {
          if(in_array("manage_company_setting",$user_session)){
          ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database text-success"></i>
            <span> 
              <!-- Company Details -->
                <?php echo $this->lang->line('sidebar_companydetails');?>
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(isset($user_session)){
              if(in_array("manage_company_setting",$user_session)){
            ?>
              <li class=active>
                <a href="<?php echo base_url();?>settings/"><i class="fa fa-circle-o text-red"></i>
                <!-- Company Settings -->
                    <?php echo $this->lang->line('lbl_company_header');?>
                </a>
              </li>
            <?php }} ?>

            <?php if(isset($user_session)){
              if(in_array("manage_team_member",$user_session)){
              ?>
              <li>
                <a href="<?php echo base_url();?>settings/member_list"><i class="fa fa-user-plus text-aqua"></i>
                  <!-- Team Members -->
                  <?php echo $this->lang->line('lbl_sidemenu_teammember');?>
                </a>
              </li>
            <?php }} ?>

            <?php if(isset($user_session)) {
              if(in_array("manage_role",$user_session)){
            ?>
              <li><a href="<?php echo base_url();?>permission"><i class="fa fa-unlock-alt text-yellow"></i>
                  <!-- User Roles -->
                    <?php echo $this->lang->line('lbl_sidemenu_userroles');?>
                  </a>
              </li>
            <?php }}?>

            <?php if(isset($user_session)) {
              if(in_array("manage_location",$user_session)){
            ?>
              <li><a href="<?php echo base_url();?>location"><i class="fa fa-home text-red"></i>
                    <!-- Locations -->
                    <?php echo $this->lang->line('lbl_warehouses');?>
                  </a>
              </li>
            <?php }} ?>
          </ul>
        </li>  
        <?php }} ?>





        <?php 
          if (isset($user_session)) {
          if(in_array("manage_general_setting",$user_session)){
          ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-hourglass text-info"></i>
            <span> 
              <!-- General Settings -->
                <?php echo $this->lang->line('sidebar_general');?>
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <?php if(isset($user_session)){
                    if(in_array("manage_item_category",$user_session)){
                  ?>
                <li class=active><a href="<?php echo base_url();?>category/"><i class="fa fa-th-large text-red"></i>
                    <!-- Item Categories -->
                    <?php echo $this->lang->line('lbl_general_sidemenu_itemcat');?>
                    </a>
                </li>
                <?php }} ?>


                <?php if(isset($user_session)){
                    if(in_array("manage_income_expense_category",$user_session)){
                  ?>
                <li><a href="<?php echo base_url();?>generalsetting/"><i class="fa fa-th-list text-yellow"></i>
                    <!-- Income Expense Category -->
                    <?php echo $this->lang->line('lbl_general_sidemenu_incomecat');?>
                    </a>
                </li>
                <?php }} ?>


                <?php if(isset($user_session)){
                    if(in_array("manage_unit",$user_session)){
                  ?>
                <li ><a href="<?php echo base_url();?>unit"><i class="fa fa-balance-scale text-aqua"></i>
                      <!-- Units -->
                      <?php echo $this->lang->line('lbl_general_sidemenu_units');?>
                      </a>
                </li>
                <?php }} ?>

                <?php if(isset($user_session)){
                    if(in_array("manage_email_setup",$user_session)){
                  ?>
                <li ><a href="<?php echo base_url();?>emailsetup/"><i class="fa fa-envelope text-red"></i>
                      <!-- Email Setup -->
                      <?php echo $this->lang->line('lbl_general_sidemenu_emailsetup');?>
                      </a>
                </li>
                <?php }} ?>

                <li ><a href="<?php echo base_url();?>backup/"><i class="fa fa-cloud-download bg-purple"></i>
                      Database Backup
                      <!-- <?php echo $this->lang->line('lbl_general_sidemenu_emailsetup');?> -->
                      </a>
                </li>

                <li ><a href="<?php echo base_url();?>barcode/print_barcode"><i class="fa fa-barcode btn-warning"></i>
                      Print Barcode
                      <!-- <?php echo $this->lang->line('lbl_general_sidemenu_emailsetup');?> -->
                      </a>
                </li>

          </ul>
        </li>  
        <?php }} ?>




             <?php 
          if (isset($user_session)) {
          if(in_array("manage_finance",$user_session)){
          ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-gg-circle text-danger"></i>
            <span> 
              <!--  Finance -->
                <?php echo $this->lang->line('sidebar_finance');?>
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <?php if(isset($user_session)){
               if(in_array("manage_tax",$user_session)){
            ?>
              <li class="active"><a href="<?php echo base_url();?>tax"><i class="fa fa-percent text-aqua"></i>
                  <!-- Taxes -->
                    <?php echo $this->lang->line('lbl_finance_sidemenu_tax');?>
                  </a>
              </li>
            <?php }}?>

            <?php if(isset($user_session)){
               if(in_array("manage_currency",$user_session)){
            ?>
              <li ><a href="<?php echo base_url();?>currency"><i class="fa fa-dollar text-red"></i>
                    <!-- Currencies -->
                      <?php echo $this->lang->line('lbl_finance_sidemenu_currancy');?>
                    </a>
              </li>
            <?php }} ?>

            <?php if(isset($user_session)){
               if(in_array("manage_payment_term",$user_session)){
            ?>
              <li ><a href="<?php echo base_url();?>paymentterms/"><i class="fa fa-cc-mastercard text-yellow"></i>
                  <!-- Payment Terms -->
                    <?php echo $this->lang->line('lbl_finance_sidemenu_terms');?>
                  </a>
              </li>
            <?php }} ?>

            <?php if(isset($user_session)){
               if(in_array("manage_payment_method",$user_session)){
            ?>
              <li ><a href="<?php echo base_url();?>paymentmethod/"><i class="fa fa-paypal text-aqua"></i>
                <!-- Payment Methods -->
                  <?php echo $this->lang->line('lbl_finance_sidemenu_method');?></a>
              </li>
            <?php }} ?>

            <!-- <?php if(isset($user_session)){
               if(in_array("manage_payment_gateway",$user_session)){
            ?>
              <li><a href="<?php echo base_url();?>settings/pgetway"><i class="fa fa-circle-o text-red"></i>
                    <?php echo $this->lang->line('lbl_finance_sidemenu_getway');?>
                  </a>
              </li>
            <?php }} ?> -->

                </ul>
              </li>  
              <?php }} ?>




      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>