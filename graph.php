<!DOCTYPE html>
<html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport"content="width-device=width,initial-scale=1.0">
      <title>
        Report
      </title>
      <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->

 
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">


   </head>
            <nav class="navbar navbar-default">
      <div class="container-fluid">
       
       
      </div>
    </nav>
<!--- NAV-->
  <body>

<!-- Content Wrapper. Contains page content -->
      <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Inventory monitoring
            
          </h1>
         
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- AREA CHART -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Products</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="survey1" style="height:auto;border:solid;"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- DONUT CHART -->
             
            </div><!-- /.col (LEFT) -->
         </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="../../plugins/chartjs/Chart.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- page script -->
    <?php
      include_once "conn.php"; 
     $query = "SELECT * FROM customer";
      $query = mysql_query($query) or die (mysql_error());
      while($row = mysql_fetch_array($query))
     {
       $studentid = $row['customer_num'];
     }

    ?>
    <script>
  
      $(function () {
      
      //-------------
        //- survey1 -
        //-------------
        var barChartCanvas = $("#survey1").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
         var areaChartData = {
          labels: ["Low tuition fee", "Accessible and easy to find"],
          datasets: [
          
            {
             
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data:<?php        
                    echo "[";
                    for($i=1;$i<=2;$i++){   
                      include_once "conn.php";                                                
                      $query = "SELECT * FROM customer where customer_num=".$i."";
                      $query = mysql_query($query) or die (mysql_error());      
                      while($row = mysql_fetch_array($query))
                     {
                                                 
                      $survey1 = $row['customer_num']/$studentid;
                       echo json_encode($survey1);           
                     }
                     if($i!=2){ 
                      echo ",";
                     }
                    }
                      echo "]";
                 ?>
            }
          ]
        };
        var barChartData = areaChartData;

        barChartData.datasets[0].fillColor = "#20265a";
        barChartData.datasets[0].strokeColor = "#20265a";
        barChartData.datasets[0].pointColor = "#20265a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          scaleFontSize: 17,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
        //-------------
        //- survey2 -
        //-------------
        var barChartCanvas = $("#survey2").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
         var areaChartData = {
          labels: ["help family", "land a good job", "help others", "become a professional", "Augment family income", "Prepare for marriage", "Comply with fiancee demand","develop skills-talents & personal growth","others"],
          datasets: [
          
            {
             
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data:<?php        
                    echo "[";
                    for($i=1;$i<=9;$i++){                                                   
                      $query = "SELECT * FROM survey2 where id=".$i."";
                      $query = mysql_query($query);      
                      while($row = mysql_fetch_array($query))
                     {
                                                         
                      $survey1 = $row['value']/$studentid;
                       echo json_encode($survey1);           
                     }
                     if($i!=9){ 
                      echo ",";
                     }
                    }
                      echo "]";
                 ?>
            }
          ]
        };
        var barChartData = areaChartData;

        barChartData.datasets[0].fillColor = "#00a65a";
        barChartData.datasets[0].strokeColor = "#00a65a";
        barChartData.datasets[0].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          scaleFontSize: 17,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
        //-------------
        //- survey3 -
        //-------------
        var barChartCanvas = $("#survey3").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
         var areaChartData = {
          labels: ["change of residence","Family conflict","loss of interest","lack of financial support","Poor health / physical disabilities","do not like the teachers in school","conflict with work schedules","Others"],
          datasets: [
          
            {
             
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data:<?php        
                    echo "[";
                    for($i=1;$i<=8;$i++){                                                   
                      $query = "SELECT * FROM survey3 where id=".$i."";
                      $query = mysql_query($query);      
                      while($row = mysql_fetch_array($query))
                     {
                                                         
                      $survey1 = $row['value']/$studentid;
                       echo json_encode($survey1);           
                     }
                     if($i!=8){ 
                      echo ",";
                     }
                    }
                      echo "]";
                 ?>
            }
          ]
        };
        var barChartData = areaChartData;

        barChartData.datasets[0].fillColor = "#892900";
        barChartData.datasets[0].strokeColor = "#892900";
        barChartData.datasets[0].pointColor = "#892900";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          scaleFontSize: 17,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
        //-------------
        //- survey4 -
        //-------------
        var barChartCanvas = $("#survey4").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
         var areaChartData = {
          labels: ["On-line Enrollment","make UC a WiFi zone","check­ payables through mobile access","pay tuition through banks / money transfer","check grades through mobile phone access","receive information and announcements related to school through text messaging","Post concerns / comments / complaints to concerned personnel in the UC website","Others"],
          datasets: [
          
            {
             
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data:<?php        
                    echo "[";
                    for($i=1;$i<=8;$i++){                                                   
                      $query = "SELECT * FROM survey4 where id=".$i."";
                      $query = mysql_query($query);      
                      while($row = mysql_fetch_array($query))
                     {
                                                         
                      $survey1 = $row['value']/$studentid;
                       echo json_encode($survey1);           
                     }
                     if($i!=8){ 
                      echo ",";
                     }
                    }
                      echo "]";
                 ?>
            }
          ]
        };
        var barChartData = areaChartData;

        barChartData.datasets[0].fillColor = "#FF9900";
        barChartData.datasets[0].strokeColor = "#FF9900";
        barChartData.datasets[0].pointColor = "#FF9900";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          scaleFontSize: 17,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
           
           //-------------
        //- survey4 -
        //-------------
        var barChartCanvas = $("#survey5").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
         var areaChartData = {
          labels: ["Through email","Through facebook","Through radio broadcast"," Through magazines or tabloid","through mobile phone messaging","through twitter","through newspaper","Others"],
          datasets: [
          
            {
             
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data:<?php        
                    echo "[";
                    for($i=1;$i<=8;$i++){                                                   
                      $query = "SELECT * FROM survey5 where id=".$i."";
                      $query = mysql_query($query);      
                      while($row = mysql_fetch_array($query))
                     {
                                                         
                      $survey1 = $row['value']/$studentid;
                       echo json_encode($survey1);           
                     }
                     if($i!=8){ 
                      echo ",";
                     }
                    }
                      echo "]";
                 ?>
            }
          ]
        };
        var barChartData = areaChartData;

        barChartData.datasets[0].fillColor = "#9900FF";
        barChartData.datasets[0].strokeColor = "#9900FF";
        barChartData.datasets[0].pointColor = "#9900FF";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          scaleFontSize: 17,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
           
      });
    </script>
  </body>
</html>
