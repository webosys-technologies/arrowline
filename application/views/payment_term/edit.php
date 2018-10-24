   <?php 
  $this->load->view('layout/header');
?>

<div class="content-wrapper">
  <section class="content">
      <div class="row">
         

           <div class="col-md-12">
                    
                <div class="box box-default">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-6">
                       <div class="top-bar-title padding-bottom">
                          <!-- Payment Terms -->
                           <?php echo $this->lang->line('lbl_pterms_header');?> 
                        </div>
                      </div> 
                      <div class="col-md-6 top-right-btn">
                          <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#add-payment" class="btn btn-block btn-default btn-flat btn-border-orange pull-right"><span class="fa fa-plus"> &nbsp;</span>
                             <?php echo $this->lang->line('lbl_pterms_add_header');?> 
                          </a> -->
                      </div>
                      
                    </div>
                  </div>
                </div>

                    <?php if($this->session->flashdata('success')) { ?>
                 <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Alert!</h4>
                     <?php echo $this->session->flashdata('success');?>
                </div>
               <?php } ?>
                
                <div class="box">
                   <div class="box-body">
                       <form name="Form" action="<?php echo base_url();?>paymentterms/edit" method="post" id="myform1"   class="form-horizontal">
                          <div class="form-group">
                            <label class="col-sm-2 control-label require" for="inputEmail3"><!-- Term -->
                              <?php echo $this->lang->line('lbl_pterms_terms');?> 
                            </label>
                              <div class="col-sm-4">
                                  <input type="hidden" placeholder="name" class="form-control" name="id" value="<?php echo $data->id;?>">
                                  <input type="text" placeholder="name" class="form-control" name="name" value="<?php echo $data->term;?>" tabindex="2" onblur='chkEmpty("Form","name","Please Enter Name");'>
                                  <span id="name" style="color: red"><?php echo form_error('name');?></span>
                                  <p style="color:#990000;"></p>
                              </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-2 control-label require" for="inputEmail3"><!-- Due Days -->
                              <?php echo $this->lang->line('lbl_pterms_dueday');?> 
                            </label>
                                <div class="col-sm-4">
                                  <input type="text" placeholder="name" class="form-control" name="due" value="<?php echo $data->due_days;?>" tabindex="2" onblur='chkEmpty("customerForm","due","Please Enter Due Days");'>
                                  <span id="name" style="color: red"><?php echo form_error('due');?></span>
                                  <p style="color:#990000;"></p>
                                </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-2 control-label require" for="inputEmail3"><!-- Default -->
                              <?php echo $this->lang->line('lbl_pterms_default');?> 
                            </label>
                               <div class="col-sm-4">
                                  <select class="form-control valdation_select" name="default" value="<?php echo $data->default;?>" tabindex="2" onblur='chkDrop("Form","default","Please Enter Name");'>
                                       
                                        <option value="Yes" <?php if($data->default == "Yes"){echo "selected";}?>>Yes</option>
                                        <option value="No" <?php if($data->default == "No"){echo "selected";}?>>No</option>  
                                  </select>
                            </div>
                          </div>

                          <div class="form-group">
                                 <label for="btn_save" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                          
                                             <input type="submit" class="btn btn-info btn-flat" name="formSubmit" value="<?php echo $this->lang->line('btn_submit');?> ">
                                             <a href="<?php echo base_url();?>paymentterms" class="btn btn-default btn-flat" data-dismiss="modal"><!-- Close -->
                                               <?php echo $this->lang->line('btn_modal_close');?> 
                                             </a>
                                          
                                    </div>
                              </div>    
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                   <!-- Modal Dialog -->
                    <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                       <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times; </button>
                                     <h4 class="modal-title">Delete Parmanently</h4>
                               </div>
                                <div class="modal-body">
                                     <p>Are you sure about this ?</p>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="confirm">Delete</button>
                           </div>
                       </div>
                    </div>
                 </div>
         <!-- /.content -->
         </div>


<script type="text/javascript">
    $(document).ready(function(){
       $("input[name='formSubmit']").click(function(e){
           var b=chkEmpty("Form","name","Please Enter Name");
           var c=chkDrop("Form","default","Select one ");
           if((b+c) < 1){
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

<script type="text/javascript">

    window.setTimeout(function() {
        $(".alert").fadeTo(400, 0).slideUp(400, function(){
            $(this).remove(); 
        });
    }, 4000);
</script>