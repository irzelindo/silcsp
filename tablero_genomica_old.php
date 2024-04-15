<?php
@Header("Content-type: text/html; charset=UTF-8");
session_start();

include("conexion.php");
$link=Conectarse();

$nomyape=$_SESSION["nomyape"];
$codusu=$_SESSION['codusu'];

$query = "select *
from usuarios u
where u.codusu = '$codusu'";

$result = pg_query($link,$query);

$row = pg_fetch_assoc($result);

$elusuario=$nomyape;

$desde = date("Y-m-d", time());
$hasta = date("Y-m-d", time());

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="favicon.ico"/>

  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">

      <span class="brand-text font-weight-light">Filtros</span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link active" style="background-color: blue;color: white;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Region Sanitaria</p>
                </a>
              </li>

            <select name="codservicio" size="1" id="codservicio" onchange="gridReload()" style="width: 99%;">
             <option value=""></option>
				<?php

					$tabla_dpto = pg_query($link, "select * from establecimientos order by codservicio");
					while($depto = pg_fetch_array($tabla_dpto))
					{
					   if($depto['codservicio'] == $codservicio)
					   {
						  echo "<option value = ".$depto['codservicio']." selected>".$depto['nomservicio']."</option>";


					   }
					   else
					   {
						   echo "<option value = ".$depto['codservicio'].">".$depto['nomservicio']."</option>";
					   }
					}
				?>
            </select>

              <li class="nav-item has-treeview menu-open">
                <a class="nav-link active" style="background-color: blue;color: white;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Desde</p>
                </a>
              </li>
              <input type="date" id="desde" name="desde" value="<?php echo $desde; ?>" spellcheck="false" onBlur="gridReload()" style="width: 98%;">
              <li class="nav-item">
                <a class="nav-link active" style="background-color: blue;color: white;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hasta</p>
                </a>
              </li>
              <input type="date" id="hasta" name="hasta" value="<?php echo $hasta; ?>" spellcheck="false" onBlur="gridReload()" style="width: 98%;">
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

<h1 style="text-align: center">  VIGILANCIA GENOMICA PARAGUAY - SARS-CoV-19 (COVID-19) </h1>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <br>

        
		  
		<div class="row">

		<!-- BAR CHART -->
            <div class="card card-success" style="width: 200%;">
              <div class="card-header">
                <h3 class="card-title">Distribución  de Variantes</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart2">
                  <canvas id="pieChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
			
        </div>
		  
		<div class="row">

            <div class="card card-cyan" style="width: 200%;">
              <div class="card-header">
                <h3 class="card-title">Cantidad de Estudios de Vigilancia Genómica por Mes</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart3">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
			
        </div>
		  
		<div class="row">

            <div class="card card-maroon" style="width: 200%;">
              <div class="card-header">
                <h3 class="card-title">Cantidad de Variantes por Mes</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart4">
                  <canvas id="barChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
			
        </div>
		  
		<div class="row">

            <div class="card card-gray" style="width: 200%;">
              <div class="card-header">
                <h3 class="card-title">Cantidad de Ordenes por Mes - Variante</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart5">
                  <canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
			
        </div>
		  
		<div class="row">

            <div class="card card-olive" style="width: 200%;">
              <div class="card-header">
                <h3 class="card-title">Cantidad de Ordenes por Variantes</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart6">
                  <canvas id="barChart3" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
			
        </div>
		  
		
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="js/Chart.min.js"></script>

<script src="js/plugin.js"></script>
	
<script src="js/adminlte.min.js"></script>
	
<script>



function gridReload()
{
      var codservicio = jQuery("#codservicio").val();
      var hasta	      = jQuery("#hasta").val();
      var desde  	  = jQuery("#desde").val();


      $.ajax({
              url: "datostablerogenomica.php?tipo=1&desde="+desde+"&hasta="+hasta+"&codservicio="+codservicio,
              type: "POST",
              dataType: 'json',
              success:function(data){

                    var codservicior = [];
                    var cantidad = [];

                    console.log(data);

                    for(var i in data) {
                      codservicior.push(data[i].codservicior);
                      cantidad.push(data[i].cantidad);

                    }


				    $("canvas#pieChart").remove();
			
					$("div.chart1").append('<canvas id="pieChart" style="min-height: 250px; height: 530px; max-height: 100%; max-width: 100%;"></canvas>');
				  
					var pieChartCanvas = $('#pieChart').get(0).getContext('2d')

					var Data        = {
                      labels: codservicior,
                      datasets: [{
                          label: codservicior,
                          backgroundColor: [
								  'rgba(255, 99, 132, 0.2)',
								  'rgba(255, 159, 64, 0.2)',
								  'rgba(255, 205, 86, 0.2)',
								  'rgba(75, 192, 192, 0.2)',
								  'rgba(54, 162, 235, 0.2)',
								  'rgba(153, 102, 255, 0.2)',
								  'rgba(201, 203, 207, 0.2)',
								  'rgba(56,64,18,0.2)',
								  'rgba(56,110,231,0.2)',
								  'rgba(221,225,101,0.2)'
								],
						  borderColor: [
								  'rgb(255, 99, 132)',
								  'rgb(255, 159, 64)',
								  'rgb(255, 205, 86)',
								  'rgb(75, 192, 192)',
								  'rgb(54, 162, 235)',
								  'rgb(153, 102, 255)',
								  'rgb(201, 203, 207)',
								  'rgb(56,64,18)',
								  'rgb(56,110,231)',
								  'rgb(221,225,101)'
								],

                          borderWidth: 2,
                          hoverBackgroundColor: [
								  'rgb(255, 99, 132)',
								  'rgb(255, 159, 64)',
								  'rgb(255, 205, 86)',
								  'rgb(75, 192, 192)',
								  'rgb(54, 162, 235)',
								  'rgb(153, 102, 255)',
								  'rgb(201, 203, 207)',
								  'rgb(56,64,18)',
								  'rgb(56,110,231)',
								  'rgb(221,225,101)'
								],
                          hoverBorderColor: [
								  'rgb(255, 99, 132)',
								  'rgb(255, 159, 64)',
								  'rgb(255, 205, 86)',
								  'rgb(75, 192, 192)',
								  'rgb(54, 162, 235)',
								  'rgb(153, 102, 255)',
								  'rgb(201, 203, 207)',
								  'rgb(56,64,18)',
								  'rgb(56,110,231)',
								  'rgb(221,225,101)'
								],
                          data: cantidad
                      }]
                    }

					var pieData  = Data;
					var pieOptions = {
										responsive : true,
										legend: {
											  display: true,
											  position: 'left',
											  align:'start',
											  fontSize: 8
										},
										plugins:{
											tooltip:{
												enabled: false
											},
											datalabels:{
												color: 'black',
												formatter: function(value, context){
													const datapoints = context.chart.data.datasets[0].data;
													
													function totalSum(total, datapoint){
														return Number(total) + Number(datapoint);
													}
													const totalValue = datapoints.reduce(totalSum, 0);
													const percentageValue = (value / totalValue * 100).toFixed(0);
													
													console.log(totalValue)
													
													return `${percentageValue}%`;
													
												},
												font: {
												  weight: 'bold',
												  size: 16,
												}
											}
										}
								    }
								    //Create pie or douhnut chart
								    // You can switch between pie and douhnut using the method below.
					var pieChart = new Chart(pieChartCanvas, {
								      type: 'pie',
								      data: pieData,
								      options: pieOptions,
									  plugins: [ChartDataLabels]
								    })

           },
           error: function(data) {
                    console.log(data);
           }


    });
	
	  $.ajax({
              url: "datostablerogenomica.php?tipo=2&desde="+desde+"&hasta="+hasta+"&codservicio="+codservicio,
              type: "POST",
              dataType: 'json',
              success:function(data){

                    var codservicior = [];
                    var cantidad = [];

                    console.log(data);

                    for(var i in data) {
                      codservicior.push(data[i].codservicior);
                      cantidad.push(data[i].cantidad);

                    }

				    $("canvas#pieChart1").remove();
			
					$("div.chart2").append('<canvas id="pieChart1" style="min-height: 250px; height: 530px; max-height: 100%; max-width: 100%;"></canvas>');
	
					var pieChartCanvas = $('#pieChart1').get(0).getContext('2d');

					var Data        = {
                      labels: codservicior,
                      datasets: [{
                          label: codservicior,
                          backgroundColor: [
								  'rgba(255, 99, 132, 0.2)',
								  'rgba(255, 159, 64, 0.2)',
								  'rgba(255, 205, 86, 0.2)',
								  'rgba(75, 192, 192, 0.2)',
								  'rgba(54, 162, 235, 0.2)',
								  'rgba(153, 102, 255, 0.2)',
								  'rgba(201, 203, 207, 0.2)',
								  'rgba(56,64,18,0.2)',
								  'rgba(56,110,231,0.2)',
								  'rgba(221,225,101,0.2)'
								],
						  borderColor: [
								  'rgb(255, 99, 132)',
								  'rgb(255, 159, 64)',
								  'rgb(255, 205, 86)',
								  'rgb(75, 192, 192)',
								  'rgb(54, 162, 235)',
								  'rgb(153, 102, 255)',
								  'rgb(201, 203, 207)',
								  'rgb(56,64,18)',
								  'rgb(56,110,231)',
								  'rgb(221,225,101)'
								],
                          borderWidth: 2,
                          hoverBackgroundColor: [
								  'rgb(255, 99, 132)',
								  'rgb(255, 159, 64)',
								  'rgb(255, 205, 86)',
								  'rgb(75, 192, 192)',
								  'rgb(54, 162, 235)',
								  'rgb(153, 102, 255)',
								  'rgb(201, 203, 207)',
								  'rgb(56,64,18)',
								  'rgb(56,110,231)',
								  'rgb(221,225,101)'
								],
                          hoverBorderColor: [
								  'rgb(255, 99, 132)',
								  'rgb(255, 159, 64)',
								  'rgb(255, 205, 86)',
								  'rgb(75, 192, 192)',
								  'rgb(54, 162, 235)',
								  'rgb(153, 102, 255)',
								  'rgb(201, 203, 207)',
								  'rgb(56,64,18)',
								  'rgb(56,110,231)',
								  'rgb(221,225,101)'
								],
                          data: cantidad
                      }]
                    }
					
					

					var pieData  = Data;
					var pieOptions = {
										maintainAspectRatio : false,
										responsive : true,
										legend: {
											  display: true,
											  position: 'right'
										},
										plugins:{
											tooltip:{
												enabled: false
											},
											datalabels:{
												color: 'black',
												formatter: function(value, context){
													const datapoints = context.chart.data.datasets[0].data;
													
													function totalSum(total, datapoint){
														return Number(total) + Number(datapoint);
													}
													const totalValue = datapoints.reduce(totalSum, 0);
													const percentageValue = (value / totalValue * 100).toFixed(0);
													
													console.log(totalValue)
													
													return `${percentageValue}%`;
													
												},
												font: {
												  weight: 'bold',
												  size: 16,
												}
											}
										},
										animation: {
											animateScale: true,
											animateRotate: true
										}
									}
			
					var pieChart = new Chart(pieChartCanvas, {
								      type: 'pie',
								      data: pieData,
								      options: pieOptions,
									  plugins: [ChartDataLabels]
								    })

           },
           error: function(data) {
                    console.log(data);
           }


    });
	  
	  $.ajax({
				  url: "datostablerogenomica.php?tipo=3&desde="+desde+"&hasta="+hasta+"&codservicio="+codservicio,
				  type: "POST",
				  dataType: 'json',
				  success:function(data){

                    var anio = [];
					  
					var color = ['rgba(255, 99, 132, 0.2)',
								  'rgba(255, 159, 64, 0.2)',
								  'rgba(255, 205, 86, 0.2)',
								  'rgba(75, 192, 192, 0.2)',
								  'rgba(54, 162, 235, 0.2)',
								  'rgba(153, 102, 255, 0.2)',
								  'rgba(201, 203, 207, 0.2)',
								  'rgba(56,64,18,0.2)',
								  'rgba(56,110,231,0.2)',
								  'rgba(221,225,101,0.2)'];
                    var bordercolor =  ['rgb(255, 99, 132)',
								  'rgb(255, 159, 64)',
								  'rgb(255, 205, 86)',
								  'rgb(75, 192, 192)',
								  'rgb(54, 162, 235)',
								  'rgb(153, 102, 255)',
								  'rgb(201, 203, 207)',
								  'rgb(56,64,18)',
								  'rgb(56,110,231)',
								  'rgb(221,225,101)'];

                    console.log(data);

                    for(var i in data) {
                      anio.push(i);

                    }

					  $("canvas#barChart").remove();
					  $("div.chart3").append('<canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>');

					  var barChartCanvas = $('#barChart').get(0).getContext('2d');
					  
					  var barChart = new Chart(barChartCanvas, {
							type: 'bar',
							data: {
							  labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre', 'Noviembre', 'Diciembre'],
								  datasets: []
								},
						    options: {
								legend: {
											  display: true,
											  position: 'right'
										},
								plugins:{
											tooltip:{
												enabled: false
											},
											datalabels:{
												color: 'black',
												formatter: function(value, context){
													const datapoints = context.chart.data.datasets[0].data;
													
													function totalSum(total, datapoint){
														return Number(total) + Number(datapoint);
													}
													const totalValue = datapoints.reduce(totalSum, 0);
													const percentageValue = (value / totalValue * 100).toFixed(0);
													
													console.log(totalValue)
													
													return value;
													
												},
												font: {
												  weight: 'bold',
												  size: 16,
												}
											}
										}
							},
						  	plugins: [ChartDataLabels]
					  });
					  

					  var j = 0;

					  for(var i in data)
					  {

						  addData(barChart, i, color[j], bordercolor[j], [ data[i].Enero, data[i].Febrero, data[i].Marzo, data[i].Abril, data[i].Mayo, data[i].Junio, data[i].Julio, data[i].Agosto, data[i].Setiembre, data[i].Octubre, data[i].Noviembre, data[i].Diciembre ]);

						  j = j +1;

					  }

					  function addData(chart, label, color, bordercolor, data) 
					  {
								chart.data.datasets.push({
								label: label,
							  	backgroundColor: color,
						  		borderColor: bordercolor,
								hoverBackgroundColor: bordercolor,
                          		hoverBorderColor: bordercolor,
							    data: data
							});
							chart.update();
						}

           },
			   error: function(data) {
						console.log(data);
			   }


		});
	
	  $.ajax({
				  url: "datostablerogenomica.php?tipo=4&desde="+desde+"&hasta="+hasta+"&codservicio="+codservicio,
				  type: "POST",
				  dataType: 'json',
				  success:function(data){

                    var codservicior = [];
					  
					var color = ['rgba(255, 99, 132, 0.2)',
								  
								  'rgba(255, 205, 86, 0.2)',
								  'rgba(75, 192, 192, 0.2)',
								  'rgba(54, 162, 235, 0.2)',
								  'rgba(153, 102, 255, 0.2)',
								  'rgba(201, 203, 207, 0.2)',
								  'rgba(56,64,18,0.2)',
								  'rgba(56,110,231,0.2)',
								  'rgba(255, 159, 64, 0.2)',
								  'rgba(221,225,101,0.2)'];
                    var bordercolor =  ['rgb(255, 99, 132)',
								  'rgb(255, 159, 64)',
								
								  'rgb(75, 192, 192)',
								  'rgb(54, 162, 235)',
								  'rgb(153, 102, 255)',
								  'rgb(201, 203, 207)',
								  'rgb(56,64,18)',
								  'rgb(56,110,231)',
								    'rgb(255, 205, 86)',
								  'rgb(221,225,101)'];

                    console.log(data);

                    for(var i in data) {
                      codservicior.push(i);

                    }

					  $("canvas#barChart1").remove();
					  $("div.chart4").append('<canvas id="barChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>');

					  var barChartCanvas = $('#barChart1').get(0).getContext('2d');
					  
					  var barChart = new Chart(barChartCanvas, {
							type: 'bar',
							data: {
							  labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre', 'Noviembre', 'Diciembre'],
								  datasets: []
								},
						    options: {
								legend: {
											  display: true,
											  position: 'right'
										},
								plugins:{
											tooltip:{
												enabled: false
											},
											datalabels:{
												color: 'black',
												formatter: function(value, context){
													const datapoints = context.chart.data.datasets[0].data;
													
													function totalSum(total, datapoint){
														return Number(total) + Number(datapoint);
													}
													const totalValue = datapoints.reduce(totalSum, 0);
													const percentageValue = (value / totalValue * 100).toFixed(0);
													
													console.log(totalValue)
													
													return value;
													
												},
												font: {
												  weight: 'bold',
												  size: 16,
												}
											}
										}
							},
						  	plugins: [ChartDataLabels]
					  });
					  

					  var j = 0;

					  for(var i in data)
					  {

						  addData(barChart, i, color[j], bordercolor[j], [ data[i].Enero, data[i].Febrero, data[i].Marzo, data[i].Abril, data[i].Mayo, data[i].Junio, data[i].Julio, data[i].Agosto, data[i].Setiembre, data[i].Octubre, data[i].Noviembre, data[i].Diciembre ]);

						  j = j +1;

					  }

					  function addData(chart, label, color, bordercolor, data) 
					  {
								chart.data.datasets.push({
								label: label,
							  	backgroundColor: color,
						  		borderColor: bordercolor,
								hoverBackgroundColor: bordercolor,
                          		hoverBorderColor: bordercolor,
							    data: data
							});
							chart.update();
						}

           },
			   error: function(data) {
						console.log(data);
			   }


		});
	
	  $.ajax({
				  url: "datostablerogenomica.php?tipo=5&desde="+desde+"&hasta="+hasta+"&codservicio="+codservicio,
				  type: "POST",
				  dataType: 'json',
				  success:function(data){

                    var codservicior = [];
					  
					var color = ['rgba(255, 99, 132, 0.2)',
								  
								  'rgba(255, 205, 86, 0.2)',
								  'rgba(75, 192, 192, 0.2)',
								  'rgba(54, 162, 235, 0.2)',
								  'rgba(153, 102, 255, 0.2)',
								  'rgba(201, 203, 207, 0.2)',
								  'rgba(56,64,18,0.2)',
								  'rgba(56,110,231,0.2)',
								  'rgba(255, 159, 64, 0.2)',
								  'rgba(221,225,101,0.2)'];
                    var bordercolor =  ['rgb(255, 99, 132)',
								  'rgb(255, 159, 64)',
								
								  'rgb(75, 192, 192)',
								  'rgb(54, 162, 235)',
								  'rgb(153, 102, 255)',
								  'rgb(201, 203, 207)',
								  'rgb(56,64,18)',
								  'rgb(56,110,231)',
								    'rgb(255, 205, 86)',
								  'rgb(221,225,101)'];

                    console.log(data);

                    for(var i in data) {
                      codservicior.push(i);

                    }

					  $("canvas#barChart2").remove();
					  $("div.chart5").append('<canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>');

					  var barChartCanvas = $('#barChart2').get(0).getContext('2d');
					  
					  var barChart = new Chart(barChartCanvas, {
							type: 'bar',
							data: {
							  labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre', 'Noviembre', 'Diciembre'],
								  datasets: []
								},
						    options: {
								legend: {
											  display: true,
											  position: 'right'
										},
								plugins:{
											tooltip:{
												enabled: false
											},
											datalabels:{
												color: 'black',
												formatter: function(value, context){
													const datapoints = context.chart.data.datasets[0].data;
													
													function totalSum(total, datapoint){
														return Number(total) + Number(datapoint);
													}
													const totalValue = datapoints.reduce(totalSum, 0);
													const percentageValue = (value / totalValue * 100).toFixed(0);
													
													console.log(totalValue)
													
													return value;
													
												},
												font: {
												  weight: 'bold',
												  size: 16,
												}
											}
										},
								responsive: true,
								scaleStartValue:0,
								scales: {
								  x: {
									stacked: true,
								  },
								  y: {
									stacked: false
								  }
								}
							},
						  	plugins: [ChartDataLabels]
					  });
					  

					  var j = 0;

					  for(var i in data)
					  {

						  addData(barChart, i, color[j], bordercolor[j], [ data[i].Enero, data[i].Febrero, data[i].Marzo, data[i].Abril, data[i].Mayo, data[i].Junio, data[i].Julio, data[i].Agosto, data[i].Setiembre, data[i].Octubre, data[i].Noviembre, data[i].Diciembre ]);

						  j = j +1;

					  }

					  function addData(chart, label, color, bordercolor, data) 
					  {
								chart.data.datasets.push({
								label: label,
							  	backgroundColor: color,
						  		borderColor: bordercolor,
								hoverBackgroundColor: bordercolor,
                          		hoverBorderColor: bordercolor,
							    data: data
							});
							chart.update();
						}

           },
			   error: function(data) {
						console.log(data);
			   }


		});
	
	  $.ajax({
				  url: "datostablerogenomica.php?tipo=6&desde="+desde+"&hasta="+hasta+"&codservicio="+codservicio,
				  type: "POST",
				  dataType: 'json',
				  success:function(data){

                    var codservicior = [];
					  
					var color = ['rgba(255, 99, 132, 0.2)',
								  
								  'rgba(255, 205, 86, 0.2)',
								  'rgba(75, 192, 192, 0.2)',
								  'rgba(54, 162, 235, 0.2)',
								  'rgba(153, 102, 255, 0.2)',
								  'rgba(201, 203, 207, 0.2)',
								  'rgba(56,64,18,0.2)',
								  'rgba(56,110,231,0.2)',
								  'rgba(255, 159, 64, 0.2)',
								  'rgba(221,225,101,0.2)'];
                    var bordercolor =  ['rgb(255, 99, 132)',
								  'rgb(255, 159, 64)',
								
								  'rgb(75, 192, 192)',
								  'rgb(54, 162, 235)',
								  'rgb(153, 102, 255)',
								  'rgb(201, 203, 207)',
								  'rgb(56,64,18)',
								  'rgb(56,110,231)',
								    'rgb(255, 205, 86)',
								  'rgb(221,225,101)'];

                    console.log(data);

                    for(var i in data) {
                      codservicior.push(i);

                    }

					  $("canvas#barChart3").remove();
					  $("div.chart6").append('<canvas id="barChart3" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>');

					  var barChartCanvas = $('#barChart3').get(0).getContext('2d');
					  
					  var barChart = new Chart(barChartCanvas, {
							type: 'line',
							data: {
							  labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre', 'Noviembre', 'Diciembre'],
								  datasets: []
								},
						    
						    options: {
								legend: {
											  display: true,
											  position: 'right'
										},
								
							
								responsive: true,
      							maintainAspectRatio: false
							}
					  });
					  

					  var j = 0;

					  for(var i in data)
					  {

						  addData(barChart, i, color[j], bordercolor[j], [ data[i].Enero, data[i].Febrero, data[i].Marzo, data[i].Abril, data[i].Mayo, data[i].Junio, data[i].Julio, data[i].Agosto, data[i].Setiembre, data[i].Octubre, data[i].Noviembre, data[i].Diciembre ]);

						  j = j +1;

					  }

					  function addData(chart, label, color, bordercolor, data) 
					  {
								chart.data.datasets.push({
								label: label,
							  	backgroundColor: color,
						  		borderColor: bordercolor,
								hoverBackgroundColor: bordercolor,
                          		hoverBorderColor: bordercolor,
							    data: data,
								fill: true
							});
							chart.update();
						}

           },
			   error: function(data) {
						console.log(data);
			   }


		});
	<div class="row">

            <!-- DONUT CHART -->
            <div class="card card-danger" style="width: 200%;">
              <div class="card-header">
                <h3 class="card-title">Cantidad de Ordenes Enviadas para Vigilancia Genómica por Region Sanitaria</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                
				<div class="chart1">
                  <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
			
        </div>

}
</script>
</body>
</html>
