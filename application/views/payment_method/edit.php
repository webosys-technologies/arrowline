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
            <div class="col-md-6">
             <div class="top-bar-title padding-bottom">
              <!-- Payment Methods -->
              <?php echo $this->lang->line('lbl_pmethod_header');?>
              </div>
            </div> 
          </div>
        </div>
      </div>

 <div class="box">
    <div class="box-body">
           <form name="Form" action="<?php echo base_url();?>paymentmethod/edit" method="post" id="myform1" class="form-horizontal">
               
             <div class="form-group">
                    <label class="col-sm-2 control-label require" for="inputEmail3">
                      <!-- Name -->
                      <?php echo $this->lang->line('lbl_pmethod_name');?>
                    </label>
                              <div class="col-sm-4">
                                     <input type="hidden" placeholder="name" class="form-control" name="id" value="<?php echo $data->id;?>">
                                    <input type="text" placeholder="<?php echo $this->lang->line('lbl_pmethod_name');?>" class="form-control" id="name" name="name" value="<?php echo $data->name;?>" tabindex="2" onblur='chkEmpty("Form","name","Please Enter Name");'>
                                   <span id="name" style="color: red"><?php echo form_error('name');?> </span>
                                  <p style="color:#990000;"></p>
                             </div>
                       </div>

                       <div class="form-group">
                         <label class="col-sm-2 control-label require" for="inputEmail3"><!-- Default -->
                          <?php echo $this->lang->line('lbl_pmethod_default');?>
                         </label>
                           <div class="col-sm-4">
                              <select class="form-control valdation_select" name="default" value="<?php echo $data->default;?>" tabindex="2" onblur='chkEmpty("Form","default","Please select");'>
                                   <option value="Yes" <?php if($data->default == "Yes"){echo "selected";}?>>Yes</option>
                                   <option value="No" <?php if($data->default == "No"){echo "selected";}?>>No</option>  
                             </select>
                                <span id="name" style="color: red"><?php echo form_error('default');?></span>
                                <p style="color:#990000;"></p>
                          </div>
                    </div>
                    <div class="form-group">
                      <label for="btn_save" class="col-sm-12 control-label"></label>
                          <div class="col-sm-6 text-center">
                             <input type="submit" class="btn btn-info btn-flat" name="formSubmit" value="<?php echo $this->lang->line('btn_submit');?>">
                              <a href="<?php echo base_url();?>paymentmethod/" class="btn btn-default btn-flat" data-dismiss="modal"><?php echo $this->lang->line('btn_cancel');?></a>
                              
                          </div>
                       </div>
                  </form>
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
          //var c=chkDrop("Form","default","Select one ");

           if((b) < 1){
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
    $(document).ready(function(){
      
    jQuery('#name').keyup(function (){
      this.value = this.value.replace(/[^a-zA-Z ]/g, function(str) { 
       ('You typed " ' + str + ' ".\n\nPlease use only alphabetic.'); return ''; });
        if($(this).val().length > 100)
        {
           $(this).val($(this).val().substring(0, 100));
        }
    });

   });
</script>
