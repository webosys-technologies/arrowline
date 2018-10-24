 <?php 
  $this->load->view('layout/header');
?>
<div class="content-wrapper">
 <!-- Main content -->
    <section class="content">
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
             <div class="top-bar-title padding-bottom">Income VS Expense</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Default box -->
      <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12">
                <form class="form-horizontal">
                <div class="form-group">
                  <label class="col-sm-5 control-label" for="inputEmail3">Year</label>
                  <div class="col-sm-2">
                     <select class="form-control select2" name="year" id="year">
                          <?php foreach ($year as $yr) {?>
                              <option value="<?php echo $yr;?>" <?php if($yr == date('Y')){echo "selected";}?>><?php echo $yr;?></option>
                          <?php } ?>
                      </select>
                  </div>
                </div>
                </form>
                </div>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                <table id="expenseList" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">Month</th>
                    <th class="text-center">Income($)</th>
                    <th class="text-center">Expense($)</th>
                    <th class="text-center">Profit($)</th>
              
                  </tr>
                  </thead>
                  <tbody>
                 <tr>
                    <td class="text-center">January</td>
                    <td class="text-center">5000</td>
                    <td class="text-center">0</td>
                    <td class="text-center">5000</td>
                  </tr>
                                                      <tr>
                    <td class="text-center">February</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                  </tr>
                                                      <tr>
                    <td class="text-center">March</td>
                    <td class="text-center">85000</td>
                    <td class="text-center">40000</td>
                    <td class="text-center">45000</td>
                  </tr>
                                                      <tr>
                    <td class="text-center">Appril</td>
                    <td class="text-center">126615</td>
                    <td class="text-center">43000</td>
                    <td class="text-center">83615</td>
                  </tr>
                                                      <tr>
                    <td class="text-center">May</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                  </tr>
                                                      <tr>
                    <td class="text-center">June</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                  </tr>
                                                      <tr>
                    <td class="text-center">July</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                  </tr>
                                                      <tr>
                    <td class="text-center">August</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                  </tr>
                                                      <tr>
                    <td class="text-center">September</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                  </tr>
                                                      <tr>
                    <td class="text-center">October</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                  </tr>
                                                      <tr>
                    <td class="text-center">November</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                  </tr>
                                                      <tr>
                    <td class="text-center">December</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                    <td class="text-center">0</td>
                  </tr>
                                  
                  <tr>
                    <th class="text-right">Total</th>
                    <th class="text-center">$216615</th>
                    <th class="text-center">$83000</th>
                    <th class="text-center">$133615</th>
                  </tr>

                 </tbody>

                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 

  $this->load->view('layout/footer');
?> 
  