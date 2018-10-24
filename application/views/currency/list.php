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
       
      <div class="col-md-12">
        <div class="box box-default">
          <div class="box-body">
            <div class="row">
              <div class="col-md-10">
                  <div class="top-bar-title padding-bottom">
                    <!-- Currency -->
                    <?php echo $this->lang->line('lbl_currency_header');?>
                  </div>
              </div> 
              <div class="col-md-2 top-right-btn">
                  <a href="javascript:void(0)" data-toggle="modal" data-target="#add-payment" class="btn btn-block btn-primary btn-flat btn-border-orange pull-right"><span class="fa fa-plus"> &nbsp;</span>
                      <!-- Add New -->
                    <?php echo $this->lang->line('lbl_currency_add_header');?>
                  </a>
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
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                       <th>
                        Currency Name
                        <!-- <?php echo $this->lang->line('lbl_currency_name');?>  -->
                       </th>
                       <th>
                          <!-- Symbol -->
                          <?php echo $this->lang->line('lbl_currency_symbol');?>
                        </th>
                       <th width="5%">
                            <!-- Action -->
                            <?php echo $this->lang->line('lbl_currency_action');?>
                        </th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($data as $row){ ?>
                      <tr> 
                  
                        <td><?php echo $row->name;?></td>
                        <td><?php echo $row->symbol;?></td>
                        <td>              
                          <a title="Edit" href="<?php echo base_url();?>currency/edit_data/<?php echo $row->id;?>" class="btn btn-xs btn-primary edit-unit" data-tt="tooltip"><span class="fa fa-edit"></span></a> &nbsp;

                          <a class="btn btn-xs btn-danger" href="#<?php echo $row->id;?>" title="Delete" onclick="" data-toggle="modal" data-target="" data-tt="tooltip">
                          <i class="fa fa-remove" aria-hidden="true"></i></a>   
                          <div class="example-modal">
                                <div class="modal fade" id="<?php echo $row->id;?>">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span></button>
                                          <center><h4 class="modal-title">
                                          <!-- !!  Delete Account !! -->
                                           <?php echo $this->lang->line('lbl_currency_delete_modal');?> 
                                          </h4></center>
                                      </div>
                                      <div class="modal-body">
                                        <p><h4><b><!-- Are you sure to delete this Record !! -->
                                        <?php echo $this->lang->line('delete_modal');?>&hellip;</b></h4></p>
                                      </div>
                                      <div class="modal-footer">
                                        <input type="hidden" name="branch_id1" value="<?php echo $row->id;?>">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                        <!-- Close -->
                                        <?php echo $this->lang->line('btn_modal_close');?>  
                                        </button>
                                      
                                        <a title="message.form.edit" href="<?php echo base_url();?>currency/delete/<?php echo $row->id;?>" 
                                                     class="btn btn-danger">

                                        <!-- Delete -->
                                        <?php echo $this->lang->line('btn_modal_delete');?>               
                                        </a> &nbsp;
                                      </div>
                                    </div>
                                  </div>
                                </div>
                          </div>
                        </td>
                      </tr>   
                        <?php }
                        ?>     
                  </tbody>
              </table>
          </div>
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
              <?php echo $this->lang->line('lbl_currency_add_header');?>
          </h4>
        </div>

        <div class="modal-body">
          <form name="Form" action="<?php echo base_url();?>currency/add" method="post" id="myform1"   class="form-horizontal">
            <div class="form-group">
               <label class="col-sm-3 control-label require" for="inputEmail3">
                Currency Name
                <!-- <?php echo $this->lang->line('lbl_currency_name');?> -->
               </label>
                  <div class="col-sm-6">
                     <input type="text" placeholder="name" class="form-control" name="name" id="name" tabindex="2" onblur='chkEmpty("customerForm","name","Please Enter Name");'>
                     <span id="name" style="color: red"><?php echo form_error('name');?></span>
                     <p style="color:#990000;"></p>
                  </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label require" for="inputEmail3">
                <!-- Symbol -->
                <?php echo $this->lang->line('lbl_currency_symbol');?>
              </label>
              <div class="col-sm-6">
                     <input type="text" placeholder="name" class="form-control" id="symbol" name="symbol" tabindex="2" onblur='chkEmpty("customerForm","symbol","Please Enter Name");'>
                     <span id="name" style="color: red"><?php echo form_error('symbol');?></span>
                    <p style="color:#990000;"></p>                               
              </div>
            </div>
            <div class="form-group">
              <label for="btn_save" class="col-sm-3 control-label"></label>
                  <div class="col-sm-6">
                    <center>
                      <input type="submit" class="btn btn-info btn-flat" name="formSubmit" value="<?php echo $this->lang->line('btn_submit');?>">
                      <a class="btn btn-default btn-flat" data-dismiss="modal"><!-- Close -->
                        <?php echo $this->lang->line('btn_modal_close');?>
                      </a>
                       
                    </center>
                  </div>
            </div>
          </form>
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
           }else
           {
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

<!-- <script type="text/javascript">
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
      this.value = this.value.replace(/([^@])+?@[^$#<>?]+?\.[\w]{2,4}/, function(str) { 
       ('You typed " ' + str + ' ".\n\nPlease use only currency symbol.'); return ''; });
    });  
   });
</script>
 -->