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
                        <div class="col-md-12">
                         <div class="top-bar-title padding-bottom">
                            <!-- Currency Edit -->
                            <?php echo $this->lang->line('lbl_edit_currency_header');?>
                          </div>
                        </div> 
                      </div>
                    </div>
                  </div>

                  <div class="box">
                     <div class="box-body">
                        <form name="Form" action="<?php echo base_url();?>currency/edit" method="post" id="myform1" class="form-horizontal">  
                            <div class="form-group">
                              <label class="col-sm-2 control-label require" for="inputEmail3">
                                <!-- Name -->
                                <?php echo $this->lang->line('lbl_currency_name');?>
                              </label>
                                <div class="col-sm-4">
                                   <input type="hidden" placeholder="name" class="form-control" name="id" value="<?php echo $data->id;?>">
                                   <input type="text" placeholder="name" class="form-control" name="name" id="name" value="<?php echo $data->name;?>" tabindex="2" onblur='chkEmpty("customerForm","name","Please Enter Name");'>
                                   <span id="name" style="color: red"><?php echo form_error('name');?></span>
                                   <p style="color:#990000;"></p>
                                </div>
                            </div>

                           <div class="form-group">
                              <label class="col-sm-2 control-label require" for="inputEmail3">
                                <!-- Default -->
                                <?php echo $this->lang->line('lbl_currency_symbol');?>
                              </label>
                                <div class="col-sm-4">
                                   <input type="text" placeholder="name" class="form-control" name="symbol" value="<?php echo $data->symbol;?>" tabindex="2" onblur='chkEmpty("customerForm","name","Please Enter Name");'>
                                   <span id="name" style="color: red"><?php echo form_error('symbol');?></span>
                                   <p style="color:#990000;"></p>
                                </div>
                            </div>

                            <div class="form-group">
                               <label for="btn_save" class="col-sm-3 control-label"></label>
                                  <div class="col-sm-6">
                                      
                                        <input type="submit" class="btn btn-info btn-flat" name="formSubmit" value="<?php echo $this->lang->line('btn_submit');?>">
                                        <a href="<?php echo base_url();?>currency/" class="btn btn-default btn-flat" data-dismiss="modal"><!-- Close -->
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

    jQuery('#symbol').keyup(function (){
      this.value = this.value.replace(/([^@])+?@[^$#<>?]+?\.[\w]{2,4}/g, function(str) { 
       ('You typed " ' + str + ' ".\n\nPlease use only currency symbol.'); return ''; });
    });  
   });
</script>
