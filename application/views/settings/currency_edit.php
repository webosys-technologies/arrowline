<?php 
  $this->load->view('layout/header');
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
         <li class="active"><a href="<?php echo base_url();?>setting/">Taxes</a></li>
         <li><a href="<?php echo base_url();?>Currency/display">Currency</a></li>
         <li><a href="<?php echo base_url();?>Payment_terms/display">Payment Terms</a></li>
         <li><a href="<?php echo base_url();?>Payment_method/display">Payment Methods</a></li>
         <li><a href="#payment/gateway">Payment Gateway</a></li>
    </ul>
  </div>
</div>       
</div>

 <div class="col-md-9">
    <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
             <div class="top-bar-title padding-bottom">Payment Methods</div>
            </div> 
          </div>
        </div>
      </div>

  <div class="box">
      <div class="box-body">
           <form name="Form" action="<?php echo base_url();?>Currency/edit" method="post" id="myform1" class="form-horizontal">
               
              <div class="form-group">
                   <label class="col-sm-3 control-label require" for="inputEmail3">Name</label>
                        <div class="col-sm-6">
                               <input type="hidden" placeholder="name" class="form-control" name="id" value="<?php echo $data->id;?>">
                               <input type="text" placeholder="name" class="form-control" name="name" value="<?php echo $data->name;?>" tabindex="2" onblur='chkEmpty("customerForm","name","Please Enter Name");'>
                                <span id="name" style="color: red"><?php echo form_error('name');?></span>
                               <p style="color:#990000;"></p>
                         </div>
                   </div>

         <div class="form-group">
               <label class="col-sm-3 control-label require" for="inputEmail3">Default</label>
                    <div class="col-sm-6">
                          <input type="text" placeholder="name" class="form-control" name="symbol" value="<?php echo $data->symbol;?>" tabindex="2" onblur='chkEmpty("customerForm","name","Please Enter Name");'>
                             <span id="name" style="color: red"><?php echo form_error('symbol');?></span>
                            <p style="color:#990000;"></p>
                       </div>
                </div>


       <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
                <div class="col-sm-6 text-center">
                    <button type="button" class="btn btn-info btn-flat" data-dismiss="modal"> Close</button>
                    <input type="submit" class="btn btn-primary btn-flat" name="formSubmit" value="Update">
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

