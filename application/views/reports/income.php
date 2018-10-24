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
    $total=$jan+$feb+$mar+$apr+$may+$jun+$jul+$aug+$sep+$oct+$nov+$dec;
  
 
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
      // Load the Visualization API and the line package.
      google.charts.load('current', {'packages':['bar']});
      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
  
    function drawChart() {
        $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>reports/get_data',
          
        success: function (data1) {
             var data = new google.visualization.DataTable();
  
            data.addColumn('string', 'Sales');
            data.addColumn('number', 'Sales Income');
            
              
            var jsonData = $.parseJSON(data1);

            data.addRow(["Sales",parseInt(jsonData[0].amount)]); 
  
            var options = { 
              chart: {
                title: 'Income Report'
              },
              width: 700,
              height: 00,
              axes: {
                x: {
                  0: {side: 'bottom'}
                }
              }
              
            };
            var chart = new google.charts.Bar(document.getElementById('bar_chart'));
            chart.draw(data,options);
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
             <div class="top-bar-title padding-bottom"> <!-- Income Report -->  <?php echo $this->lang->line('lbl_incomereport_incomereport');?></div>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center"> <!-- Category -->  <?php echo $this->lang->line('lbl_incomereport_category');?></th>
                    <th class="text-center"> <!-- Jan -->  <?php echo $this->lang->line('lbl_incomereport_jan');?></th>
                    <th class="text-center"><!--  Feb -->  <?php echo $this->lang->line('lbl_incomereport_feb');?></th>
                    <th class="text-center"> <!-- Mar -->  <?php echo $this->lang->line('lbl_incomereport_mar');?></th>
                    <th class="text-center"> <!-- Apr -->  <?php echo $this->lang->line('lbl_incomereport_apr');?></th>
                    <th class="text-center"> <!-- May -->  <?php echo $this->lang->line('lbl_incomereport_may');?></th>
                    <th class="text-center"> <!-- Jun -->  <?php echo $this->lang->line('lbl_incomereport_jun');?></th>
                    <th class="text-center"> <!-- Jul -->  <?php echo $this->lang->line('lbl_incomereport_jul');?></th>
                    <th class="text-center"><!--  Aug -->  <?php echo $this->lang->line('lbl_incomereport_aug');?></th>
                    <th class="text-center"> <!-- Sep -->  <?php echo $this->lang->line('lbl_incomereport_sep');?></th>
                    <th class="text-center"> <!-- Oct -->  <?php echo $this->lang->line('lbl_incomereport_oct');?></th>
                    <th class="text-center"> <!-- Nov -->  <?php echo $this->lang->line('lbl_incomereport_nov');?></th>
                    <th class="text-center"> <!--  Dec -->  <?php echo $this->lang->line('lbl_incomereport_dec');?></th>
                  </tr>
                  </thead>
                  <tbody id="income">
                      <tr>
                        <td class="text-center"> <!-- Sales  --> <?php echo $this->lang->line('sidebar_sales');?></td>
                        <td class="text-center"><?php if(isset($jan)){echo $jan;}else{echo "0";}?>
                        <td class="text-center"><?php if(isset($feb)){echo $feb;}else{echo "0";}?></td>
                        <td class="text-center"><?php if(isset($mar)){echo $mar;}else{echo "0";}?></td>
                        <td class="text-center"><?php if(isset($apr)){echo $apr;}else{echo "0";}?></td>
                        <td class="text-center"><?php if(isset($may)){echo $may;}else{echo "0";}?></td>
                        <td class="text-center"><?php if(isset($jun)){echo $jun;}else{echo "0";}?></td>
                        <td class="text-center"><?php if(isset($jul)){echo $jul;}else{echo "0";}?></td>
                        <td class="text-center"><?php if(isset($aug)){echo $aug;}else{echo "0";}?></td>
                        <td class="text-center"><?php if(isset($sep)){echo $sep;}else{echo "0";}?></td>
                        <td class="text-center"><?php if(isset($oct)){echo $oct;}else{echo "0";}?></td>
                        <td class="text-center"><?php if(isset($nov)){echo $nov;}else{echo "0";}?></td>
                        <td class="text-center"><?php if(isset($dec)){echo $dec;}else{echo "0";}?></td>
                    </tr>
                  </tbody>
                 
                </table>
              </div>
              <div style="font-size: 18px; font-weight: bold; margin: 10px 0px;">
             <!--  Grand Total  -->  <?php echo $this->lang->line('lbl_incomereport_grandtotal');?> : 
              <label id="grandID"> <?php echo $total;?></label>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->
      <div class="box">
           <div class="box-body">
              <div id="bar_chart" style="height: 400px; margin: 0 auto">
                
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
   
       $("#year").change(function(e)
       { 
          var year=$('#year').val();
          if(year==""){
              location.reload();
          }
          else{
            $.ajax({
               url:"<?php echo base_url();?>reports/income_filter",
               type:"POST",
               data:{
                
                year1:year,
                },
               dataType:"json", 
               success:function(response)
               {

                  $('#example1 tbody').html("");  

                  var jan = 0;
                  if(response.jan){
                    var jan = parseFloat(response.jan);
                  }

                  var feb = 0;
                  if(response.feb){
                    var feb = parseFloat(response.feb);
                  }

                  var mar = 0;
                  if(response.mar){
                    var mar = parseFloat(response.mar);
                  }

                  var apl = 0;
                  if(response.apl){
                    var apl = parseFloat(response.apl);
                  }

                  var may = 0;
                  if(response.may){
                    var may = parseFloat(response.may);
                  }

                  var jun = 0;
                  if(response.jun){
                    var jun = parseFloat(response.jun);
                  }

                  var july = 0;
                  if(response.july){
                    var july = parseFloat(response.july);
                  } 

                  var aug = 0;
                  if(response.aug){
                    var aug = parseFloat(response.aug);
                  }

                  var sept = 0;
                  if(response.sept){
                    var sept = parseFloat(response.sept);
                  }

                  var oct = 0;
                  if(response.oct){
                    var oct= parseFloat(response.oct);
                  }

                  var nov = 0;
                  if(response.nov){
                    var nov = parseFloat(response.nov);
                  }

                  var dec = 0;
                  if(response.dec){
                    var dec = parseFloat(response.dec);
                  }

                  var total = jan + feb + mar + apl + may + jun + july + aug + sept + oct + nov + dec;

                  var table = '<tr>'+
                    '<td class="text-center"> Sales</td>'+
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
                  
                  $('#example1 tbody').html(table); 
                  $('#grandID').html(total);
               }
            });
          }
          e.preventDefault();
       });
    });
</script>  