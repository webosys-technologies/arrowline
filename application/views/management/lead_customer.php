<?php 
  $this->load->view('layout/header');
  $user_session = $this->session->userdata('userRole');

  if(empty($user_session))
  {
      redirect('auth','refresh');
  }
  
  if(!in_array("manage_customer",$user_session)){
      redirect('auth','refresh');
  }
?>
<script>
      
    </script>
    <style>
        #example1 tfoot {
    display: table-header-group;
}
        </style>
    
<div class="content-wrapper">
       
  <section class="content">
    <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">
              <div class="top-bar-title padding-bottom">
                <!-- Customer -->
                <?php echo "Customer Lead Management";?>
              </div>
            </div> 
            <?php  
              if(in_array("manage_customer",$user_session)){
            ?>
            <div class="col-md-2 col-xs-2 top-left-btn">
                <a href="<?php echo base_url();?>customer/import" class="btn btn-block btn-default btn-flat btn-border-purple"><span class="fa fa-upload"> &nbsp;</span>
                  <!-- Import Customer -->
                  <?php echo $this->lang->line('import_customer');?>
                </a>
            </div>
            <?php } ?>

            <?php  
              if(in_array("add_lead",$user_session)){
            ?>
            <div class="col-md-2 col-xs-2 top-right-btn">
                <a href="<?php echo base_url()?>Management/add_customer_lead" class="btn btn-block btn-primary btn-flat btn-border-orange"><span class="fa fa-plus"></span>
                  <!-- Add Customer -->
                  <?php echo "Add Lead";?>
                </a>
            </div>
            <?php } ?>
            </div>
        </div>
      </div> 

       <?php if($this->session->flashdata('success')) { ?>
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i> 
              <!-- Alert! -->
              <?php echo $this->lang->line('alert');?>
            </h4>
            <?php echo $this->session->flashdata('success');?>
          </div>
      <?php } ?>

    <!-- Top Box-->
      <div class="box">
        <div class="box-footer">
          <div class="col-md-4 col-xs-6 border-right">
              <h3 class="bold"><?php echo $customer->total;?></h3>
              <span>
                <!-- Total Customers -->
                <?php echo $this->lang->line('total_customers');?>
              </span>
          </div>
          <div class="col-md-4 col-xs-6 border-right">
              <h3 class="bold"><?php echo $status->Active;?></h3>
              <span>
              <!-- Active Customers -->
              <?php echo $this->lang->line('active_customers');?>
              </span>
          </div>
          <div class="col-md-4 col-xs-6 border-right">
              <h3 class="bold"><?php echo $deactive->Deactive;?></h3>
              <span>
                <!-- Inactive Customers -->
                <?php echo $this->lang->line('inactive_customers');?>
              </span>
          </div>
            </div>
        </div>

      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            
             <div class="box-header">
              <a href="<?php echo base_url();?>customer/create_full_csv">
                <button class="btn btn-default btn-flat btn-border-info"><span class="fa fa-download"> &nbsp;</span>
               <!--  Download CSV -->
                <?php echo $this->lang->line('btn_download_csv');?>
                </button>
              </a>
            </div>
            <!-- /.box-header -->
           
            <div class="box-body">
                <div class="table-responsive">
              <table id="example1" width="100%" class="table table-bordered table-striped">
                <thead>
                 
                <tr>
                    <th>
                      <!-- Customer Name -->
                      <?php echo $this->lang->line('cust_name');?>
                    </th>
                   
                    <th>
                      <!-- Phone -->
                      <?php echo $this->lang->line('cust_phone');?>
                    </th>
                     <th>
                      <!-- Email -->
                      <?php echo "Area"; ?>
                    </th>
                     <th>
                      <!-- Status -->
                      <?php echo "Followup";?>
                    </th>
                     <th>
                      <!-- Status -->
                      <?php echo "Next Followup";?>
                    </th>
                     <th>
                      <!-- Status -->
                      <?php echo "Status";?>
                    </th>
                     <th>
                      <!-- Status -->
                      <?php echo "Updated By";?>
                    </th>
<!--                    <th>
                       Status 
                      <?php echo $this->lang->line('cust_status');?>
                    </th>-->
                    <th>
                      <!-- Action -->
                      <?php echo $this->lang->line('cust_action');?>
                    </th>
                </tr>
                
                </thead>
                 <tfoot>
                <tr>
                    <th>
                      <!-- Customer Name -->
                      <?php echo $this->lang->line('cust_name');?>
                    </th>
                   
                    <th>
                      <!-- Phone -->
                      <?php echo $this->lang->line('cust_phone');?>
                    </th>
                     <th>
                      <!-- Email -->
                      <?php echo "Area"; ?>
                    </th>
                      <th>
                      <!-- Status -->
                      <?php echo "Followup";?>
                    </th>
                     <th>
                      <!-- Status -->
                      <?php echo "Next Followup";?>
                    </th>
                     <th>
                      <!-- Status -->
                      <?php echo "Status";?>
                    </th>
                     <th>
                      <!-- Status -->
                      <?php echo "Updated By";?>
                    </th>
<!--                    <th>
                       Status 
                      <?php echo $this->lang->line('cust_status');?>
                    </th>-->
                    <th>
                       <!--Action
                      <?php echo $this->lang->line('cust_action');?>--> 
                    </th>
                </tr>
                </tfoot>
                <tbody>
                    
                     <?php
                      
                         
                           foreach ($data as $value) {
                               if($value->delete_status!=1)
                               {
                                   
                            $city=$this->Lead_model->getCity($value->city_id);
                            
                           
                          if(isset($value->telecaller)){ 
                           $telecaller=$this->Customer_model->gettelecaller($value->telecaller);
                           }
                             
                      ?>
                      <tr>
                          <td><a target="_blank" href="<?php echo base_url();?>Management/lead_order/<?php echo $value->id?>"><?php echo $value->name; ?></a></td>                        
                        <td><?php echo $value->phone; ?></td>
                        <td><?php if(isset($city)){ echo $city->name; }?></td>
                        <td><?php echo $value->follow; ?></td>
                        <td><?php echo $value->nextfollow; ?></td>
                        <td>
                            <?php if(!empty($value->lead_status))
                            { ?>
                            <select class="form-control selcet2" id="status" name="status">
                                   <?php
                                   foreach($statuses as $stat)
                                   {
                                       if($stat->is_deleted!=1)
                                       {
                                   ?>
                                    <option value="<?php echo $value->id."-".$stat->name;?>" <?php if($value->lead_status==$stat->name){echo "selected";}?>><?php echo $stat->name;?></option>
                                    <?php
                                   }
                                   }
                                    ?>
                                    </select>
                            <?php } ?>
                        </td>
                        <td><?php if($telecaller){echo $telecaller->first_name." ".$telecaller->last_name;} ?></td>
<!--                        <td>
                          <?php if($value->delete_status=="0"){?>
                          <span class="label label-success"><?php echo $this->lang->line('lbl_status_active');?></span>
                          <?php } else {?>
                            <span class="label label-warning"><?php echo $this->lang->line('lbl_status_deactive');?></span>
                          <?php } ?>
                        </td>-->
                         <td>
                          <?php  
                      
                            if(in_array("edit_lead",$user_session)){
                          ?>
                         <a title="Edit" class="btn btn-xs btn-primary" href="<?php echo base_url();?>Management/edit/<?php echo $value->id;?>" data-tt="tooltip"><span class="fa fa-edit"></span>
                         </a>
                         <?php } ?>                      
                               
<!--                          <a href="#<?php echo $value->id; ?>" data-toggle="modal" data-target="" class="btn btn-xs btn-danger" data-tt="tooltip" title="Delete"><span class="fa fa-remove"></span>
                          </a>-->
                             
                             
                              <?php  
                            if(in_array("convert_lead_to_customer",$user_session)){
                                if($value->status=='0')
                                {
                                    
                                
                          ?>
                         <a title="Convert Customer" class="btn btn-xs btn-warning" href="<?php echo base_url();?>Management/convert_customer/<?php echo $value->id;?>" data-tt="tooltip"><span class="glyphicon glyphicon-share"></span>
                         </a>
                            <?php } } ?>
                             
                            <?php  
                            if(in_array("edit_customer",$user_session)){
                             if($value->status=='1')   
                             {
                          ?>
                         <a title="Get Order" class="btn btn-xs btn-info" href="<?php echo base_url();?>Management/add_form/<?php echo $value->id;?>" data-tt="tooltip"><span class="glyphicon glyphicon-share"></span>
                         </a>
                            <?php } } ?>
                             
                              <?php  
                            if(in_array("edit_customer",$user_session)){
                           
                          ?>
                         <a title="Add Quotation" class="btn btn-xs btn-primary" href="<?php echo base_url();?>Management/get_quotation/<?php echo $value->id;?>" data-tt="tooltip"><span class="glyphicon glyphicon-plus"></span>
                         </a>
                            <?php }  ?>
                         
                          
                          <div class="example-modal">
                          <div class="modal fade" id="<?php echo''.$value->id.'';?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                  <center><h4 class="modal-title">
                                    <!-- !!  Delete Customer !! -->
                                    <?php echo $this->lang->line('lbl_cust_delete_modal');?>
                                  </h4></center>
                                </div>
                                <div class="modal-body">
                                  <p><h4><b>
                                  <?php echo $this->lang->line('delete_modal');?>
                                  <!-- Are you sure to delete this Record !!&hellip; -->
                                  </b></h4></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                    <!-- Close -->
                                      <?php echo $this->lang->line('btn_modal_close');?>
                                    </button>
                                    <a href="<?php echo base_url();?>Management/delete/<?php echo $value->id; ?>" class="btn btn-danger">
                                    <!-- Delete -->
                                    <?php echo $this->lang->line('btn_modal_delete');?>
                                    </a>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          <!-- /.modal -->
                        </div>
                        <!-- /.example-modal -->
                        </td>
                    </tr>
                     <?php
                      }
                           }
                        ?>
              </tbody>
               
              </table>
              </div>      
            </div>
        </div>
      </div>
  </section>
</div>

<?php 
  $this->load->view('layout/footer');
?> 

<script type="text/javascript">

    window.setTimeout(function() {
        $(".alert").fadeTo(400, 0).slideUp(400, function(){
            $(this).remove(); 
        });
    }, 4000);
    
     $(document).ready(function () {
         var i=1;
    // Setup - add a text input to each footer cell
    $('#example1 tfoot th').each(function () {
        var title = $('#example1 thead th').eq($(this).index()).text().trim();
        if(i<9)
        {
        $(this).html('<input type="text" size="12\n\
" placeholder="Search ' + title + '" />');
        }
        i++;
    });   
    
   

    // DataTable
    var table = $('#example1').DataTable();

    // Apply the search
    table.columns().eq(0).each(function (colIdx) {
        $('input', table.column(colIdx).footer()).on('keyup change', function () {
            table.column(colIdx)
                .search(this.value)
                .draw();
        });
    });
    
  
    
});

 $("select").change(function() {
       
            $.ajax({
       url : "<?php echo base_url('Management/update_customer_status')?>/" + $("#status").val(),        
       type: "GET",        
       dataType: "JSON",
       success: function(data)
       {        
          location.reload();
       },
       error: function (jqXHR, textStatus, errorThrown)
       {
       //  alert('Error...!');
       }
     });   
    });

  </script>

