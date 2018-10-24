<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("edit_deposit",$user_session)){
      redirect('deposit','refresh');
  }


?>


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
       
       <ol class="breadcrumb">
        <li>
          <a href="<?php echo base_url();?>deposit/"><i class="fa fa-dashboard"></i>
            <?php echo $this->lang->line('home');?>
          </a>
        </li>
        <li class="active">
          <!-- Dashboard -->
          <?php echo $this->lang->line('lbl_deposit_header');?>
        </li>
      </ol>
      </h5>
     
    </section>    
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-default">
            <div class="box-header with-border">
              <div style="margin-left: 60px;">
              <h3 class="box-title">
                <!-- Update bank Account deposits -->
                <b><?php echo $this->lang->line('lbl_deposit_update');?></b>
              </h3>
              </div>
            </div>

            <div style="margin-top: 20px;">
            <form action="<?php echo base_url();?>deposit/update"  method="post" class="form-horizontal" enctype="multipart/form-data" name="depositeForm">
                 <input type="hidden" name="id" value="<?php echo $dep->id;?>">
               <div class="form-group">
                    <label for="account" class="col-sm-2 control-label">
                      <!-- Account -->
                      <?php echo $this->lang->line('lbl_adddeposit_account');?>
                    </label>
                    <div class="col-sm-4">
                      <div class="control">
                            <select class="form-control select2" id="account" name="account">
                                <?php 
                              foreach($acc as $row)
                              {
                            ?>  
                                <option value="<?php echo $row->id;?>"
                                <?php if($row->id==$dep->account_id)
                                  { echo "selected";}
                                ?>>
                                <?php echo $row->account_name;?></option>  
                            <?php
                              }
                            ?>        
                            </select>
                            <p style="color:#990000;"></p>
                        </div> 
                    </div>
                  </div>
                  <div class="form-group">
                  <label class="col-sm-2 control-label require" for="inputEmail3">
                    <!-- Date -->
                    <?php echo $this->lang->line('lbl_adddeposit_date');?>
                  </label>
                    <div class="col-sm-4">
                    <div class="control">
                      <input type="text" class="form-control" id="datepicker1" name="date" value="<?php echo $dep->date?>" placeholder="<?php echo $this->lang->line('lbl_adddeposit_date');?>">
                      
                  </div>
                  </div>
                  </div>

                  <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">
                      <!-- Description -->
                      <?php echo $this->lang->line('lbl_adddeposit_desc');?>
                    </label>
                    <div class="col-sm-4">
                      <div class="control">
                          <input type="text" class="form-control" id="description" placeholder="<?php echo $this->lang->line('lbl_adddeposit_desc');?>" name="desc" value="<?php echo $dep->description?>">
                            <p style="color:#990000;"></p>
                        </div> 
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="accountnumber" class="col-sm-2 control-label">
                      <!-- Amount -->
                      <?php echo $this->lang->line('lbl_adddeposit_amount');?>
                    </label>
                    <div class="col-sm-4">
                      <div class="control">
                          <input type="text" class="form-control" id="amount" placeholder="<?php echo $this->lang->line('lbl_adddeposit_amount');?>" name="amount" value="<?php echo $dep->amount?>">
                          <input type="hidden" class="form-control" id="old_amount" name="old_amount" value="<?php echo $dep->amount?>">
                          <p style="color:#990000;"></p>
                        </div> 
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="category" class="col-sm-2 control-label">
                      <!-- category -->
                      <?php echo $this->lang->line('lbl_adddeposit_category');?>
                    </label>
                    <div class="col-sm-4">
                      <div class="control">
                            <select class="form-control select2" id="category" name="category" tabindex="1" onb lur='chkEmpty("customerForm","branch","Please Enter Branch Name";'>
                                <option value="">
                                  <!-- Select One -->
                                  <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                </option>
                                <?php foreach($cat as $row) { ?>
                                    <option value="<?php echo $row->id;?>" 
                                    <?php if($row->id==$dep->category_id)
                                      { echo "selected";}
                                    ?>>
                                    <?php echo $row->name;?></option>  
                                <?php } ?>
                            </select>
                            <a href="#category_model" data-toggle="modal" data-target="" ><span class="">Add Income/expense Category</span></a>
                            <p style="color:#990000;"></p>
                        </div> 
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="paymentmethod" class="col-sm-2 control-label">
                    <!-- Payment-Method -->
                    <?php echo $this->lang->line('lbl_adddeposit_paymentmethod');?>
                    </label>
                    <div class="col-sm-4">
                      <div class="control">
                            <select class="form-control select2" id="paymentmethod" name="payment" tabindex="1" onb lur='chkEmpty("customerForm","branch","Please Enter Branch Name";'>
                              <option value="">
                                <!-- Select One -->
                                <?php echo $this->lang->line('lbl_dropdown_customer');?>
                              </option>
                            <?php 
                              foreach($pay as $row)
                              
                              {
                            ?>
                                <option value="<?php echo $row->id;?>" 
                                <?php if($row->id==$dep->payment_method_id)
                                  { echo "selected";}
                                ?>>
                                <?php echo $row->name;?></option>  
                            <?php
                              }
                            ?>
                            </select>
                            <a href="#paymentmethod" data-toggle="modal" data-target=""><span class="" style="">Add Payment Method</span></a>
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
                          <input type="text" class="form-control" name="bank_name" id="bank_name" value="<?php echo $dep->bank_name;?>" placeholder="Bank Name">
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
                          <input type="text" class="form-control" name="cheque_no" id="cheque_no" value="<?php echo $dep->cheque_no;?>" placeholder="Cheque No">
                          <span style="font-size:20px;"></span>
                          <p style="color:#990000;"></p>
                        </div> 
                    </div>
                  </div>  

                  <div class="form-group">
                    <label for="reference" class="col-sm-2 control-label">
                      <!-- Reference -->
                      <?php echo $this->lang->line('lbl_adddeposit_reference');?>
                    </label>
                    <div class="col-sm-4">
                      <div class="control">
                          <input type="text" class="form-control" id="reference" placeholder="<?php echo $this->lang->line('lbl_adddeposit_reference');?>" name="refer" value="<?php echo $dep->reference_no?>">
                          
                        </div> 
                    </div>
                  </div>

                  <!-- <div class="form-group">
                    <label for="file" class="col-sm-2 control-label">
                      
                      <?php echo $this->lang->line('lbl_adddeposit_file');?>
                    </label>
                    <div class="col-sm-4">
                      <div class="control">
                          <input type="file" class="form-control" id="file" placeholder="file" name="file">
                        </div> 
                    </div>
                  </div>   -->

                          
              <!-- /.box-body -->
              <div class="box-footer">
                <div style="margin-left: 120px;">
                <input type="submit" name="depositeSubmit" class="btn btn-info btn-flat" tabindex="22" value="<?php echo $this->lang->line('btn_submit');?>">

                <a href="<?php echo base_url();?>deposit/" class="btn btn-default btn-flat"><?php echo $this->lang->line('btn_cancel');?></a>             
                </div>
              </div>
              
          </form>
          </div>
      </div>
        </div>
      </div>
      <!-- /.row -->
      
    </section>
    <!-- /.content -->
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
                              <option value="income">Income</option>  
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
          var paymentmethod = $("#payment_method").val();
          if(paymentmethod=="")
          {
            $('#method_error').text("Enter Payment Method Name");
            return false;
          }
          $('#payment').html('<option value="">Select</option>');
          $.ajax({
            url:"<?php echo base_url('quotation/add_paymentmethod');?>",
            method:"POST",
            data:{payment_method:paymentmethod},
            dataType : "json",
            success:function(data1)
            {
                var id = data1['paymentmethod'];
                for(i=0;i<data1['method'].length;i++){
                    $('#payment').append('<option value="' + data1['method'][i].id + '">' + data1['method'][i].name + '</option>');
                }
                $('select[name^="payment"] option[value="'+id+'"]').attr("selected","selected");
                $("#payment_method").val("");
            }
          });
      });
      
       $("input[name='depositeSubmit']").click(function(e){
           
           var account=chkDrop("depositeForm","account","Please Enter Name");
           var d=chkEmpty("depositeForm","amount","Please Enter Amount");
           var g=chkDrop("depositeForm","category","Please Enter Category");
           var h=chkDrop("depositeForm","payment","Please Enter payment method");

           if((account+d+g+h) < 1)
           {
             depositeForm.submit();
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

  $('#amount').keyup(function() 
  {
        $('span.error-keyup-1').hide();
        var inputVal = $(this).val();
        var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
        if(!numericReg.test(inputVal)) 
        {
        $(this).after('<span class="error error-keyup-1 text-danger">Numeric characters only.</span>');
        }
    });
  
  $("#amount").keypress(function(e) {
     if (!/[0-9 \b]/i.test(String.fromCharCode(e.which))) {
         return false;
     }
   });
</script>
