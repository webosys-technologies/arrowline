<?php 
	$this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_payment_method",$user_session)){
      redirect('auth','refresh');
  }
?>

<div class="content-wrapper">
  <section class="content">
      <div class="row">
   
 <div class="col-md-12">         
      <div class="box box-default">
          <div class="box-body">
             <div class="row">
                 <div class="col-md-9">
                      <div class="top-bar-title padding-bottom">
                        Payment Methods
                      </div>
                </div> 
            <div class="col-md-3 top-right-btn">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#add-payment" class="btn btn-block btn-primary btn-flat btn-border-orange pull-right"><span class="fa fa-plus"> &nbsp;</span><?php echo $this->lang->line('btn_pmethod_addnew');?>
                    </a>
             </div>
            
          </div>
        </div>
      </div>

       <?php if($this->session->flashdata('success')) { ?>
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i>
                <?php echo $this->lang->line('alert');?>
            </h4>
            <?php echo $this->session->flashdata('success');?>
          </div>
             <?php } ?>
                

   <div class="box">
       <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
               <thead>
                    <tr>
                        <th>
                          <!-- Name -->
                          <?php echo $this->lang->line('lbl_pmethod_name');?>
                        </th>
                        <th>
                          <!-- Default -->
                          <?php echo $this->lang->line('lbl_pmethod_default');?>
                        </th>
                        <th width="5%">
                          <!-- Action -->
                          <?php echo $this->lang->line('lbl_pmethod_action');?>
                        </th>
                   </tr>
              </thead>
              <tbody>
                     <?php
                          foreach ($data as $row){
                      ?>
                      <tr> 
                         <td><?php echo $row->name;?></td>
                         <td><?php echo $row->default;?></td>
                         <td>   
                        <?php if(isset($user_session)){
                           if(in_array("delete_payment_method",$user_session)){
                        ?>       
                         <a title="Edit" href="<?php echo base_url();?>paymentmethod/edit_data/<?php echo $row->id;?>" class="btn btn-xs btn-primary edit-unit" data-tt="tooltip"><span class="fa fa-edit"></span></a> 
                         <?php }}?>
                         &nbsp;
                         <?php if(isset($user_session)){
                           if(in_array("delete_payment_method",$user_session)){
                        ?>
                        <a href="#<?php echo''.$row->id.'';?>" data-toggle="modal" data-target="" class="btn btn-xs btn-danger" data-tt="tooltip" title="Delete"><span class="fa fa-remove"></span></a>
                         <?php }} ?>

                          <div class="example-modal">
                           <div class="modal fade" id="<?php echo''.$row->id.'';?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <center><h4 class="modal-title">
                                      <!-- !!  Delete Account !! -->
                                      <?php echo $this->lang->line('lbl_pmethod_delete_modal');?>
                                    </h4></center>
                                  </div>
                                  <div class="modal-body">
                                    <p><h4><b>
                                      <!-- Are you sure to delete this Record !!&hellip; 
                                      -->
                                      <?php echo $this->lang->line('delete_modal');?>
                                      </b></h4></p>
                                  </div>
                                  <div class="modal-footer">
                                    
                                      <input type="hidden" name="branch_id1" value="<?php echo $row->id;?>">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">
                                        <?php echo $this->lang->line('btn_modal_close');?>
                                      </button>
                                    
                                      <a title="message.form.edit" href="<?php echo base_url();?>paymentmethod/delete/<?php echo $row->id;?>"  class="btn btn-danger">
                                        <?php echo $this->lang->line('btn_modal_delete');?>
                                      </a> &nbsp;
                                    
                                  </div>
                                </div>
                              
                              </div>
                              
                            </div>
                        </div>
                        
                       </td>
                     
                        </td> 
                  </tr>  
                      <?php }
                      ?>     
                 
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </section>
</div>

<div id="add-payment" class="modal fade" role="dialog" style="display: none;">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title">
                            <!-- Add New -->
                            <?php echo $this->lang->line('lbl_pmethod_add_header');?>
                            </h4>
                      </div>

     <div class="modal-body">
          <form name="Form" action="<?php echo base_url();?>Paymentmethod/add" method="post" id="myform1"   class="form-horizontal">
              <div class="form-group">
                    <label class="col-sm-3 control-label require" for="inputEmail3">
                      <!-- Name -->
                      <?php echo $this->lang->line('lbl_pmethod_name');?>
                    </label>
                         <div class="col-sm-6">
                              <input type="text" placeholder="<?php echo $this->lang->line('lbl_pmethod_name');?>" class="form-control" id="name" name="name" tabindex="2" onblur='chkEmpty("Form","name","Please Enter Name");'>
                             <span id="name" style="color: red"><?php echo form_error('name');?></span>
                            <p style="color:#990000;"></p>
                     </div>
               </div>

          <div class="form-group">
                <label class="col-sm-3 control-label require" for="inputEmail3">
                 <!--  Default -->
                 <?php echo $this->lang->line('lbl_pmethod_default');?>
                </label>
                <div class="col-sm-6">
                    <select class="form-control valdation_select" name="default" value="<?php echo set_value('default'); ?>" tabindex="2" onblur='chkDrop("Form","default","Please Select");'>
                        <option value="">
                         <!--  Select -->
                         <?php echo $this->lang->line('lbl_dropdown_customer');?>
                        </option>
                        <option value="Yes">
                          <!-- Yes -->
                          <?php echo $this->lang->line('yes');?>
                        </option>
                        <option value="No">
                          <!-- No -->
                          <?php echo $this->lang->line('no');?>
                        </option>               
                    </select>
                        <span  style="color: red"><?php echo form_error('default');?></span>
                        <span style="font-size:20px;"></span>
                        <p style="color:#990000;"></p>
                </div>
          </div>

          
        <div class="form-group">
              <label for="btn_save" class="col-sm-3 control-label"></label>
                 <div class="col-sm-6">
                  <center>
                      <input type="submit" class="btn btn-info btn-flat" name="formSubmit" value="<?php echo $this->lang->line('btn_submit');?>">
                      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><?php echo $this->lang->line('btn_cancel');?></button>
                  </center>
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
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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