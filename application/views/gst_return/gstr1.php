<?php
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
      redirect('auth','refresh');
  }

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> <!-- Dashboard --><?php echo $this->lang->line('header_dashboard'); ?></a></li>
          <li class="active">GSTR1</li>
        </ol>
      </h5> 
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <!-- right column -->
      <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><!-- List Category -->
                  GSTR1
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form method="post" action="<?php echo base_url('gst_return/gstr1') ?>">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="month">Select Month</label>
                    <select id="month" name="month" class="form-control select2">
                      <?php
                        for($i=1;$i<=12;$i++){
                      ?>
                        <option><?php echo sprintf('%02d',intval($i)) ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="year">Select Year</label>
                    <select id="year" name="year" class="form-control select2">
                      <?php
                        for($i=2017;$i<=date('Y');$i++){
                      ?>
                        <option><?php echo sprintf('%04d',intval($i)) ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <br><br>
                  <div class="">
                    <input type="submit" name="submit" value="b2b" id="gstr1b2b" class="btn btn-info btn-flat">
                    <input type="submit" name="submit" value="b2cs" id="gstr1b2cs" class="btn bg-orange btn-flat">
                    <input type="submit" name="submit" value="b2cl" id="gstr1b2cl" class="btn btn-success btn-flat">
                    <input type="submit" name="submit" value="cdnr" id="gstr1cdnr" class="btn bg-purple btn-flat">
                    <input type="submit" name="submit" value="cdnur" id="gstr1cdnur" class="btn bg-maroon btn-flat">
                    <input type="submit" name="submit" value="exp" id="gstr1exp" class="btn bg-olive btn-flat">
                    <input type="submit" name="submit" value="exemp" id="gstr1exemp" class="btn btn-warning btn-flat">
                    <input type="submit" name="submit" value="hsn" id="gstr1hsn" class="btn btn-danger btn-flat">
                  </div>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
  $this->load->view('layout/footer');
?>
