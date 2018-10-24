<?php 
  $this->load->view('layout/header');

  $user_session = $this->session->userdata('userRole');

  if(empty($user_session))
  {
      redirect('auth','refresh');
  }
  
  if(!in_array("edit_item",$user_session)){
      redirect('item','refresh');
  }

?>
<!-- <?php
  foreach($item as $row){
  }
?> -->
<div class="content-wrapper">
    <div id="notifications" class="row no-print">
      <div class="col-md-12">
        
      </div>
    </div>    
    <section class="content">
      <!-- Top Box-->
      <div class="box">
        <div class="box-body">
          <strong><?php echo $item->item_name;?></strong>
        </div>
      </div><!--Top Box End-->
      <!-- Default box -->
      <div class="box">
        <?php if($this->session->flashdata('success')) { ?>
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i></h4>
                <?php echo $this->session->flashdata('success');?>
            </div>
        <?php } ?> 
         
        <div class="row">

          <form action="<?php echo base_url();?>item/edit_data"  method="post" class="form-horizontal" enctype="multipart/form-data" name="itemform">
            <div class="col-md-12">
              <div class="col-md-6">
                <h4 class="text-info text-center">
                  <?php echo $this->lang->line('add_item_header');?>
                </h4>
                <?php echo validation_errors(); ?>  
                 
                  <div class="box-body" style="padding: 20px">

                    <input type="hidden" value="<?php echo $item->id;?>" name="item_id">

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-5 control-label">
                        Product Code
                        <!-- <?php echo $this->lang->line('add_item_name');?> -->
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-sm-7">
                        <div class="control">
                            <input type="text" class="form-control" name="product_code" id="product_code" placeholder="Product Code" value="<?php if(isset($item->product_code)){echo $item->product_code;}?>" readonly> 
                            <span style="color:#990000;"></span>
                            <p style="color:#990000;"></p>
                            <h5 style="color:#990000;"><?php echo form_error('itemname'); ?></h5>

                          </div> 
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-5 control-label">
                        <!-- Item Name -->
                        <?php echo $this->lang->line('add_item_name');?>
                      </label>
                      <div class="col-sm-7">
                        <div class="control">
                            <input type="text" class="form-control" name="itemname" id="iname" placeholder="<?php echo $this->lang->line('add_item_name');?>" value="<?php echo $item->item_name;?>" id="iname">
                            <p style="color:#990000;"></p>
                            <h5 style="color:#990000;"><?php echo form_error('itemname'); ?></h5>
                          </div> 
                      </div>
                    </div>
                  
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-5 control-label">
                        <!-- HSN Code -->
                        <!-- <?php echo $this->lang->line('add_item_name');?> -->
                        HSN/SAC Code
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-sm-7">
                        <div class="control">
                            <input type="text" class="form-control" id="hsn_sac_code" name="hsn_sac_code" value="<?php echo $item->hsn_code;?>" placeholder="Select HSN/SAC Code">
                            <p style="color:#990000;"></p>
                            <a href="" data-toggle="modal" data-target="#myModal"><span>HSN/SAC Lookup</span></a>
                            <span class="validation-color" id="err_hsn_sac_code">
                            </span>
                            <h5 style="color:#990000;"><?php echo form_error('hsn_sac_code'); ?></h5>
                        </div> 
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-5 control-label">
                        <!-- Category -->
                        <?php echo $this->lang->line('add_item_category');?>
                        
                      </label>
                      <div class="col-sm-7">
                        <div class="control">
                              <select class="form-control select2" id="category" name="category">      
                              <?php foreach($cat as $value){?>  
                                    <option value="<?php echo $value->id;?>"
                                          <?php if($value->id==$item->category_id)
                                          {echo "selected";}?>>
                                      <?php echo $value->category_name; ?>
                                    </option>  
                                <?php
                                  }
                                ?>
                             </select>
                             <a href="#category_model" data-toggle="modal" data-target="" ><span class="">Add Category</span></a>
                            <span style="font-size:20px;"></span>
                            <p style="color:#990000;"></p>
                            <h5 style="color:#990000;"><?php echo form_error('category'); ?></h5>
                          </div> 
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-5 control-label">
                        <!-- Units -->
                        <?php echo $this->lang->line('add_item_units');?>
                      </label>
                      <div class="col-sm-7">
                        <div class="control">
                            <select class="form-control select2" id="unit" name="units">
                              <?php 
                                  foreach($unit as $value)
                                  {
                                ?>
                                    <option value="<?php echo $value->id;?>"<?php if($value->id==$item->unit_id){echo "selected";}?>>
                                    <?php echo $value->unit_name; ?></option>  
                                <?php
                                  }
                                ?>           
                              </select>
                              <a href="#unit_model" data-toggle="modal" data-target="" ><span class="">Add Unit</span></a>
                              <span style="font-size:20px;"></span>
                              <p style="color:#990000;"></p>
                              <h5 style="color:#990000;"><?php echo form_error('units'); ?></h5>
                          </div> 
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-5 control-label">
                        <!-- Tax Type -->
                        <?php echo $this->lang->line('add_item_taxtype');?>
                      </label>
                      <div class="col-sm-7">
                        <div class="control">
                            <select class="form-control select2" id="taxtype" name="tax" tabindex="1" onblur='chkEmpty("customerForm","branch","Please Enter Branch Name");'>
                              <?php 
                                  foreach($tax as $value){?>
                                    <option value="<?php echo $value->tax_id;?>" <?php if($value->tax_id==$item->tax_id){echo "selected";}?>>
                                    <?php echo $value->tax_name; ?></option>  
                                <?php } ?>
                              </select>
                              <span style="font-size:20px;"></span>
                            <p style="color:#990000;"></p>
                              <h5 style="color:#990000;"><?php echo form_error('tax'); ?></h5>

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
                            
                            <textarea class="form-control" id="itemdesc" name="itemdesc" placeholder="Item Description" value=""><?php echo $item->item_description?></textarea>
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
                            <select class="form-control" id="status" name="status" tabindex="1" onb lur='chkEmpty("customerForm","branch","Please Enter Branch Name");'>
                                  <option>
                                    <!-- Active -->
                                    <?php echo $this->lang->line('lbl_status_active');?>
                                  </option>
                                  <option>
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
                      </label>
                      <div class="col-sm-7">
                        <div class="control">
                            <input type="file" class="form-control" name="picture" id="picture" placeholder="picture">
                            <input type="hidden" name="pic" value="<?php echo $item->picture?>">
                          </div> 
                          <span style="font-size:20px;"></span>
                            <p style="color:#990000;"></p>

                      </div>
                    </div>

                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <center>
                        <input type="submit" name="itemSubmit" class="btn btn-info btn-flat" tabindex="22" value="<?php echo $this->lang->line('btn_submit');?>">

                        <a href="<?php echo base_url();?>item/" class="btn btn-default btn-flat"><?php echo $this->lang->line('btn_cancel');?></a>            
                    </center>  
                  </div>

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
                                  <input type="text" class="form-control" name="purchase_price" id="purchase_price" placeholder="Purchase Price" value="<?php echo $item->purchase_price;?>"> 
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
                                  <input type="text" class="form-control" id="sales_price" name="sales_price" placeholder="Sales Price" value="<?php echo $item->sales_price;?>">
                                  <span style="font-size:20px;"></span>
                                  <p style="color:#990000;"></p>
                                  <h5 style="color:#990000;"><?php echo form_error('sales_price'); ?></h5>
                              </div> 
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-5 control-label">
                            </label>
                            <div class="col-sm-7">
                              <div class="control">
                                <?php if(isset($item->picture)){ ?>
                                  <img src="<?php echo base_url();?>uploads/<?php echo $item->picture;?>" height="70" width="100">
                                <?php }else{?>
                                    <img src="<?php echo base_url();?>assets/logo/no_image.png" height="60" width="60">
                                <?php } ?>

                                <?php if(isset($item->bar_code)){ ?>
                                  <img src="<?php echo base_url();?>assets/barcode/<?php echo $item->bar_code;?>" height="70" width="120">
                                <?php } ?>
                              </div> 
                            </div>
                          </div>

                      </div>
              </div>
            </div>
          </form>
          </div>
        
      </div>
      <div class="clearfix"></div>
    </section>

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
         var sales_price=chkEmpty("itemform","sales_price","Please Enter Sale Price");
         var purchase_price=chkEmpty("itemform","purchase_price","Please Enter Purchase Price");
         var cat=chkDrop("itemform","category","Please Select Category");  
         var unit=chkDrop("itemform","units","Please Select Unit");
         var tax=chkDrop("itemform","tax","Please Select Tax Type");
         //var pic=chkEmpty("itemform","pic","Please Select picture");
         if((item+cat+unit+tax+sales_price+purchase_price) < 1){
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
<!-- <script type="text/javascript">
  
    $('#sales').keyup(function() 
    {
        $('span.error-keyup-1').hide();
        var inputVal = $(this).val();
        var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
        if(!numericReg.test(inputVal)) 
        {
        $(this).after('<span class="error error-keyup-1 text-danger">Numeric characters only.</span>');
        }
    });

    $("#sales").keypress(function(e) {
     if (!/[0-9\b]/i.test(String.fromCharCode(e.which))) {
         return false;
     }
   });
</script>
 -->
<!-- <script type="text/javascript">
  
    $('#purchase').keyup(function() 
    {
        $('span.error-keyup-1').hide();
        var inputVal = $(this).val();
        var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
        if(!numericReg.test(inputVal)) 
        {
        $(this).after('<span class="error error-keyup-1 text-danger">Numeric characters only.</span>');
        }
    });

    $("#purchase").keypress(function(e) {
     if (!/[0-9\b]/i.test(String.fromCharCode(e.which))) {
         return false;
     }
   });
</script> -->

<script type="text/javascript">

  window.setTimeout(function() {
      $(".alert").fadeTo(400, 0).slideUp(400, function(){
          $(this).remove(); 
      });
  }, 4000);

</script>
<!-- <script type="text/javascript">
jQuery('#iname').keyup(function (){

       this.value = this.value.replace(/[^a-zA-Z0-9,]/g, function(str) 
      { 
        $("input[name='itemname']").parent().addClass("has-error has-feedback");
        $("input[name='itemname']").parent().find("span").addClass("fa fa-remove form-control-feedback");
        $("input[name='itemname']").parent().find("p").text("Numeric and Characters allowed.");

       ('You typed " ' + str + ' ".\n\nNumeric and Characters allowed.'); return ''; });
        if($(this).val().length > 20)
        {
           $(this).val($(this).val().substring(0, 20));
        }
   });
</script>
 -->
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
