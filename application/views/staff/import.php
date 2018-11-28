<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
      redirect('auth','refresh');
  }

?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
               <div class="box-header with-border">
                    <a href="<?php echo base_url();?>supplier/download_sample_csv"><button class="btn btn-default btn-flat btn-border-info"><span class="fa fa-download"> &nbsp;</span><!-- Download Sample -->
                    <?php echo $this->lang->line('lbl_sample_csv');?>

                    </button></a>
               </div>
            
                  <div class="box-body">
                     <div class="tab-content">
                         <p>
                            <!-- Your CSV data should be in the format below. The first line of your CSV file should be the column headers as in the table example. Also make sure that your file is UTF-8 to avoid unnecessary encoding problems. -->
                            <?php echo $this->lang->line('supplier_heading');?>
                          </p>
                              <small class="text-red">
                                <!-- Duplicate email rows wont be imported -->
                                <?php echo $this->lang->line('email_warning');?>
                              </small><br><br>
                                <div class="table-responsive">
                                  <table class="table table-bordered">
                                    <thead>
                                     <tr>
                                        <th>
                                          <!-- Supplier -->
                                          <?php echo $this->lang->line('supplier_heading');?>
                                        </th>
                                        <th>
                                          <!-- Email -->
                                          <?php echo $this->lang->line('lbl_email');?>
                                        </th>
                                        <th>
                                          <!-- Phone -->
                                          <?php echo $this->lang->line('lbl_phone');?>
                                        </th>
                                        <th>
                                          <!-- Street -->
                                          <?php echo $this->lang->line('lbl_street');?>
                                        </th>
                                        <th>
                                          <!-- Zipcode -->
                                          <?php echo $this->lang->line('lbl_zipcode');?>
                                        </th>
                                        <th>
                                          <!-- Billing Zipcode -->
                                          <?php echo $this->lang->line('lbl_gstin');?>
                                        </th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td><?php echo $supplier->name;?></td>
                                        <td><?php echo $supplier->email;?></td>
                                        <td><?php echo $supplier->phone;?></td>
                                        <td><?php echo $supplier->street;?></td>
                                        <td><?php echo $supplier->zipcode;?></td>
                                        <td><?php echo $supplier->gstin;?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div><br><br>
                              <!-- /.box-header -->
                              <!-- form start -->
                              <form action="<?php echo base_url();?>supplier/update_csv" method="post" id="myform1" class="form-horizontal" name="importForm" enctype="multipart/form-data">
                                  
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="country">
                                    <!-- Country -->
                                    <?php echo $this->lang->line('lbl_country');?>
                                    <label style="color:red;">*</label></label>
                                      <div class="col-sm-5">
                                        <select class="form-control select2" id="country" tabindex="1" name="country" tabindex="" onblur='chkDrop("customerForm","country","Please Enter Country");'>
                                             <option value="">
                                                <?php echo $this->lang->line('lbl_dropdown_customer');?>  
                                            </option>
                                              <?php foreach ($country as $value) {?>
                                             <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option> <?php } ?>
                                        </select>
                                        <span style="font-size:20px;"></span>
                                        <p style="color:#990000;"></p>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                   <label class="col-sm-2 control-label" for="inputEmail3"><!-- State -->
                                   <?php echo $this->lang->line('lbl_state');?>  
                                   <label style="color:red;">*</label></label>
                                    <div class="col-sm-5">
                                      <select class="form-control select2" id="state" tabindex="2" name="state" tabindex="" onblur='chkDrop("customerForm","state","Please Enter Name");'>
                                     <option value="">
                                     <!-- Select One -->
                                     <?php echo $this->lang->line('lbl_dropdown_customer');?> 
                                     </option>
                                      </select>
                                      <span style="font-size:20px;"></span>
                                      <p style="color:#990000;"></p>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-2 control-label require" for="inputEmail3">
                                      <!-- City -->
                                      <?php echo $this->lang->line('lbl_city');?>  
                                      <label style="color:red;">*</label></label>
                                        <div class="col-sm-5">
                                          <select class="form-control select2" id="city" tabindex="3" name="city" tabindex="" onblur='chkDrop("customerForm","city","Please Enter city");'>
                                            <option value=""><?php echo $this->lang->line('lbl_dropdown_customer');?></option>
                                          </select>
                                            <span style="font-size:20px;"></span>
                                            <p style="color:#990000;"></p>
                                        </div>
                                    </div>


                                  <div class="form-group">
                                    <label class="col-sm-2 control-label require" for="inputEmail3"><!-- Choose CSV File -->
                                    <?php echo $this->lang->line('lbl_choose_csv');?>
                                    </label>

                                    <div class="col-sm-5">
                                      <input class="form-control valdation_check input-file-field" id="file" name="file" type="file">
                                      <span id="val_name" style="color: red"></span>
                                    </div>
                                  </div><br><br>
                              
                                <!-- /.box-body -->
                                <div class="box-footer">
                                  <center>
                                    <input type="submit" class="btn btn-info btn-flat" id="btn" name="importSubmit" value="<?php echo $this->lang->line('btn_submit');?>">              
                                    <a href="<?php echo base_url();?>supplier/" class="btn btn-default btn-flat"><?php echo $this->lang->line('btn_cancel');?></a>
                                  </center>
                                </div>
                                <!-- /.box-footer -->
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?>

<script type="text/javascript">
  
  $(document).ready(function(){

      $("input[name='importSubmit']").click(function(e)
      {

        var city=chkDrop("importForm","city","Please Enter city");
        var state=chkDrop("importForm","state","Please Enter state");
        var country=chkDrop("importForm","country","Select Country");

        if(city+state+country < 1)
        {
          importForm.submit();
          return true;
        }
        else
        {
          return false;
        }
      }); 

      $('#country').change(function(){
          var id = $(this).val();
        //alert(id);
          $('#state').html('<option value="">Select</option>');
          $('#city').html('<option value="">Select</option>');
          $.ajax({
              url: "<?php echo base_url('supplier/getState') ?>/"+id,
              type: "GET",
              dataType: "JSON",
              success: function(data){
                for(i=0;i<data.length;i++){
                  $('#state').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                }
              }
            });
      });

      $('#state').change(function(){
        var id = $(this).val();
       // alert(id);
        $('#city').html('<option value="">Select</option>');
        $.ajax({
            url: "<?php echo base_url('supplier/getCity') ?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
              for(i=0;i<data.length;i++){
                $('#city').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
              }
            }
          });
      });

  });


</script>