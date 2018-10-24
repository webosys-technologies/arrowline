<?php 
	$this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');
  
  if(empty($user_session))
  {
    redirect('auth','refresh');
  }
  if(!in_array("manage_currency",$user_session)){
      redirect('auth','refresh');
  }
?>

<div class="content-wrapper">
  <section class="content">
      <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
             <div class="box-header with-border">
                    <h3 class="box-title">Manage Finance Settings</h3>
             </div>

               <div class="box-body no-padding" style="display: block;">
                <ul class="nav nav-pills nav-stacked">
                    <?php if(isset($user_session)){
                     if(in_array("manage_tax",$user_session)){
                    ?>
                      <li><a href="<?php echo base_url();?>settings/finance">Taxes</a></li>
                    <?php }}?>

                    <?php if(isset($user_session)){
                       if(in_array("manage_currency",$user_session)){
                    ?>
                      <li class="active"><a href="<?php echo base_url();?>currency/currency_list">Currencies</a></li>
                    <?php }} ?>

                    <?php if(isset($user_session)){
                       if(in_array("manage_payment_term",$user_session)){
                    ?>
                      <li ><a href="<?php echo base_url();?>payment_terms/display">Payment Terms</a></li>
                    <?php }} ?>

                    <?php if(isset($user_session)){
                       if(in_array("manage_payment_method",$user_session)){
                    ?>
                      <li ><a href="<?php echo base_url();?>payment_method/payment_list">Payment Methods</a></li>
                    <?php }} ?>

                    <?php if(isset($user_session)){
                       if(in_array("manage_payment_gateway",$user_session)){
                    ?>
                      <li><a href="<?php echo base_url();?>settings/pgetway">Payment Gateway</a></li>
                    <?php }} ?>
               </ul>
              </div>
            </div>       
        </div>

    <div class="col-md-9">
       <div class="box box-default">
           <div class="box-body">
             <div class="row">
                <div class="col-md-6">
                   <div class="top-bar-title padding-bottom">Currency</div>
              </div> 

               <div class="col-md-3 pull-right">
                  <a href="javascript:void(0)" data-toggle="modal" data-target="#add-payment" class="btn btn-block btn-default btn-flat btn-border-orange"><span class="fa fa-plus"> &nbsp;</span>Add New</a>
              </div>
            </div>
          </div>
        </div>

       <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>FirstName</th>
                      <th>Symbol</th>
                      <th width="5%">Action</th>
                   </tr>
                  </thead>
                  <tbody>
                    <tr> 
                     <?php foreach ($data as $row){ ?>
                      <td><?php echo $row->name;?></td>
                      <td><?php echo $row->symbol;?></td>
                      <td>              
                        <a title="message.form.edit" href="<?php echo base_url();?>Currency/edit_content/<?php echo $row->id;?>" class="btn btn-xs btn-primary edit-unit"><span class="fa fa-edit"></span></a> &nbsp;

                        <a class="btn btn-xs btn-danger" href="#<?php echo $row->id;?>" title="Delete" onclick="" data-toggle="modal" data-target="">
                        <i class="fa fa-remove" aria-hidden="true"></i></a>   


                        <div class="example-modal">
                              <div class="modal fade" id="<?php echo $row->id;?>">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                      <center><h4 class="modal-title">!!  Delete Account !!</h4></center>
                                    </div>
                                    <div class="modal-body">
                                      <p><h4><b>Are you sure to delete this Record !!&hellip;</b></h4></p>
                                    </div>
                                    <div class="modal-footer">
                                      
                                        <input type="hidden" name="branch_id1" value="<?php echo $row->id;?>">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      
                                        <a title="message.form.edit" href="<?php echo base_url();?>Currency/delete/<?php echo $row->id;?>" 
                                         class="btn btn-danger">Delete</a> &nbsp;
                                      
                                    </div>
                                  </div>
                                
                                </div>
                                
                              </div>
                        </div>
                        
                      </td>
                     
                   
                    </tr>  
                    <?php }?>     
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
          <h4 class="modal-title">Add New</h4>
      </div>

    <div class="modal-body">
        <form name="Form" action="<?php echo base_url();?>Currency/add" method="post" id="myform1"   class="form-horizontal">
                 <div class="form-group">
                      <label class="col-sm-3 control-label require" for="inputEmail3">FirstName</label>
                         <div class="col-sm-6">
                             <input type="text" placeholder="name" class="form-control" name="name" tabindex="2" onblur='chkEmpty("customerForm","name","Please Enter Name");'>
                             <span id="name" style="color: red"><?php echo form_error('name');?></span>
                            <p style="color:#990000;"></p>
                     </div>
               </div>

       <div class="form-group">
          <label class="col-sm-3 control-label require" for="inputEmail3">Symbol</label>
               <div class="col-sm-6">
                       <input type="text" placeholder="name" class="form-control" name="symbol" tabindex="2" onblur='chkEmpty("customerForm","symbol","Please Enter Name");'>
                       <span id="name" style="color: red"><?php echo form_error('symbol');?></span>
                      <p style="color:#990000;"></p>                               
                </div>
          </div>

          
        <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
                  <div class="col-sm-6">
                         <button type="button" class="btn btn-info btn-flat" data-dismiss="modal">Close</button>
                         <input type="submit" class="btn btn-primary btn-flat pull-right" name="formSubmit" value="Submit">
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



<script type="text/javascript">
    $(document).ready(function(){
       $("input[name='formSubmit']").click(function(e){
           var b=chkEmpty("Form","name","Please Enter Name");
          var c=chkEmpty("Form","symbol","Select one ");
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

