<?php 
	$this->load->view('layout/header');
?>
<!-- <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script> -->

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      

      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <!-- <div class="box-header">
              <h3 class="box-title"> List Of Users</h3>
            </div> -->            <!-- /.box-header -->
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>
                    <!-- Date -->
                    <?php echo $this->lang->line('lbl_transaction_date');?>
                  </th>
                  <th>
                    <!-- Account Name -->
                    <?php echo $this->lang->line('lbl_transaction_accountname');?>
                  </th>
                  <th>
                    <!-- Account Number -->
                    <?php echo $this->lang->line('lbl_transaction_accountno');?>
                  </th>
                  <th>
                    <!-- Type -->
                    <?php echo $this->lang->line('lbl_transaction_type');?>
                  </th>
                  <th>
                    <!-- Category -->
                    <?php echo $this->lang->line('lbl_transaction_category');?>
                  </th>
                  <th>
                    <!-- Description -->
                    <?php echo $this->lang->line('lbl_transaction_desc');?>
                  </th>
                  <th>
                    <!-- Amount -->
                    <?php echo $this->lang->line('lbl_transaction_amount');?>
                  </th>
                </tr>
                </thead>

                <tbody>
                   <?php
                  foreach ($transaction as $value) {
                ?>
                <tr>
                  <td><?php echo $value->date;?></td>
                  <td><?php echo $value->account_name;?></td>
                  <td><?php echo $value->account_no;?></td>
                  <td><?php echo $value->type;?></td>
                  <td><?php echo $value->name;?></td>
                  <td><?php echo $value->description;?></td>
                  <td><?php echo $value->amount;?></td>
                  
                </tr>
                <?php
                   }
                ?>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>
                    <!-- Date -->
                    <?php echo $this->lang->line('lbl_transaction_date');?>
                  </th>
                  <th>
                    <!-- Account Name -->
                    <?php echo $this->lang->line('lbl_transaction_accountname');?>
                  </th>
                  <th>
                    <!-- Account Number -->
                    <?php echo $this->lang->line('lbl_transaction_accountno');?>
                  </th>
                  <th>
                    <!-- Type -->
                    <?php echo $this->lang->line('lbl_transaction_type');?>
                  </th>
                  <th>
                    <!-- Category -->
                    <?php echo $this->lang->line('lbl_transaction_category');?>
                  </th>
                  <th>
                    <!-- Description -->
                    <?php echo $this->lang->line('lbl_transaction_desc');?>
                  </th>
                  <th>
                    <!-- Amount -->
                    <?php echo $this->lang->line('lbl_transaction_amount');?>
                  </th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <section class="content">
    </section>
  </div>

<?php 
	$this->load->view('layout/footer');
?>

