 <?php 
  $this->load->view('layout/header');


  $year =array();
  $current = date("Y");
  $cnt = 0;

  for($i = 0 ;$i < 5 ;$i--)
  {
    $temp_year = date("Y",strtotime("$i year"));  
    if($temp_year == 2014)
    {
      break;
    }
    else{
      $year[$cnt] = date("Y",strtotime("$i year"));  
    }
    $cnt++;
  }

  $jan=0;
  $feb=0;
  $mar=0;
  $apr=0;
  $may=0;
  $jun=0;
  $jul=0;
  $aug=0;
  $sep=0;
  $oct=0;
  $nov=0;
  $dec=0;

  foreach ($income as $row) {
    if($row->month==1){$jan=$row->amount;}
    if($row->month==2){$feb=$row->amount;}
    if($row->month==3){$mar=$row->amount;}
    if($row->month==4){$apr=$row->amount;}
    if($row->month==5){$may=$row->amount;}
    if($row->month==6){$jun=$row->amount;}
    if($row->month==7){$jul=$row->amount;}
    if($row->month==8){$aug=$row->amount;}   
    if($row->month==9){$sep=$row->amount;}
    if($row->month==10){$oct=$row->amount;}
    if($row->month==11){$nov=$row->amount;}
    if($row->month==12){$dec=$row->amount;}
  }
    $total_income=$jan+$feb+$mar+$apr+$may+$jun+$jul+$aug+$sep+$oct+$nov+$dec;
  


  $january=0;
  $febuary=0;
  $march=0;
  $april=0;
  $mayy=0;
  $june=0;
  $july=0;
  $august=0;
  $september=0;
  $octomber=0;
  $novber=0;
  $december=0;

  foreach ($expense as $value) {
    if($value->month==1){$january=$value->amount;}
    if($value->month==2){$febuary=$value->amount;}
    if($value->month==3){$march=$value->amount;}
    if($value->month==4){$april=$value->amount;}
    if($value->month==5){$mayy=$value->amount;}
    if($value->month==6){$june=$value->amount;}
    if($value->month==7){$july=$value->amount;}
    if($value->month==8){$august=$value->amount;}   
    if($value->month==9){$september=$value->amount;}
    if($value->month==10){$octomber=$value->amount;}
    if($value->month==11){$novber=$value->amount;}
    if($value->month==12){$december=$value->amount;}
  }
    $total_expense=$january+$febuary+$march+$april+$mayy+$june+$july+$august+$september+$octomber+$novber+$december;
  

$januaryprofit=0;
if($jan-$january > 0)
{
  $januaryprofit=($jan-$january);  
}

$febprofit=0;
if($feb-$febuary){
  $febprofit=($feb-$febuary);
}

$marprofit=0;
if($mar-$march){
  $marprofit=($mar-$march);
}

$aprprofit=0;
if($apr-$april){
  $aprprofit=($apr-$april);
}

$mayprofit=0;
if($may-$mayy){ 
  $mayprofit=($may-$mayy);
}

$juneprofit=0;
if($jun-$june){
  $juneprofit=($jun-$june);
}


$julyprofit=0;
if($jul-$july){
 $julyprofit=($jul-$july);
}

$augprofit=0;
if($aug-$august){
  $augprofit=($aug-$august);
}

 $sepprofit=0;
 if($sep-$september){
  $sepprofit=($sep-$september);
  }
 $octprofit=0;
 if($oct-$octomber > 0)
 {
    $octprofit=$oct-$octomber;
 }

 $novprofit=0;
 if($nov-$novber){
  $novprofit=($nov-$novber);
}

 $decprofit=0;
 if($dec-$december){
  $decprofit=($dec-$december);
  }

 $total_profit=$januaryprofit+$febprofit+$marprofit+$aprprofit+$mayprofit+$juneprofit+$julyprofit+
  $augprofit+$sepprofit+$octprofit+$novprofit+$decprofit;
 
?>

<div class="content-wrapper">
 <!-- Main content -->
    <section class="content">
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
             <div class="top-bar-title padding-bottom"> <!-- Income VS Expense -->  <?php echo $this->lang->line('lbl_incomereport_incomeexpensereport');?></div>
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
                  <label class="col-sm-5 control-label" for="inputEmail3"> <!-- Year -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_year');?></label>
                  <div class="col-sm-2">
                    <select class="form-control select2" name="year" id="year">
                        <option value="">All</option>
                      <?php foreach ($year as $yr) {?>
                          <option value="<?php echo $yr;?>"><?php echo $yr;?></option>
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
                    <th class="text-center"> <!-- Month -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_month');?></th>
                    <th class="text-center"> <!-- Income($) -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_income');?></th>
                    <th class="text-center"><!--  Expense($) -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_expense');?></th>
                    <th class="text-center"> <!-- Profit($) -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_profit');?></th>
              
                  </tr>
                  </thead>
                  <tbody>
                   <tr>
                    <td class="text-center"> <!-- January  --> <?php echo $this->lang->line('lbl_incomevsexpensereport_jan');?></td>
                    <td class="text-center"><?php if(isset($jan)){echo $jan;}else{echo "0";}?></td>
                    <td class="text-center"><?php if(isset($january)){echo $january;}else{echo "0";}?></td>
                    <td class="text-center"><?php echo $januaryprofit;?></td>
                  </tr>
                   <tr>
                    <td class="text-center"><!--  February -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_feb');?></td>
                    <td class="text-center"><?php if(isset($feb)){echo $feb;}else{echo "0";}?></td>
                    <td class="text-center"><?php if(isset($febuary)){echo $febuary;}else{echo "0";}?></td>
                    <td class="text-center"><?php echo $febprofit;?></td>
                  </tr>
                   <tr>
                    <td class="text-center"><!--  March -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_mar');?></td>
                    <td class="text-center"><?php if(isset($mar)){echo $mar;}else{echo "0";}?></td>
                    <td class="text-center"><?php if(isset($march)){echo $march;}else{echo "0";}?></td>
                    <td class="text-center"><?php echo $marprofit;?></td>
                  </tr>
                   <tr>
                    <td class="text-center"> <!-- Appril -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_apr');?></td>
                    <td class="text-center"><?php if(isset($apr)){echo $apr;}else{echo "0";}?></td>
                    <td class="text-center"><?php if(isset($april)){echo $april;}else{echo "0";}?></td>
                    <td class="text-center"><?php echo $aprprofit;?></td>
                  </tr>
                  <tr>
                    <td class="text-center"> <!-- May -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_may');?></td>
                    <td class="text-center"><?php if(isset($may)){echo $may;}else{echo "0";}?></td>
                    <td class="text-center"><?php if(isset($mayy)){echo $mayy;}else{echo "0";}?></td>
                    <td class="text-center"><?php echo $mayprofit;?></td>
                  </tr>
                  <tr>
                    <td class="text-center"> <!-- June -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_jun');?></td>
                    <td class="text-center"><?php if(isset($jun)){echo $jun;}else{echo "0";}?></td>
                    <td class="text-center"><?php if(isset($june)){echo $june;}else{echo "0";}?></td>
                    <td class="text-center"><?php echo $juneprofit;?></td>
                  </tr>
                  <tr>
                    <td class="text-center"> <!-- July -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_jul');?></td>
                    <td class="text-center"><?php if(isset($jul)){echo $jul;}else{echo "0";}?></td>
                    <td class="text-center"><?php if(isset($july)){echo $july;}else{echo "0";}?></td>
                    <td class="text-center"><?php echo $julyprofit;?></td>
                  </tr>
                  <tr>
                    <td class="text-center"><!--  August  --> <?php echo $this->lang->line('lbl_incomevsexpensereport_aug');?></td>
                    <td class="text-center"><?php if(isset($aug)){echo $aug;}else{echo "0";}?></td>
                    <td class="text-center"><?php if(isset($august)){echo $august;}else{echo "0";}?></td>
                    <td class="text-center"><?php echo $augprofit;?></td>
                  </tr>
                  <tr>
                    <td class="text-center"><!--  September -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_sep');?></td>
                    <td class="text-center"><?php if(isset($sep)){echo $sep;}else{echo "0";}?></td>
                    <td class="text-center"><?php if(isset($september)){echo $september;}else{echo "0";}?></td>
                    <td class="text-center"><?php echo $sepprofit;?></td>
                  </tr>
                   <tr>
                    <td class="text-center"><!--  October -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_oct');?></td>
                    <td class="text-center"><?php if(isset($oct)){echo $oct;}else{echo "0";}?></td>
                    <td class="text-center"><?php if(isset($octomber)){echo $octomber;}else{echo "0";}?></td>
                    <td class="text-center"><?php echo $octprofit;?></td>
                  </tr>
                  <tr>
                    <td class="text-center"> <!-- November -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_nov');?></td>
                    <td class="text-center"><?php if(isset($nov)){echo $nov;}else{echo "0";}?></td>
                    <td class="text-center"><?php if(isset($novber)){echo $novber;}else{echo "0";}?></td>
                    <td class="text-center"><?php echo $novprofit;?></td>
                  </tr>
                  <tr>
                    <td class="text-center"> <!-- December -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_dec');?></td>
                    <td class="text-center"><?php if(isset($dec)){echo $dec;}else{echo "0";}?></td>
                    <td class="text-center"><?php if(isset($december)){echo $december;}else{echo "0";}?></td>
                    <td class="text-center"><?php echo $decprofit;?></td>
                  </tr>
                                  
                  <tr>
                    <th class="text-right"><!--  Total -->  <?php echo $this->lang->line('lbl_incomevsexpensereport_total');?></th>
                    <th class="text-center"><?php echo $total_income;?></th>
                    <th class="text-center"><?php echo $total_expense;?></th>
                    <th class="text-center"><?php echo $total_profit;?></th>
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


<script type="text/javascript">
 $(document).ready(function(){
   
       $("#year").change(function(e)
       { 
          var year=$('#year').val();

          if(year==""){
              location.reload();
          }else{
            $.ajax({
               url:"<?php echo base_url();?>incomevsexpense/income_filter",
               type:"POST",
               data:{
                year1:year,
                },
               dataType:"json", 
               success:function(response)
               {
                  //alert(response['expense'].jan);
                  $('#expenseList tbody').html("");  

                  var jan = 0;
                  if(response['expense'].jan){
                    jan = parseFloat(response['expense'].jan);
                  }

                  var feb = 0;
                  if(response['expense'].feb){
                    feb = parseFloat(response['expense'].feb);
                  }

                  var mar = 0;
                  if(response['expense'].mar){
                    mar = parseFloat(response['expense'].mar);
                  }

                  var apl = 0;
                  if(response['expense'].apl){
                    apl = parseFloat(response['expense'].apl);
                  }

                  var may = 0;
                  if(response['expense'].may){
                    may = parseFloat(response['expense'].may);
                  }

                  var jun = 0;
                  if(response['expense'].jun){
                    jun = parseFloat(response['expense'].jun);
                  }

                  var july = 0;
                  if(response['expense'].july){
                    july = parseFloat(response['expense'].july);
                  } 

                  var aug = 0;
                  if(response['expense'].aug){
                    aug = parseFloat(response['expense'].aug);
                  }

                  var sept = 0;
                  if(response['expense'].sept){
                    sept = parseFloat(response['expense'].sept);
                  }

                  var oct = 0;
                  if(response['expense'].oct){
                    oct= parseFloat(response['expense'].oct);
                  }

                  var nov = 0;
                  if(response['expense'].nov){
                    nov = parseFloat(response['expense'].nov);
                  }

                  var dec = 0;
                  if(response['expense'].dec){
                    dec = parseFloat(response['expense'].dec);
                  }

                  var total_expense = jan + feb + mar + apl + may + jun + july + aug + sept + oct + nov + dec;
                  
                  
                  var january = 0;
                  if(response['income'].jan){
                    january = parseFloat(response['income'].jan);
                  }

                  var february = 0;
                  if(response['income'].feb){
                    february = parseFloat(response['income'].feb);
                  }

                  var march = 0;
                  if(response['income'].mar){
                    march = parseFloat(response['income'].mar);
                  }

                  var april = 0;
                  if(response['income'].apl){
                    april = parseFloat(response['income'].apl);
                  }

                  var may1 = 0;
                  if(response['income'].may){
                    may1 = parseFloat(response['income'].may);
                  }

                  var june = 0;
                  if(response['income'].jun){
                    june = parseFloat(response['income'].jun);
                  }

                  var july1 = 0;
                  if(response['income'].july){
                    july1 = parseFloat(response['income'].july);
                  } 

                  var august = 0;
                  if(response['income'].aug){
                    august = parseFloat(response['income'].aug);
                  }

                  var september = 0;
                  if(response['income'].sept){
                    september = parseFloat(response['income'].sept);
                  }

                  var october = 0;
                  if(response['income'].oct){
                    october= parseFloat(response['income'].oct);
                  }

                  var november = 0;
                  if(response['income'].nov){
                    november = parseFloat(response['income'].nov);
                  }

                  var december = 0;
                  if(response['income'].dec){
                    december = parseFloat(response['income'].dec);
                  }

                  var total_income = january + february + march + april + may1 + june + july1 + august + september + october + november + december;
                  
                  var jan_profit = january - jan; 
                    if(jan_profit < 0 ){ jan_profit = 0 ;}
                  var feb_profit = february - feb;
                    if(feb_profit < 0 ){ feb_profit = 0 ;}
                  var mar_profit = march - mar;
                    if(mar_profit < 0 ){ mar_profit = 0 ;}
                  var apl_profit = april - apl;
                    if(apl_profit < 0 ){ apl_profit = 0 ;}
                  var may_profit = may1 - may;
                    if(may_profit < 0 ){ may_profit = 0 ;}
                  var jun_profit = june - jun;
                    if(jun_profit < 0 ){ jun_profit = 0 ;}
                  var july_profit = july1 - july;
                    if(july_profit < 0 ){ july_profit = 0 ;}
                  var aug_profit = august - aug;
                    if(aug_profit < 0 ){ aug_profit = 0 ;}
                  var sept_profit =september - sept;
                    if(sept_profit < 0 ){ sept_profit = 0 ;}
                  var oct_profit = october - oct;
                    if(oct_profit < 0 ){ oct_profit = 0 ;}
                  var nov_profit = november - nov;
                    if(nov_profit < 0 ){ nov_profit = 0 ;}
                  var dec_profit = december - dec;
                    if(dec_profit < 0 ){ dec_profit = 0 ;}

                  var total_profit = jan_profit + feb_profit + mar_profit +apl_profit + may_profit + jun_profit + july_profit + aug_profit + sept_profit + oct_profit + nov_profit + dec_profit;

                  var table = '<tr>'+
                    '<td class="text-center"> <?php echo $this->lang->line('lbl_incomevsexpensereport_jan');?> </td>'+
                    '<td class="text-center">'+ january +'</td>'+
                    '<td class="text-center">'+ jan +'</td>'+
                    '<td class="text-center">'+ jan_profit +'</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td class="text-center"> <?php echo $this->lang->line('lbl_incomevsexpensereport_feb');?> </td>'+
                    '<td class="text-center">'+ february +'</td>'+
                    '<td class="text-center">'+ feb +'</td>'+
                    '<td class="text-center">'+ feb_profit +'</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td class="text-center"> <?php echo $this->lang->line('lbl_incomevsexpensereport_mar');?> </td>'+
                    '<td class="text-center">'+ march +'</td>'+
                    '<td class="text-center">'+ mar +'</td>'+
                    '<td class="text-center">'+ mar_profit +'</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td class="text-center"> <?php echo $this->lang->line('lbl_incomevsexpensereport_apr');?> </td>'+
                    '<td class="text-center">'+ april +'</td>'+
                    '<td class="text-center">'+ apl +'</td>'+
                    '<td class="text-center">'+ apl_profit +'</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td class="text-center"> <?php echo $this->lang->line('lbl_incomevsexpensereport_may');?> </td>'+
                    '<td class="text-center">'+ may1 +'</td>'+
                    '<td class="text-center">'+ may +'</td>'+
                    '<td class="text-center">'+ may_profit +'</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td class="text-center"> <?php echo $this->lang->line('lbl_incomevsexpensereport_jun');?> </td>'+
                    '<td class="text-center">'+ june +'</td>'+
                    '<td class="text-center">'+ jun +'</td>'+
                    '<td class="text-center">'+ jun_profit +'</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td class="text-center"> <?php echo $this->lang->line('lbl_incomevsexpensereport_jul');?> </td>'+
                    '<td class="text-center">'+ july1 +'</td>'+
                    '<td class="text-center">'+ july +'</td>'+
                    '<td class="text-center">'+ july_profit +'</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td class="text-center"> <?php echo $this->lang->line('lbl_incomevsexpensereport_aug');?> </td>'+
                    '<td class="text-center">'+ august +'</td>'+
                    '<td class="text-center">'+ aug +'</td>'+
                    '<td class="text-center">'+ aug_profit +'</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td class="text-center"> <?php echo $this->lang->line('lbl_incomevsexpensereport_sep');?> </td>'+
                    '<td class="text-center">'+ september +'</td>'+
                    '<td class="text-center">'+ sept +'</td>'+
                    '<td class="text-center">'+ sept_profit +'</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td class="text-center"> <?php echo $this->lang->line('lbl_incomevsexpensereport_oct');?> </td>'+
                    '<td class="text-center">'+ october +'</td>'+
                    '<td class="text-center">'+ oct +'</td>'+
                    '<td class="text-center">'+ oct_profit +'</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td class="text-center"> <?php echo $this->lang->line('lbl_incomevsexpensereport_nov');?> </td>'+
                    '<td class="text-center">'+ november +'</td>'+
                    '<td class="text-center">'+ nov +'</td>'+
                    '<td class="text-center">'+ nov_profit +'</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td class="text-center"> <?php echo $this->lang->line('lbl_incomevsexpensereport_dec');?> </td>'+
                    '<td class="text-center">'+ december +'</td>'+
                    '<td class="text-center">'+ dec +'</td>'+
                    '<td class="text-center">'+ dec_profit +'</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td class="text-center"> <b><?php echo $this->lang->line('lbl_incomevsexpensereport_total');?></b> </td>'+
                    '<td class="text-center"><b>'+ total_income +'</b></td>'+
                    '<td class="text-center"><b>'+ total_expense +'</b></td>'+
                    '<td class="text-center"><b>'+ total_profit +'</b></td>'+
                  '</tr>';

                  $('#expenseList tbody').html(table); 
                  //$('#grandID').html(total);
               }
            });
          }

          e.preventDefault();
       });
    });
</script>  