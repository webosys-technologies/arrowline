<?php 
  $this->load->view('layout/header');
?>

<div class="content-wrapper">
<section class="content">
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-10">
             <div class="top-bar-title padding-bottom"><!--  Purchases -->  <?php echo $this->lang->line('lbl_purchasereport_datewise_purchase');?></div>
            </div> 

          </div>
        </div>
      </div>

      <!-- Default box -->
  <div class="box">
       <div class="box-body">
            <div class="table-responsive">
              <div id="purchaseList_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                  <div class="row">
                    <div class="col-sm-6">
                    <div class="dataTables_length" id="purchaseList_length">
                    <label>Show <select name="purchaseList_length" aria-controls="purchaseList" class="form-control input-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    </select> entries</label>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div id="purchaseList_filter" class="dataTables_filter">
                    <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="purchaseList"></label>
                    </div>
                    </div>
                    </div>
           <div class="row">
               <div class="col-sm-12">
                   <table id="purchaseList" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="purchaseList_info">
                        <thead>
                            <tr role="row">
                          <th width="10%" class="sorting" tabindex="0" aria-controls="purchaseList" rowspan="1" colspan="1" aria-label="Invoice #: activate to sort column ascending" style="width: 68px;"> <!-- Invoice # -->  <?php echo $this->lang->line('lbl_purchasereport_datewise_invoice');?></th>

                          <th class="sorting" tabindex="0" aria-controls="purchaseList" rowspan="1" colspan="1" aria-label="Supplier Name: activate to sort column ascending" style="width: 300px;"> <!-- Supplier Name -->  <?php echo $this->lang->line('lbl_purchasereport_datewise_suppliername');?></th>

                          <th class="sorting" tabindex="0" aria-controls="purchaseList" rowspan="1" colspan="1" aria-label="Total: activate to sort column ascending" style="width: 168px;"> <!-- Total -->  <?php echo $this->lang->line('lbl_purchasereport_datewise_total');?></th>

                          <th class="sorting" tabindex="0" aria-controls="purchaseList" rowspan="1" colspan="1" aria-label="Quotation Date: activate to sort column ascending" style="width: 309px;">Quotation Date  <?php echo $this->lang->line('lbl_purchasereport_datewise_quotationdate');?></th>
                          <th width="5%" class="hideColumn sorting_disabled" rowspan="1" colspan="1" aria-label="Action" style="width: 40px;"><!--  Action --> <?php echo $this->lang->line('lbl_purchasereport_datewise_action');?></th></tr>
                  </thead>
                  <tbody>
                                    
                                   
                 <tr role="row" class="odd">
                  <?php foreach ($date as $value) { ?>    
                    <td><a href="<?php echo base_url();?>purchases/purchase_details/<?php echo $value->id;?>"><?php echo $value->reference_no;?></a></td>
                    <td><a href=""><?php echo $value->name;?></a></td>
                    <td><?php echo $value->total;?></td>
                    <td><?php echo $value->date;?></td>
                    <td class="hideColumn">
                      
                   </td>
                </tr>
                 <?php
                }
                ?>
          </tbody>
    </table>
</div>
      </div>
      <div class="row">
      <div class="col-sm-5">
      <div class="dataTables_info" id="purchaseList_info" role="status" aria-live="polite">Showing 1 to 1 of 1 entries</div>
      </div>
      <div class="col-sm-7">
      <div class="dataTables_paginate paging_simple_numbers" id="purchaseList_paginate">
      <ul class="pagination">
      <li class="paginate_button previous disabled" id="purchaseList_previous"><a href="#" aria-controls="purchaseList" data-dt-idx="0" tabindex="0">Previous</a></li>
      <li class="paginate_button active"><a href="#" aria-controls="purchaseList" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button next disabled" id="purchaseList_next"><a href="#" aria-controls="purchaseList" data-dt-idx="2" tabindex="0">Next</a></li>
      </ul>
 </div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>



<?php 
  $this->load->view('layout/footer');
?>
