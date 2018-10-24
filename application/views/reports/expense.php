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
  /*echo "<pre>";
  print_r($year);
  exit();*/

  /*foreach ($subtotal as $key => $value) {
    echo $value['amount'].','.$value['month'].'   ';
  }
exit();*/

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

  foreach ($subtotal as $row) 
  {
    if($row['month'] == 1){$jan=$row['amount'];}
    if($row['month'] == 2){$feb=$row['amount'];}
    if($row['month'] == 3){$mar=$row['amount'];}
    if($row['month'] == 4){$apr=$row['amount'];}
    if($row['month'] == 5){$may=$row['amount'];}
    if($row['month'] == 6){$jun=$row['amount'];}
    if($row['month'] == 7){$jul=$row['amount'];}
    if($row['month'] == 8){$aug=$row['amount'];}
    if($row['month'] == 9){$sep=$row['amount'];}
    if($row['month'] == 10){$oct=$row['amount'];}
    if($row['month'] == 11){$nov=$row['amount'];}
    if($row['month'] == 12){$dec=$row['amount'];}
  }

    $total=$jan+$feb+$mar+$apr+$may+$jun+$jul+$aug+$sep+$oct+$nov+$dec;
  
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
  /*   Draw  Bar Chart */

        google.charts.load('current', {'packages':['bar']});
        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawBar);
        function drawBar() {
              $.ajax({
              type: 'POST',
              url: '<?php echo base_url();?>reportexpense/getGraph',
              success: function (data1) 
              {
              // Create our data table out of JSON data loaded from server.
                var data = new google.visualization.DataTable();
                        data.addColumn('string', 'expense');
                        data.addColumn('number', 'Expense');
                var jsonData = $.parseJSON(data1);
                for(var i in jsonData)
                {
                    data.addRow([jsonData[i].name, parseInt(jsonData[i].amount)]);
                }

                var options = {
                  chart: {
                    title: 'Expense Report',
                    subtitle: 'Show Expense of Company'
                  },
                  width: 900,
                  height: 500,
                  axes: {
                    x: {
                      0: {side: 'bottom'}
                    }
                  }
                  
                };
                var chart = new google.charts.Bar(document.getElementById('bar_chart'));
                chart.draw(data, options);
               }
           });
          }
</script>

<div class="content-wrapper">
<section class="content">
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
             <div class="top-bar-title padding-bottom"> <!-- Income Report --> <?php echo $this->lang->line('lbl_expensereport_expensereport');?></div>
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
                  <label class="col-sm-5 control-label" for="inputEmail3"> 
                  <!-- Year -->   
                  <?php echo $this->lang->line('lbl_incomereport_year');?></label>
                  
                  <div class="col-sm-2">
                         <select class="form-control select2" name="year" id="year">
                            <option value="">All</option>
                            <?php foreach ($year as $yr) {?>
                                <option value="<?php echo $yr;?>"><?php echo $yr;?></option>
                            <?php } ?>
                          </select>
                      </div>
                </div>
                <?php //if($yr == date('Y')){echo "selected";}?>
                </form>
                </div>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                
                <table id="expenseList" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">  <!-- Category  --><?php echo $this->lang->line('lbl_expensereport_expensereport');?></th>
                        <th class="text-center"> <!-- Jan -->  <?php echo $this->lang->line('lbl_expensereport_jan');?></th>
                        <th class="text-center"> <!-- Feb  --> <?php echo $this->lang->line('lbl_expensereport_feb');?></th>
                        <th class="text-center"> <!-- Mar -->  <?php echo $this->lang->line('lbl_expensereport_mar');?> </th>
                        <th class="text-center"> <!-- Apr -->   <?php echo $this->lang->line('lbl_expensereport_apr');?></th>
                        <th class="text-center"> <!-- May -->  <?php echo $this->lang->line('lbl_expensereport_may');?></th>
                        <th class="text-center"> <!-- Jun -->  <?php echo $this->lang->line('lbl_expensereport_jun');?></th>
                        <th class="text-center"> <!-- Jul -->  <?php echo $this->lang->line('lbl_expensereport_jul');?></th>
                        <th class="text-center"> <!-- Aug -->  <?php echo $this->lang->line('lbl_expensereport_aug');?></th>
                        <th class="text-center"> <!-- Sep -->  <?php echo $this->lang->line('lbl_expensereport_sep');?></th>
                        <th class="text-center"> <!-- Oct  --> <?php echo $this->lang->line('lbl_expensereport_oct');?></th>
                        <th class="text-center"> <!-- Nov -->  <?php echo $this->lang->line('lbl_expensereport_nov');?></th>
                        <th class="text-center"> <!-- Dec -->  <?php echo $this->lang->line('lbl_expensereport_dec');?></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($expense as $key => $value) {?>
                        <tr>
                            <td class="text-center"> <?php echo $value['name'];?></td>
                            <td class="text-center">
                              <?php if(isset($value['1'])){echo $value['1'];}else{echo "0";}?>
                            </td>
                            <td class="text-center"><?php if(isset($value['2'])){echo $value['2'];}else{echo "0";}?></td>
                            <td class="text-center"><?php if(isset($value['3'])){echo $value['3'];}else{echo "0";}?></td>
                            <td class="text-center"><?php if(isset($value['4'])){echo $value['4'];}else{echo "0";}?></td>
                            <td class="text-center"><?php if(isset($value['5'])){echo $value['5'];}else{echo "0";}?></td>
                            <td class="text-center"><?php if(isset($value['6'])){echo $value['6'];}else{echo "0";}?></td>
                            <td class="text-center"><?php if(isset($value['7'])){echo $value['7'];}else{echo "0";}?></td>
                            <td class="text-center"><?php if(isset($value['8'])){echo $value['8'];}else{echo "0";}?></td>
                            <td class="text-center"><?php if(isset($value['9'])){echo $value['9'];}else{echo "0";}?></td>
                            <td class="text-center"><?php if(isset($value['10'])){echo $value['10'];}else{echo "0";}?></td>
                            <td class="text-center"><?php if(isset($value['11'])){echo $value['11'];}else{echo "0";}?></td>
                            <td class="text-center"><?php if(isset($value['12'])){echo $value['12'];}else{echo "0";}?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                         <th class="text-center"> <!-- Sub Total -->  
                          <?php echo $this->lang->line('lbl_expensereport_subtotal');?></th>
                         <th class="text-center"><?php if(isset($jan)){echo $jan;}?></th>
                         <th class="text-center"><?php if(isset($feb)){echo $feb;}?></th>
                         <th class="text-center"><?php if(isset($mar)){echo $mar;}?></th>
                         <th class="text-center"><?php if(isset($apr)){echo $apr;}?></th>
                         <th class="text-center"><?php if(isset($may)){echo $may;}?></th>
                         <th class="text-center"><?php if(isset($jun)){echo $jun;}?></th>
                         <th class="text-center"><?php if(isset($jul)){echo $jul;}?></th>
                         <th class="text-center"><?php if(isset($aug)){echo $aug;}?></th>
                         <th class="text-center"><?php if(isset($sep)){echo $sep;}?></th>
                         <th class="text-center"><?php if(isset($oct)){echo $oct;}?></th>
                         <th class="text-center"><?php if(isset($nov)){echo $nov;}?></th>
                         <th class="text-center"><?php if(isset($dec)){echo $dec;}?></th>
                      </tr>
                    </tfoot>
                </table>

              </div>
              <div style="font-size: 18px; font-weight: bold; margin: 10px 0px;">
             <!--  Grand Total  -->  <?php echo $this->lang->line('lbl_expensereport_grandtotal');?> :<label id="grandtotal"> <?php echo $grandtotal->total;?></label>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->
      <div class="box">
           <div class="box-body">
              <div id="bar_chart" style="min-width: 300px; margin: 0 auto">
                
              </div>
            </div>
      </div>

    </section>
</div>

<?php 
  $this->load->view('layout/footer');
?> 

<script type="text/javascript">
 $(document).ready(function(){

    $("#year").change(function(){
      var year =$('#year').val();
      
      if(year==""){
              location.reload();
      }
      else{

        $.ajax({
          url:"<?php echo base_url(); ?>reportexpense/get_expense",
          method:"POST",
          data:{y:year},
          dataType : "json",
          success:function(response)
          {
              
              var table="";
              for (var i = 0; i < response['expense'].length; i++) 
              {
                  var jan = 0;
                  if(response['expense'][i].jan){
                    var jan = response['expense'][i].jan;
                  }

                  var feb = 0;
                  if(response['expense'][i].feb){
                    var feb = response['expense'][i].feb;
                  }

                  var mar = 0;
                  if(response['expense'][i].mar){
                    var mar = response['expense'][i].mar;
                  }

                  var apl = 0;
                  if(response['expense'][i].apl){
                    var apl = response['expense'][i].apl;
                  }

                  var may = 0;
                  if(response['expense'][i].may){
                    var may = response['expense'][i].may;
                  }

                  var jun = 0;
                  if(response['expense'][i].jun){
                    var jun = response['expense'][i].jun;
                  }

                  var july = 0;
                  if(response['expense'][i].july){
                    var july = response['expense'][i].july;
                  } 

                  var aug = 0;
                  if(response['expense'][i].aug){
                    var aug = response['expense'][i].aug;
                  }

                  var sept = 0;
                  if(response['expense'][i].sept){
                    var sept = response['expense'][i].sept;
                  }

                  var oct = 0;
                  if(response['expense'][i].oct){
                    var oct= response['expense'][i].oct;
                  }

                  var nov = 0;
                  if(response['expense'][i].nov){
                    var nov = response['expense'][i].nov;
                  }

                  var dec = 0;
                  if(response['expense'][i].dec){
                    var dec = response['expense'][i].dec;
                  }

                  table +='<tr>'+
                    '<td class="text-center">'+ response['expense'][i].name+ '</td>'+
                    '<td class="text-center">'+ jan +'</td>'+
                    '<td class="text-center">'+ feb +'</td>'+
                    '<td class="text-center">'+ mar +'</td>'+
                    '<td class="text-center">'+ apl +'</td>'+
                    '<td class="text-center">'+ may +'</td>'+
                    '<td class="text-center">'+ jun +'</td>'+
                    '<td class="text-center">'+ july +'</td>'+
                    '<td class="text-center">'+ aug +'</td>'+
                    '<td class="text-center">'+ sept +'</td>'+
                    '<td class="text-center">'+ oct +'</td>'+
                    '<td class="text-center">'+ nov +'</td>'+
                    '<td class="text-center">'+ dec +'</td>'+
                  '</tr>'; 
              }
              //alert(table);
              $('#expenseList tbody').html(table); 

              var table1="";
              var january = 0;
              var february = 0;
              var march = 0;
              var april = 0;
              var may = 0;
              var june = 0;
              var july = 0;
              var augest = 0;
              var september = 0;
              var october = 0;
              var november = 0;
              var december = 0;

              for (var i = 0; i < response['subtotal'].length; i++) 
              {
                  if(response['subtotal'][i].jan){
                    january = response['subtotal'][i].jan;
                  }

                  if(response['subtotal'][i].feb){
                    february = response['subtotal'][i].feb;
                  }

                  if(response['subtotal'][i].mar){
                    march = response['subtotal'][i].mar;
                  }

                  if(response['subtotal'][i].apl){
                    april = response['subtotal'][i].apl;
                  }

                  if(response['subtotal'][i].may){
                    may = response['subtotal'][i].may;
                  }

                  if(response['subtotal'][i].jun){
                    june = response['subtotal'][i].jun;
                  }

                  

                  if(response['subtotal'][i].july){
                    july = response['subtotal'][i].july;
                  }

                  if(response['subtotal'][i].aug){
                    augest = response['subtotal'][i].aug;
                  }

                  if(response['subtotal'][i].sept){
                    september = response['subtotal'][i].sept;
                  }

                  if(response['subtotal'][i].oct){
                    october = response['subtotal'][i].oct;
                  }

                  if(response['subtotal'][i].nov){
                    november = response['subtotal'][i].nov;
                  }

                  if(response['subtotal'][i].dec){
                    december = response['subtotal'][i].dec;
                  }
              }
              table1 ='<tr>'+
                    '<td class="text-center"> Sub Total</td>'+
                    '<td class="text-center">'+ january +'</td>'+
                    '<td class="text-center">'+ february +'</td>'+
                    '<td class="text-center">'+ march +'</td>'+
                    '<td class="text-center">'+ april +'</td>'+
                    '<td class="text-center">'+ may +'</td>'+
                    '<td class="text-center">'+ june +'</td>'+
                    '<td class="text-center">'+ july +'</td>'+
                    '<td class="text-center">'+ augest +'</td>'+
                    '<td class="text-center">'+ september +'</td>'+
                    '<td class="text-center">'+ october +'</td>'+
                    '<td class="text-center">'+ november +'</td>'+
                    '<td class="text-center">'+ december +'</td>'+
                  '</tr>'; 
            
              $('#expenseList tfoot').html(table1);
              var total = 0;

              if(response['grandtotal'].total){
                total =response['grandtotal'].total;
              }
             
              $('#grandtotal').html(total);
          }
        });
      }
    });
    
  });
</script>

