 <?php 
  $this->load->view('layout/header');
?>
 <div class="content-wrapper">
      <div id="notifications" class="row no-print">
      <div class="col-md-12">              
    </div>
    </div>
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Manage Company Settings</h3>
  </div>
  <div class="box-body no-padding" style="display: block;">
    <ul class="nav nav-pills nav-stacked">
            <li ><a href="<?php echo base_url();?>settings/">Company Settings</a></li>
            
      <li class=active><a href="<?php echo base_url();?>settings/member_list">Team Members</a></li>
      
              <li ><a href="<?php echo base_url();?>settings/user_list">User Roles</a></li>
            <li ><a href="<?php echo base_url();?>location/">Locations</a></li>
      
    </ul>
  </div>
  <!-- /.box-body -->
</div>        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-info">
             <div class="box-header with-border">
              <h3 class="box-title">Create User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <form action="<?php echo base_url();?>settings/add_member" method="post" id="myform1" class="form-horizontal" name="memberForm">
            
              <div class="box-body">
                
                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="inputEmail3">Full Name</label>

                  <div class="col-sm-9">
                    <input type="text" placeholder="Full Name" class="form-control valdation_check" id="fname" name="real_name">
                    <span id="val_fname" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="inputEmail3">Email</label>

                  <div class="col-sm-9">
                    <input type="text" placeholder="Email" class="form-control valdation_check" id="email" name="email">
                    <span id="val_email" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="inputEmail3">Password</label>

                  <div class="col-sm-9">
                    <input type="password" placeholder="Password" class="form-control valdation_check" id="ps" name="password">
                    <span id="val_ps" style="color: red"></span>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="inputEmail3">Phone</label>

                  <div class="col-sm-9">
                    <input type="text" placeholder="Phone" class="form-control valdation_check" id="name" name="phone">
                    <span id="val_name" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="inputEmail3">User Role </label>

                  <div class="col-sm-9">
                    <select class="form-control valdation_select select2" name="role" id="ss">
                    <option value="">Select One</option>
                                          <option value="1" >System Administrator</option>
                                        </select>
                    <span id="val_ss" style="color: red"></span>
                  </div>
                </div>
            
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url();?>settings/member_list" class="btn btn-info btn-flat">Cancel</a>
                <input class="btn btn-primary btn-flat pull-right" type="submit" name="btnSubmit" value="Submit">
              </div>
              <!-- /.box-footer -->
            </form>

                
              </div>
              <!-- /.box-body -->
              
          
          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</section>
        <!-- /.content -->
  </div>

  <script type="text/javascript">
    $(document).ready(function(){
      alert('hello');
       $("input[name='btnSubmit']").click(function(e){
           /*var a=chkEmpty("customerForm","branch","Please Enter Branch Name");*/
           var b=chkEmpty("memberForm","real_name","Please Enter Company name");
           
           
           var e=chkEmpty("memberForm","email","Please Enter Email");

           var f=chkEmpty("memberForm","phone","Please Enter Phone");

           var g=chkEmpty("memberForm","password","Please Enter Email");

           

           var h=chkDrop("memberForm","role","Please select country");

           

           if((b+e+f+g+h+) < 1){
             memberForm.submit();
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