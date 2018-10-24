<?php 
$this->load->view('layout/header');
?>

<div class="content-wrapper">
    <section class="content">
      <div class="box-footer">
          <h4 class="box-title">
            Purchases Log
          </h4>
      </div>
      <br>
       <div class="row">
          <div class="col-xs-12">
              <div class="box">  
                <div class="box-body">
                    <table id="indexdesc" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>
                              <!-- Date -->
                              <?php echo $this->lang->line('lbl_transaction_date');?>
                            </th>
                            <th>
                              User Name
                              <!-- <?php echo $this->lang->line('lbl_transaction_accountname');?> -->
                            </th>
                            <th>
                              Reference No
                              <!-- <?php echo $this->lang->line('lbl_transaction_accountno');?> -->
                            </th>
                            <th>
                              Message
                              <!-- <?php echo $this->lang->line('lbl_transaction_type');?> -->
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                             <?php
                            foreach ($log as $value) {
                          ?>
                          <tr>
                            <td><?php echo $value->date;?></td>
                            <td><?php echo $value->first_name;?> <?php echo $value->last_name;?></td>
                            <td><?php echo $value->reference_no;?></td>
                            <td><?php echo $value->msg;?></td>
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
                              User Name
                              <!-- <?php echo $this->lang->line('lbl_transaction_accountname');?> -->
                            </th>
                            <th>
                              Reference No
                              <!-- <?php echo $this->lang->line('lbl_transaction_accountno');?> -->
                            </th>
                            <th>
                              Message
                              <!-- <?php echo $this->lang->line('lbl_transaction_type');?> -->
                            </th>
                          </tr>
                        </tfoot>
                    </table>
                      
                </div>
                    <!-- /.box-body -->           
              </div>
        </div>
      </div>
    </section> 
</div>     
<?php 
  $this->load->view('layout/footer');
?>