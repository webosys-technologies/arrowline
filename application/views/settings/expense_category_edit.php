<?php 
  $this->load->view('layout/header');
?>

<div class="content-wrapper">
     <div id="notifications" class="row no-print">
          <div class="col-md-12">  
          </div>
      </div>

      <section class="content">
        <div class="row">
          
      
         <div class="col-md-12">
                  
              <div class="box box-default">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                     <div class="top-bar-title padding-bottom">
                        <!-- Update Income Expense Category -->
                          <?php echo $this->lang->line('lbl_edit_income_category');?> 
                      </div>
                     </div> 
                  </div>
                </div>
              </div>

             <div class="box">
                <div class="box-body">
                   <form name="Form" action="<?php echo base_url();?>generalsetting/edit" method="post" id="myform1"   class="form-horizontal">
                          <div class="form-group">
                            <label class="col-sm-2 control-label require" for="inputEmail3">
                                <!-- Category -->
                                <?php echo $this->lang->line('add_income_category');?> 
                              </label>
                                <div class="col-sm-4">
                                    <input type="hidden" placeholder="name" class="form-control" name="id" value="<?php echo $data->id;?>">
                                    <input type="text" placeholder="name" class="form-control" id="name" name="name" value="<?php echo $data->name;?>" tabindex="2" onblur='chkEmpty("Form","name","Please Enter Name");'>
                                    <span id="name" style="color: red"><?php echo form_error('name');?></span>
                                    <p style="color:#990000;"></p>
                                </div>
                          </div>
  

                          <div class="form-group">
                              <label class="col-sm-2 control-label require" for="inputEmail3">
                                <!-- Type -->
                                <?php echo $this->lang->line('add_income_category_type');?>    
                              </label>
                                    <div class="col-sm-4">
                                      <select class="form-control valdation_select" name="type" value="<?php echo set_value('units'); ?>">
                                        <option value=""><!-- Select One -->
                                          <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                        </option>
                                        <option value="expense" <?php if($data->type == "expense"){echo "selected";}?>>Expense</option>
                                        <option value="income" <?php if($data->type == "income"){echo "selected";}?>>income</option>
                                      </select>
                                      <span id="name" style="color: red"><?php echo form_error('type');?></span>
                                      <p style="color:#990000;"></p>
                                   </div>
                          </div>    

                            <div class="form-group">
                                <label for="btn_save" class="col-sm-3 control-label"></label>
                                     <div class="col-sm-6">
                                        
                                          <input type="submit" class="btn btn-info btn-flat" name="formSubmit" value="<?php echo $this->lang->line('btn_submit');?>">
                                          <a class="btn btn-default btn-flat" href="<?php echo base_url();?>generalsetting/">
                                            <!-- Close --><?php echo $this->lang->line('btn_cancel');?></a>
                                        
                                    </div>
                               </div>
                          </form>
                       </div>
                    </div>
                  </div>
                </div>

            </div>


<script type="text/javascript">
    $(document).ready(function(){
       $("input[name='formSubmit']").click(function(e){
           /*var a=chkEmpty("customerForm","branch","Please Enter Branch Name");*/
           var name=chkEmpty("Form","name","Please Enter Name");
           var type=chkDrop("Form","type","Please Select type");


           if((name+type) < 1){
             Form.submit();
             return true;
           }else{
             return false;
           }
           
         });      
   });
</script>

<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?>           

