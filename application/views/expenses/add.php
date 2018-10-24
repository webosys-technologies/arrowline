<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("add_expense",$user_session)){
      redirect('expense','refresh');
  }


?>

  <div class="content-wrapper">
    <!-- Main content -->

    
    <section class="content">

      <div class="box">
        <div class="box-body">
          <strong>
           Expense
           <!-- <?php echo $this->lang->line('lbl_deposit_header');?> -->
          </strong>
        </div>
      </div>

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-default">
            <div class="box-header with-border">
                <div style="margin-left: 30px;">
                  <h3 class="box-title">
                    <!-- New Expenses --><b>
                    <?php echo $this->lang->line('lbl_addexpense_header');?></b>
                  </h3>
                </div>
            </div>

              <form name="Form" action="<?php echo base_url();?>expense/add"  method="post" class="form-horizontal" enctype="multipart/form-data">
                     
                  <div class="box-body" style="padding: 20px">
                     <div class="form-group">
                       <label for="inputEmail3" class="col-sm-2 control-label">
                          <!-- Account -->
                          <?php echo $this->lang->line('lbl_addexpense_account');?>
                        <label style="color:red;">*</label></label>
                         <div class="col-sm-4">
                            <div class="control">
                               <select class="form-control select2" id="acount" name="acount" tabindex="2" onblur='chkEmpty("Form","acount","Please Enter Name");'>
                                 <?php foreach ($account as $value) {?>
                                 <option value="<?php echo $value->id;?>"><?php echo $value->account_name;?></option>
                                 <?php } ?>  
                              </select>
                              <span style="color: red;"><?php echo form_error('acount'); ?></span>
                              <p style="color:#990000;"></p>  
                           </div> 
                      </div>
                  </div>

                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-2 control-label">
                      <!-- Date -->
                      <?php echo $this->lang->line('lbl_addexpense_date');?>
                      <label style="color:red;">*</label></label>
                       <div class="col-sm-4">
                         <div class="input-group date">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <div class="control">
                              <input type="text" class="form-control pull-right" id="datepicker" name="date" tabindex="2" onblur='chkEmpty("Form","date","Please Select Date");' placeholder="<?php echo $this->lang->line('lbl_addexpense_date');?>" value="<?php echo date('Y-m-d');?>">
                           </div>
                              <span style="color: red;"><?php echo form_error('date'); ?></span>
                              <p style="color:#990000;"></p>  
                         </div>
                     </div> 
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">
                      <!-- Description -->
                      <?php echo $this->lang->line('lbl_addexpense_desc');?>
                    </label>
                      <div class="col-sm-4">
                        <div class="control">
                            <input type="text" class="form-control" name="desc" id="desc" placeholder="<?php echo $this->lang->line('lbl_addexpense_desc');?>" tabindex="2">
                            <span style="color: red;"><?php echo form_error('desc'); ?></span>
                             <p style="color:#990000;"></p>
                          </div> 
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">
                      <!-- Amount -->
                      <?php echo $this->lang->line('lbl_addexpense_amount');?>
                    <label style="color:red;">*</label></label>
                      <div class="col-sm-4">
                        <div class="control">
                            <input type="number" class="form-control" name="amount" id="amount" placeholder="<?php echo $this->lang->line('lbl_addexpense_amount');?>" min="0" tabindex="2" onblur='chkEmpty("Form","amount","Please Enter Amount");'>
                            <span style="color: red;"><?php echo form_error('amount'); ?></span>
                             <p style="color:#990000;"></p>
                          </div> 
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">
                      <!-- Category -->
                      <?php echo $this->lang->line('lbl_addexpense_category');?>
                      <label style="color:red;">*</label></label>
                      <div class="col-sm-4">
                        <div class="control">
                            <select class="form-control select2" id="category" name="category">
                            <?php foreach ($category as $value) {?>
                            <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
                            <?php } ?>    
                            </select>
                            <a href="#category_model" data-toggle="modal" data-target="" ><span class="">Add Income/expense Category</span></a>
                            <span style="color: red;"><?php echo form_error('category'); ?></span>
                            <p style="color:#990000;"></p>
                        </div> 
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">
                      Payment Method
                      <!-- <?php echo $this->lang->line('lbl_addexpense_paymentmethod');?> -->
                      <label style="color:red;">*</label></label>
                      <div class="col-sm-4">
                        <div class="control">
                            <select class="form-control select2" id="payment_method" name="payment_method">
                            <?php foreach ($payment as $value) {?>
                            <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
                            <?php } ?>    
                            </select>
                            <a href="#paymentmethod" data-toggle="modal" data-target=""><span class="" style="">Add Payment Method</span></a>
                            <span style="color: red;"><?php echo form_error('units'); ?></span>
                            <p style="color:#990000;"></p>
                          </div> 
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="bank_name" class="col-sm-2 control-label">
                      Bank Name
                      <!-- <?php echo $this->lang->line('lbl_transfer_amount');?> -->
                    </label>
                    <div class="col-sm-4">
                      <div class="control">
                          <input type="text" class="form-control" name="bank_name" id="bank_name" value="" placeholder="Bank Name">
                          <span style="font-size:20px;"></span>
                          <p style="color:#990000;"></p>
                        </div> 
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="cheque_no" class="col-sm-2 control-label">
                      Cheque No 
                      <!-- <?php echo $this->lang->line('lbl_transfer_amount');?> -->
                    </label>
                    <div class="col-sm-4">
                      <div class="control">
                          <input type="text" class="form-control" name="cheque_no" id="cheque_no" value="" placeholder="Cheque No">
                          <span style="font-size:20px;"></span>
                          <p style="color:#990000;"></p>
                        </div> 
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">
                      <!-- Reference -->
                      <?php echo $this->lang->line('lbl_addexpense_reference');?>
                    </label>
                      <div class="col-sm-4">
                        <div class="control">
                          <?php
                          $orderno=sprintf('%03d',intval($referense)+1);
                          ?>
                          <input type="text" class="form-control" name="reference" id="reference" value="<?php echo $orderno;?>" placement="<?php echo $this->lang->line('lbl_addexpense_reference');?>">
                        </div> 
                      </div>
                  </div>
                    

                  <!-- <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Attachment</label>
                      <div class="col-sm-6">
                        <div class="control">
                            <input type="file" class="form-control" name="picture" id="picture" placeholder="picture">
                            <span style="color: red;"><?php echo form_error('picture'); ?></span>
                            <p style="color:#990000;"></p>
                      
                          </div> 
                      </div>
                  </div> -->
                </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <div style="margin-left: 120px;">
                      <input type="submit" class="btn btn-info btn-flat" name="formSubmit" value="<?php echo $this->lang->line('btn_submit');?>"> 
                      <a class="btn btn-default btn-flat" href="<?php echo base_url();?>expense/">
                        <?php echo $this->lang->line('btn_cancel');?>
                        </a>
                    </div>
                  </div>
              </form>
          </div>
        </div>
      </div> 
   </section>

   <!-- ADD NEW CATEGORY -->
    <div class="example-modal">
      <div class="modal fade" id="category_model">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <center><h4 class="modal-title">
                <b>Add New Category</b>
              </h4></center>
            </div>
            <div class="modal-body">  
                    <div class="form-group">
                      <label class="col-sm-4 control-label require" for="inputEmail3"> 
                          Category Name
                        <span class="text-danger">*</span>
                      </label>

                      <div class="col-sm-6">
                        <input type="text" placeholder="Category Name" class="form-control valdation_check" id="category_name" name="category_name">
                        <span style="color: #990000"></span>
                        <p style="color:#990000;" id="category_error"></p>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-4 control-label require" for="inputEmail3"> 
                          Type
                        <span class="text-danger">*</span>
                      </label>

                      <div class="col-sm-6">
                        <select class="form-control select2" id="type" name="type" style="width: 100%">
                              <option value="expense">Expense</option>  
                        </select>
                        <span style="color: #990000"></span>
                        <p style="color:#990000;" id="type_error"></p>
                      </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><!-- Close -->
                <?php echo $this->lang->line('btn_modal_close');?>
                </button>
                <input type="submit" class="btn btn-danger" value="Save" id="add_category" name="add_category" data-dismiss="modal">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>
    <!-- /.example-modal -->

    <!-- ADD NEW PAYMENT METHOD -->
    <div class="example-modal">
      <div class="modal fade" id="paymentmethod">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <center><h4 class="modal-title">
                <b>Add New Payment Method</b>
              </h4></center>
            </div>
            <div class="modal-body">  
                    <div class="form-group">
                      <label class="col-sm-4 control-label require" for="inputEmail3"> 
                          Payment Method
                        <span class="text-danger">*</span>
                      </label>

                      <div class="col-sm-6">
                        <input type="text" placeholder="Payment Method Name" class="form-control valdation_check" id="payment" name="payment">
                        <span style="color: #990000"></span>
                        <p style="color:#990000;" id="method_error"></p>
                      </div>
                    </div>
                    <br>
                    <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><!-- Close -->
                <?php echo $this->lang->line('btn_modal_close');?>
                </button>
                <input type="submit" class="btn btn-danger" value="Save" id="add_payment" name="add_payment" data-dismiss="modal">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>
    <!-- /.example-modal -->


 </div>


<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?> 

<script type="text/javascript">
    $(document).ready(function(){

      $("#add_category").click(function ()
      {
          var category = $("#category_name").val();
          var type = $("#type").val();
    
          if(category=="")
          {
            $('#category_error').text("Enter Category Name");
            return false;
          }

          if(type=="")
          {
            $('#type_error').text("Select Type");
            return false;
          }

          $('#category').html('<option value="">Select</option>');
          $.ajax({
            url:"<?php echo base_url('deposit/add_category');?>",
            method:"POST",
            data:{
                category_name:category,
                type:type
            },
            dataType : "json",
            success:function(data1)
            {
                var id = data1['category_id'];
                for(i=0;i<data1['category'].length;i++){
                    $('#category').append('<option value="' + data1['category'][i].id + '">' + data1['category'][i].name + '</option>');
                }
                $('select[name^="category"] option[value="'+id+'"]').attr("selected","selected");
                $("#category_name").val("");
            }
          });
      });

      $("#add_payment").click(function ()
      {
          var paymentmethod = $("#payment").val();
          if(paymentmethod=="")
          {
            $('#method_error').text("Enter Payment Method Name");
            return false;
          }
          $('#payment_method').html('<option value="">Select</option>');
          $.ajax({
            url:"<?php echo base_url('quotation/add_paymentmethod');?>",
            method:"POST",
            data:{payment_method:paymentmethod},
            dataType : "json",
            success:function(data1)
            {
                var id = data1['paymentmethod'];
                for(i=0;i<data1['method'].length;i++){
                    $('#payment_method').append('<option value="' + data1['method'][i].id + '">' + data1['method'][i].name + '</option>');
                }
                $('select[name^="payment_method"] option[value="'+id+'"]').attr("selected","selected");
                $("#payment").val("");
            }
          });
      });


       $("input[name='formSubmit']").click(function(e)
       {
           var date = chkEmpty("Form","date","Please Select Date");
           var account = chkDrop("Form","acount","Please Select Account");
           var cat = chkDrop("Form","category","Please Select Category");
           var amount = chkEmpty("Form","amount","Please Enter Amount");

           if((date+account+cat+amount) < 1){
             Form.submit();
             return true;
           }
           else
           {
             return false;
           }           
        });      
   });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    
    jQuery('#desc').keyup(function (){
      this.value = this.value.replace(/([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/g, function(str) { 
      ('You typed " ' + str + ' ".\n\nPlease use only alphabetic.'); return ''; });
       if($(this).val().length > 100)
       {
         $(this).val($(this).val().substring(0, 100));
       }
   });

    jQuery('#amount').keyup(function () {
     this.value = this.value.replace(/[^0-9]/g, function(str) { 
      ('You typed " ' + str + ' ".\n\nPlease use only Numbers.'); return ''; });
     
  });
});
</script>    
