<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');
  if(empty($user_session))
  {
      redirect('auth','refresh');
  }
  if(!in_array("add_item",$user_session)){
      redirect('item','refresh');
  }

?>
<!-- <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script> -->

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <div id="notifications" class="row no-print">
         <div class="col-md-12">
                
        </div>
      </div>
    <!-- Content Header (Page header) -->
       
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
        <div class="box">
          <div class="box-body">
            <strong>
             <!-- Item Information -->
             <?php echo $this->lang->line('add_item_header');?>
            </strong>
          </div>
        </div>
      <div class="box">
          <!-- <ul class="nav nav-tabs">
              <li class="active"><a href="<?php echo base_url();?>index.php/item/create_item" data-toggle="tab" aria-expanded="false">
                <?php echo $this->lang->line('item_tab_general_setting');?>
              </a></li>
              <li class="disabled disabledTab"><a href="#tab_2" data-toggle="tab" aria-expanded="false">
                <?php echo $this->lang->line('item_tab_sales_pricing');?>
              </a></li>
              <li class="disabled disabledTab"><a href="#tab_3" data-toggle="tab" aria-expanded="true">
                <?php echo $this->lang->line('item_tab_purchase_pricing');?>
              </a></li>
          </ul> -->

          <div class="row">

          <form action="<?php echo base_url();?>item/add_item"  method="post" class="form-horizontal" enctype="multipart/form-data" name="itemform">

            <div class="col-md-12">
              <div class="col-md-6">

                        <h4 class="text-info text-center">
                          <!-- Item Information -->
                          <?php echo $this->lang->line('add_item_header');?>
                        </h4>
                  
                          <div class="box-body" style="padding: 20px">
                              
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-5 control-label">
                                  Product Code
                                  <!-- <?php echo $this->lang->line('add_item_name');?> -->
                                  <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-7">
                                  <div class="control">
                                      <input type="text" class="form-control" name="product_code" id="product_code" placeholder="Product Code" value="<?php echo set_value('product_code'); ?>"> 
                                      <span style="color:#990000;"></span>
                                      <p style="color:#990000;"></p>
                                      <h5 style="color:#990000;"><?php echo form_error('product_code'); ?></h5>
                                    </div> 
                                </div>
                              </div>


                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-5 control-label">
                                  <!-- Item Name -->
                                  <?php echo $this->lang->line('add_item_name');?>
                                  <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-7">
                                  <div class="control">
                                      <input type="text" class="form-control" name="itemname" id="iname" placeholder="<?php echo $this->lang->line('add_item_name');?>"> 
                                      <span style="color:#990000;"></span>
                                      <p style="color:#990000;"></p>
                                      <h5 style="color:#990000;"><?php echo form_error('itemname'); ?></h5>

                                    </div> 
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-5 control-label">
                                  <!-- Item Name -->
                                  <!-- <?php echo $this->lang->line('add_item_name');?> -->
                                  HSN/SAC Code
                                  <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-7">
                                  <div class="control">
                                      <input type="text" class="form-control" id="hsn_sac_code" name="hsn_sac_code" value="<?php echo set_value('hsn_sac_code'); ?>" placeholder="Select HSN/SAC Code">
                                      <span style="color:#990000;"></span>
                                      <p style="color:#990000;"></p>
                                      <a href="" data-toggle="modal" data-target="#myModal"><div>HSN/SAC Lookup</div></a>
                                      <h5 style="color:#990000;"><?php echo form_error('hsn_sac_code'); ?></h5>
                                  </div> 
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-5 control-label">
                                  <!-- Category -->
                                  <?php echo $this->lang->line('add_item_category');?>
                                  <span class="text-danger">*</span>
                                  
                                </label>
                                <div class="col-sm-7">
                                  <div class="control">
                                        <select class="form-control select2" id="category" name="category">
                                          <option value=""><?php echo $this->lang->line('lbl_dropdown_customer');?></option>
                                          <?php foreach($item as $row){ ?>
                                              <option value="<?php echo $row->id; ?>">
                                              <?php echo $row->category_name; ?></option>  
                                          <?php } ?>
                                      </select>
                                      <a href="#category_model" data-toggle="modal" data-target="" ><span class="">Add Category</span></a>
                                      <p style="color:#990000;"></p>
                                      <h5 style="color:#990000;"><?php echo form_error('category'); ?></h5>
                                    </div> 
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-5 control-label">
                                  Units (Units Of Measurement)
                                  <!-- <?php echo $this->lang->line('add_item_units');?> -->
                                  <span class="text-danger">*</span>
                                  
                                </label>
                                <div class="col-sm-7">
                                  <div class="control">
                                      <select class="form-control select2" id="unit" name="unit">
                                      <option value=""><?php echo $this->lang->line('lbl_dropdown_customer');?></option>
                                        <?php foreach($unit as $row) {?>
                                            <option value="<?php echo $row->id; ?>">
                                            <?php echo $row->unit_name; ?></option>  
                                        <?php } ?>
                                      </select>
                                      <a href="#unit_model" data-toggle="modal" data-target="" ><span class="">Add Unit</span></a>
                                      <p style="color:#990000;"></p>
                                      <h5 style="color:#990000;"><?php echo form_error('unit'); ?></h5>
                                  </div> 
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-5 control-label">
                                  <!-- Tax Type -->
                                  <?php echo $this->lang->line('add_item_taxtype');?>
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-7">
                                  <div class="control">
                                      <select class="form-control select2" id="tax_type" name="tax_type" tabindex="1">
                                        <option value="">
                                          <?php echo $this->lang->line('lbl_dropdown_customer');?>
                                        </option>
                                        <?php foreach($tax as $row) {?>
                                            <option value="<?php echo $row->tax_id; ?>">
                                            <?php echo $row->tax_name; ?></option>  
                                        <?php } ?>
                                      </select>
                                      <p style="color:#990000;"></p>
                                      <h5 style="color:#990000;"><?php echo form_error('tax_type'); ?></h5>
                                  </div> 
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-5 control-label">
                                <!-- Item Description -->
                                <?php echo $this->lang->line('add_item_desc');?>
                                </label>
                                <div class="col-sm-7">
                                  <div class="control">
                                      <textarea class="form-control" id="itemdesc" name="itemdesc" placeholder="Item Description"></textarea>
                                      <span style="font-size:20px;"></span>
                                      <p style="color:#990000;"></p>
                                  </div> 
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-5 control-label">
                                  <!-- Status -->
                                <?php echo $this->lang->line('add_item_status');?>
                                </label>
                                <div class="col-sm-7">
                                  <div class="control">
                                    <!-- <input type="text" class="form-control" id="itemname" placeholder="Item Name"> -->
                                    <select class="form-control" id="status" name="status" tabindex="1" onb lur='chkEmpty("customerForm","branch","Please Enter Branch Name");'>
                                          <option value="0">
                                            <!-- Active -->
                                            <?php echo $this->lang->line('lbl_status_active');?>
                                          </option>
                                          <option value="1">
                                            <!-- Inactive -->
                                            <?php echo $this->lang->line('lbl_status_deactive');?>
                                          </option>
                                    </select>
                                  </div> 
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-5 control-label">
                                  <!-- Picture -->
                                  <?php echo $this->lang->line('add_item_picture');?>
                                  <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-7">
                                  <div class="control">
                                      <input type="file" class="form-control" name="picture" id="picture" placeholder="picture">
                                     <!--  <img src="<?php echo base_url();?>/uploads"> -->
                                      <span style="font-size:20px;"></span>
                                      <p style="color:#990000;"></p>
                                    </div> 
                                </div>
                              </div>
                          </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <center>
                                <input type="submit" name="itemSubmit" class="btn btn-info btn-flat" tabindex="22" value="<?php echo $this->lang->line('btn_submit');?>">

                                <a href="<?php echo base_url();?>item/" class="btn btn-default btn-flat"> <?php echo $this->lang->line('btn_cancel');?></a>            
                            </center>
                          </div>
                  
                        
                      <!-- </div>
                  </div> -->
              </div>
              <div class="col-md-6">
                <h4 class="text-info text-center">
                  Item Purchase & Sales Price
                  <!-- <?php echo $this->lang->line('add_item_header');?> -->
                </h4>
                  <div class="box-body" style="padding: 20px">
                      
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-5 control-label">
                          Purchase Price
                          <!-- <?php echo $this->lang->line('add_item_name');?> -->
                          <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-7">
                          <div class="control">
                              <input type="text" class="form-control" name="purchase_price" id="purchase_price" placeholder="Purchase Price"> 
                              <span style="font-size:20px;"></span>
                              <p style="color:#990000;"></p>
                              <h5 style="color:#990000;"><?php echo form_error('purchase_price'); ?></h5>
                            </div> 
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-5 control-label">
                          Sales Price
                          <!-- <?php echo $this->lang->line('add_item_name');?> -->
                          
                          <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-7">
                          <div class="control">
                              <input type="text" class="form-control" id="sales_price" name="sales_price" value="" placeholder="Sales Price">
                              <span style="font-size:20px;"></span>
                              <p style="color:#990000;"></p>
                              <h5 style="color:#990000;"><?php echo form_error('sales_price'); ?></h5>
                          </div> 
                        </div>
                      </div>
                  </div>
              </div>
            </div>  


            </form>

          </div>
      <!-- /.row -->
      
    </section>
    <!-- /.content -->

    <!-- ADD NEW CATEGORY -->
    <div class="example-modal">
      <div class="modal fade" id="category_model">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <center><h4 class="modal-title">
                <b>Add New Category</b>
              </h4></center>
            </div>
            <div class="modal-body">  
                    <div class="form-group">
                      <label class="col-sm-4 control-label require" for="inputEmail3"> 
                          Category Name
                        <span class="text-danger">*</span>
                      </label>

                      <div class="col-sm-6">
                        <input type="text" placeholder="Category Name" class="form-control valdation_check" id="category_name" name="category_name">
                        <span style="color: #990000"></span>
                        <p style="color:#990000;" id="category_error"></p>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-4 control-label require" for="inputEmail3"> 
                          Unit
                        <span class="text-danger">*</span>
                      </label>

                      <div class="col-sm-6">
                        <select class="form-control select2" id="unit_name" name="unit_name" style="width: 100%">
                        <!-- <option value=""><?php echo $this->lang->line('lbl_dropdown_customer');?></option> -->
                          <?php foreach($unit as $row) {?>
                              <option value="<?php echo $row->id; ?>">
                              <?php echo $row->unit_name; ?></option>  
                          <?php } ?>

                        </select>
                        <span style="color: #990000"></span>
                        <p style="color:#990000;" id="unit_error"></p>
                      </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><!-- Close -->
                <?php echo $this->lang->line('btn_modal_close');?>
                </button>
                <input type="submit" class="btn btn-danger" value="Save" id="add_category" name="add_category" data-dismiss="modal">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>
    <!-- /.example-modal -->

    <!-- ADD NEW UNIT -->
    <div class="example-modal">
      <div class="modal fade" id="unit_model">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <center><h4 class="modal-title">
                <b>Add New Unit</b>
              </h4></center>
            </div>
            <div class="modal-body">  
                    <div class="form-group">
                      <label class="col-sm-4 control-label require" for="inputEmail3"> 
                          Unit Name
                        <span class="text-danger">*</span>
                      </label>

                      <div class="col-sm-6">
                        <input type="text" placeholder="Unit Name" class="form-control" id="unit_name_model" name="unit_name">
                        <span style="color: #990000"></span>
                        <p style="color:#990000;" id="unit_model_error"></p>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-4 control-label require" for="inputEmail3"> 
                          Abbreviations
                        <span class="text-danger">*</span>
                      </label>

                      <div class="col-sm-6">
                        <input type="text" placeholder="Abbreviations" class="form-control" id="abbreviations" name="abbreviations">
                        <span style="color: #990000"></span>
                        <p style="color:#990000;" id="abb_error"></p>
                      </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><!-- Close -->
                <?php echo $this->lang->line('btn_modal_close');?>
                </button>
                <input type="submit" class="btn btn-danger" value="Save" id="add_unit" name="add_unit" data-dismiss="modal">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>
    <!-- /.example-modal -->

  </div>
<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?>


<script type="text/javascript">
    $(document).ready(function(){ 


      $("#add_category").click(function ()
      {
          var category = $("#category_name").val();
          var unit = $("#unit_name").val();
    
          if(category=="")
          {
            $('#category_error').text("Enter Category Name");
            return false;
          }

          if(unit=="")
          {
            $('#unit_error').text("Select Unit Name");
            return false;
          }

          $('#category').html('<option value="">Select</option>');
          $.ajax({
            url:"<?php echo base_url('item/add_category');?>",
            method:"POST",
            data:{
                category_name:category,
                unit_id:unit
            },
            dataType : "json",
            success:function(data1)
            {
                var id = data1['category_id'];
                for(i=0;i<data1['category'].length;i++){
                    $('#category').append('<option value="' + data1['category'][i].id + '">' + data1['category'][i].category_name + '</option>');
                }
                $('select[name^="category"] option[value="'+id+'"]').attr("selected","selected");
                $("#category_name").val("");
            }
          });
      });


      $("#add_unit").click(function ()
      {
          var unit = $("#unit_name_model").val();
          var abbre = $("#abbreviations").val();
          if(unit=="")
          {
            $('#unit_model_error').text("Enter Unit Name");
            return false;
          }

          if(abbre=="")
          {
            $('#abb_error').text("Enter Abbreviations");
            return false;
          }

          $('#unit').html('<option value="">Select</option>');
          $.ajax({
            url:"<?php echo base_url('item/add_unit');?>",
            method:"POST",
            data:{
                unit_name:unit,
                abbreviation:abbre
            },
            dataType : "json",
            success:function(data1)
            {
                var id = data1['unit_id'];
                for(i=0;i<data1['unit'].length;i++){
                    $('#unit').append('<option value="' + data1['unit'][i].id + '">' + data1['unit'][i].unit_name + '</option>');
                }
                $('select[name^="unit"] option[value="'+id+'"]').attr("selected","selected");
                $("#unit_name_model").val("");
                $("#abbreviations").val("");
            }
          });
      });



       $("input[name='itemSubmit']").click(function(e)
       {
           var item=chkEmpty("itemform","itemname","Please Enter Item Name");
           var hsn=chkEmpty("itemform","hsn_sac_code","Please Select HSN/SAC Code");
           var purchases=chkEmpty("itemform","purchase_price","Please enter purchase price");
           var sales=chkEmpty("itemform","sales_price","Please enter sales price");
           var cat=chkDrop("itemform","category","Please Select Category");  
           var unit=chkDrop("itemform","unit","Please Select Unit");
           var tax=chkDrop("itemform","tax_type","Please Select Tax Type");
           //var pic=chkEmpty("itemform","picture","Please Select picture");
  
           if((item+hsn+cat+unit+tax+purchases+sales) < 1){
             itemform.submit();
             return true;
           }
           else{
             return false;
           }
           
        });

        $("table.product_table").on("click", "span.apply", function (event) {
            var row = $(this).closest("tr");
            var code = +row.find('#accounting_code').text();
            $('#hsn_sac_code').val(code);
            $('#myModal').modal('hide');
        });
        $("table.product_table1").on("click", "span.apply1", function (event) {
            var row = $(this).closest("tr");
            var code = +row.find('#accounting_code1').text();
            $('#hsn_sac_code').val(code);
            $('#myModal').modal('hide');
        });


        $('#chapter').change(function(){
            var id = $(this).val();

            //alert(id);
            $.ajax({
                url: "<?php echo base_url('item/getHsnData') ?>/"+id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                  var table = $('#index1').DataTable();
                  table.destroy();
                  $('#product_table_body').empty();
                  for(i=0;i<data.length;i++){
                    var newRow = $("<tr>");
                    var cols = "";
                    cols += "<td></td>";
                    cols += "<td><span id='accounting_code1'>"+ data[i].itc_hs_codes+"</span></td>";
                    cols += "<td>"+data[i].description+"</td>";
                    cols += "<td align='center'><span class='btn btn-info apply1' class='close' data-dismiss='modal'>Apply</span></td>";
                    cols += "</tr>";
                    newRow.append(cols);
                    $("table.product_table1").append(newRow);
                  }
                        $(document).ready(function() {
                          var t = $('#index1').DataTable( {
                            "columnDefs": [ {
                                "searchable": false,
                                "orderable": false,
                                "targets": 0
                            } ],
                            "order": [[ 1, 'asc' ]]
                          });

                          t.on( 'order.dt search.dt', function () {
                            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                                cell.innerHTML = i+1;
                            });
                          }).draw();
                        });
                } 
              });
        });

   });
</script>
<script type="text/javascript">
    /*jQuery('#iname').keyup(function ()
    {
        this.value = this.value.replace(/[^a-zA-Z0-9,]/g, function(str) 
        { 
          $("input[name='itemname']").parent().addClass("has-error has-feedback");
          $("input[name='itemname']").parent().find("span").addClass("fa fa-remove form-control-feedback");
          $("input[name='itemname']").parent().find("p").text("Numeric and Characters allowed.");

         ('You typed " ' + str + ' ".\n\nNumeric and Characters allowed.'); return ''; 
        });
        if($(this).val().length > 20)
        {
           $(this).val($(this).val().substring(0, 20));
        }
    });*/
</script>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4>HSN/SAC Lookup</h4>
      </div>
      <div class="modal-body">
        <div class="control-group">                     
          <div class="controls">
            <div class="tabbable">
              <ul class="nav nav-tabs">
                <li>
                  <a href="#hsn" data-toggle="tab">HSN</a>
                </li>
                <li class="active">
                  <a href="#sac" data-toggle="tab">SAC</a>
                </li>
              </ul>                           
              <br>
              <div class="tab-content">
                <div class="tab-pane" id="hsn">
                 <div class="form-group">
                  Chapter
                  <select class="form-control select2" id="chapter" name="chapter" style="width: 40%;">
                    <?php
                      foreach ($chapter as $row) {
                        echo "<option value='$row->id'> Chapter $row->id $row->chapter</option>";
                      }
                    ?>
                  </select>
                </div>
                  <table id="index1" class="table table-bordered table-striped product_table1">
                    <thead>
                      <th>No</th>
                      <th>HSN Codes#</th>
                      <th>Description</th>
                      <th></th>
                    <thead>
                    <tbody id="product_table_body">
                      <?php
                        foreach ($hsn as $value) {
                      ?>
                        <tr>
                          <td></td>
                          <td><span id="accounting_code1"><?php echo $value->itc_hs_codes ?></span></td>
                          <td><?php echo $value->description ?></td>
                          <td align="center"><span class="btn btn-warning apply1" class="close" data-dismiss="modal">Apply</span></td>
                        </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane active" id="sac">
                  <table id="index" class="table table-bordered table-striped product_table">
                    <thead>
                      <th>No</th>
                      <th>SAC Codes#</th>
                      <th>Description</th>
                      <th></th>
                    <thead>
                    <tbody>
                      <?php
                        foreach ($sac as $value) {
                      ?>
                        <tr>
                          <td></td>
                          <td><span id="accounting_code"><?php echo $value->accounting_code ?></span></td>
                          <td><?php echo $value->description ?></td>
                          <td align="center"><span class="btn btn-warning apply" class="close" data-dismiss="modal">Apply</span></td>
                        </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div> <!-- /controls -->       
        </div> <!-- /control-group --> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



