<?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
      redirect('auth','refresh');
  }
  
  if(!in_array("manage_item",$user_session)){
      redirect('auth','refresh');
  }

?>
<div class="content-wrapper">
       
  <section class="content">
    <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">
                 <div class="top-bar-title padding-bottom">
                  Receivable Payment
                 <!-- <?php echo $this->lang->line('item_heading');?> -->
                 </div>
            </div> 
            

            </div>
        </div>
      </div>  
    <!-- Top Box-->
      
   

      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            
             <div class="box-header">
              
            </div>
            <!-- /.box-header -->
           
            <div class="box-body">
              <table id="index" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>
                      No
                    </th>
                    <th class="text-right">
                      Invoive No
                      <!-- <?php echo $this->lang->line('lbl_item_image');?> -->
                    </th>
                    <th class="text-right">
                      Customer Name
                      <!-- <?php echo $this->lang->line('lbl_item_name');?> -->
                    </th>
                    <th class="text-right">
                      Receivable Amount
                      <!-- <?php echo $this->lang->line('lbl_item_name');?> -->
                    </th>
                    <th class="text-right">
                      Total Payment
                      <!-- <?php echo $this->lang->line('lbl_item_category');?> -->
                    </th>
                    <th class="text-right">
                      Paid Amount
                      <!-- <?php echo $this->lang->line('lbl_item_category');?> -->
                    </th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach ($payment as $key => $value) {?>
                  <tr>
                      <td></td>
                      <td class="text-right"><?php echo $value->reference_no?></td>
                      <td class="text-right"><?php echo $value->name?></td>
                      <td class="text-right">
                      <?php if(isset($value->pending))
                        if($value->pending > 0){
                      ?>
                        <label class="text-danger"><?php echo $value->pending?></label>
                      <?php }else{?>
                        <label class="text-success"><?php echo $value->pending?></label>
                      <?php }?>
                      </td>
                      <td class="text-right"><?php echo $value->sales_amount?></td>
                      <td class="text-right"><?php echo $value->paid_amount?></td>
                  </tr>
                  <?php } ?>
                </tbody>
                
              </table>
            </div>
            
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  </section>
    <!-- /.content -->

  </div>

<?php 
  $this->load->view('layout/footer');
?> 

