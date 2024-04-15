<?php
@Header("Content-type: text/html; charset=iso-8859-1");
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

$query = "select count(*) as cantidad
          from ordtrabajo t
          where extract(year from t.fecharec) = extract(year from now())";
$result = pg_query($link,$query);

$row = pg_fetch_assoc($result);

$cantorden = $row["cantidad"];

$query1 = "select count(*) as cantidad
          from ordtrabajo t
          where to_char(t.fecharec, 'ddmmyyyy')  = to_char(now(), 'ddmmyyyy')";
$result1 = pg_query($link,$query1);

$row1 = pg_fetch_assoc($result1);

$cantordend = $row1["cantidad"];

$query2 = "select  count(e.codestudio) as cantidad
            from ordtrabajo t, estrealizar e
            where t.nordentra = e.nordentra
            and   extract(year from t.fecharec) = extract(year from now())";
$result2 = pg_query($link,$query2);

$row2 = pg_fetch_assoc($result2);

$cantestu = $row2["cantidad"];

$query3 = "select  count(e.codestudio) as cantidad
            from ordtrabajo t, estrealizar e
            where t.nordentra = e.nordentra
            and   to_char(t.fecharec, 'ddmmyyyy')  = to_char(now(), 'ddmmyyyy')";
$result3 = pg_query($link,$query3);

$row3 = pg_fetch_assoc($result3);

$cantestud = $row3["cantidad"];

$desde = date("Y-m-d", time());
$hasta = date("Y-m-d", time());


if($_SESSION['usuario'] != "SI")
{
	header("Location: index.php");
}
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

  <script type = "text/javascript">
      $(function() {
           $.ajax({
              type: 'POST',
              dataType: "json",
  						crossDomain: true,
              url: 'http://dgvs.mspbs.gov.py/sistemas/itdgvsops/dataserver/ajax/actualizar/v_laboratorios',
              data:{},
           }).done(function(data) {
              if ( data.respuesta.length > 0 ) {
                  $("#laboratorio").html("<option value=''></option>");
                  for (var i = 0; i < data.respuesta.length; i++) {
                    $("select#laboratorio").append( $("<option />").val( data.respuesta[i]["Id"] ).text( data.respuesta[i]["Laboratorio"]) );
                  }
              }else{
                 $.alert({title: 'LABORATORIOS...',content: "No se ha encontrado ningun datos de laboratorios..." });
              }
           })
           .fail(function() {
              // waitingDialog.hide();
           }).always(function(){});
      });

  </script>


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
                  <p>laboratorios</p>
                </a>
              </li>

            <select name="laboratorio" size="1" id="laboratorio" onchange="gridReload()">
              <option value=""></option>
            </select>

              <li class="nav-item has-treeview menu-open">
                <a class="nav-link active" style="background-color: blue;color: white;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Desde</p>
                </a>
              </li>
              <input type="date" id="desde" name="desde" value="<?php echo $desde; ?>" spellcheck="false" onchange="gridReload()">
              <li class="nav-item">
                <a class="nav-link active" style="background-color: blue;color: white;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hasta</p>
                </a>
              </li>
              <input type="date" id="hasta" name="hasta" value="<?php echo $hasta; ?>" spellcheck="false" onchange="gridReload()">
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <br>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $cantordend; ?></h3>

                <p>Ordenes del D&iacute;a</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $cantestud; ?></h3>

                <p>Resultados del D&iacute;a</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="cantidadorden">0</h3>

                <p>Cantidad Ordenes</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="cantidadresultado">0</h3>

                <p>Cantidad Resultados</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="row">
          <div class="col-md-6">

            <!-- DONUT CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Cantidad Ordenes del dia</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- PIE CHART -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Top 10 Cantidad Estudios</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart3">
                  <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- BAR CHART -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Cantidad Ordenes Semana</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart5">
                  <canvas id="barChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">

						<!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Cantidad Ordenes por Estados</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart2">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- BAR CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Cantidad Ordenes Mesual A&ntilde;o Actual</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart4">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- STACKED BAR CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Cantidad Ordenes Entidad Derivante</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart6">
                  <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
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

<!-- page script -->
<script>
  $(function () {

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.

	var hasta	      = jQuery("#hasta").val();
    var desde  		  = jQuery("#desde").val();
	  
    $.ajax({
              url: "datostablero.php?tipo=1",
              type: "POST",
              dataType: 'json',
              success:function(data){

                    var codservicior = [];
                    var cantidad = [];

										var color = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];
                    var bordercolor =  ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];

                    console.log(data);

                    for(var i in data) {
                      codservicior.push(data[i].codservicior);
                      cantidad.push(data[i].cantidad);

                    }


                    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')

                    var donutData        = {
                      labels: codservicior,
                      datasets: [{
                          label: codservicior,
                          backgroundColor: color,
                          borderColor: color,
                          borderWidth: 2,
                          hoverBackgroundColor: color,
                          hoverBorderColor: bordercolor,
                          data: cantidad
                      }]
                    }

                    var donutOptions     = {
                      maintainAspectRatio : false,
                      responsive : true,
                      legend: {
                          display: true,
                          position: 'right'
                      }
                    }

                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    var donutChart = new Chart(donutChartCanvas, {
                      type: 'doughnut',
                      data: donutData,
                      options: donutOptions
                    })


           },
           error: function(data) {
                    console.log(data);
           }


    });

		$.ajax({
              url: "datostablero.php?tipo=2&desde="+desde+"&hasta="+hasta,
              type: "POST",
              dataType: 'json',
              success:function(data){

                    var descripcion = [];
                    var cantidad = [];

										var color = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];
                    var bordercolor =  ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];

                    console.log(data);

                    for(var i in data) {
                      descripcion.push(data[i].descripcion);
                      cantidad.push(data[i].cantidad);

                    }

										//-------------
								    //- BAR CHART -
								    //-------------
								    var barChartCanvas = $('#barChart').get(0).getContext('2d')

										var Data        = {
                      labels: descripcion,
                      datasets: [{
                          label: "Cantidad",
                          backgroundColor: color,
                          borderColor: color,
                          borderWidth: 2,
                          hoverBackgroundColor: color,
                          hoverBorderColor: bordercolor,
                          data: cantidad
                      }]
                    }

                    var barChartOptions     = {
                      maintainAspectRatio : false,
                      responsive : true
                    }

								    var barChart = new Chart(barChartCanvas, {
								      type: 'bar',
								      data: Data,
								      options: barChartOptions
								    })

           },
           error: function(data) {
                    console.log(data);
           }


    });

		$.ajax({
              url: "datostablero.php?tipo=3&desde="+desde+"&hasta="+hasta,
              type: "POST",
              dataType: 'json',
              success:function(data){

                    var nomestudio = [];
                    var cantidad = [];

										var color = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];
                    var bordercolor =  ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];

                    console.log(data);

                    for(var i in data) {
                      nomestudio.push(data[i].nomestudio);
                      cantidad.push(data[i].cantidad);

                    }

										//-------------
								    //- PIE CHART -
								    //-------------
								    // Get context with jQuery - using jQuery's .get() method.
								    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')

										var Data        = {
                      labels: nomestudio,
                      datasets: [{
                          label: nomestudio,
                          backgroundColor: color,
                          borderColor: color,
                          borderWidth: 2,
                          hoverBackgroundColor: color,
                          hoverBorderColor: bordercolor,
                          data: cantidad
                      }]
                    }

								    var pieData        = Data;
								    var pieOptions     = {
								      maintainAspectRatio : false,
								      responsive : true,
                      legend: {
                          display: true,
                          position: 'right'
                      }
								    }
								    //Create pie or douhnut chart
								    // You can switch between pie and douhnut using the method below.
								    var pieChart = new Chart(pieChartCanvas, {
								      type: 'pie',
								      data: pieData,
								      options: pieOptions
								    })

           },
           error: function(data) {
                    console.log(data);
           }


    });

		$.ajax({
              url: "datostablero.php?tipo=4&desde="+desde+"&hasta="+hasta,
              type: "POST",
              dataType: 'json',
              success:function(data){

                    var codservicior = [];

                    var color1 = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];
                    var bordercolor =  ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];

                    console.log(data);

                    for(var i in data) {

                      codservicior.push(i);

                    }

                    var ctx = document.getElementById("lineChart");
                    var barChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                          labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre', 'Noviembre', 'Diciembre'],
                              datasets: []
                    		}
                    });

                    var j = 0;

                    for(var i in data) {

                      addData(barChart, i, color1[j], [ data[i].Enero, data[i].Febrero, data[i].Marzo, data[i].Abril, data[i].Mayo, data[i].Junio, data[i].Julio, data[i].Agosto, data[i].Setiembre, data[i].Octubre, data[i].Noviembre, data[i].Diciembre ]);

                      j = j +1;

                    }

                    function addData(chart, label, color, data) {
                    		chart.data.datasets.push({
                    	    label: label,
                          backgroundColor: color,
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
              url: "datostablero.php?tipo=5&desde="+desde+"&hasta="+hasta,
              type: "POST",
              dataType: 'json',
              success:function(data){

                    var codservicior = [];

                    var color1 = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];
                    var bordercolor =  ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];

                    console.log(data);

                    for(var i in data) {

                      codservicior.push(i);

                    }

                    var ctx = document.getElementById("barChart1");
                    var barChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                          labels: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
                              datasets: []
                    		}
                    });

                    var j = 0;

                    for(var i in data) {

                      addData(barChart, i, color1[j], [ data[i].domingo, data[i].lunes, data[i].martes, data[i].miercoles, data[i].jueves, data[i].viernes, data[i].sabado ]);

                      j = j +1;

                    }

                    function addData(chart, label, color, data) {
                    		chart.data.datasets.push({
                    	    label: label,
                          backgroundColor: color,
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
              url: "datostablero.php?tipo=6&desde="+desde+"&hasta="+hasta,
              type: "POST",
              dataType: 'json',
              success:function(data){

                    var codservicior = [];
                    var cantidad = [];

					var color = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];
                    var bordercolor =  ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];

                    console.log(data);

                    for(var i in data) {
                      codservicior.push(data[i].codservicior);
                      cantidad.push(data[i].cantidad);

                    }

										//-------------
								    //- BAR CHART -
								    //-------------
					  var barChartCanvas = $('#stackedBarChart').get(0).getContext('2d')

					  var Data        = {
                      labels: codservicior,
                      datasets: [{
                          label: "Cantidad",
                          backgroundColor: color,
                          borderColor: color,
                          borderWidth: 2,
                          hoverBackgroundColor: color,
                          hoverBorderColor: bordercolor,
                          data: cantidad
                      }]
                    }

                    var barChartOptions     = {
                      maintainAspectRatio : false,
                      responsive : true,
                      scales: {
                           xAxes: [{
                               ticks: {
                                   display: false //this will remove only the label
                               }
                           }]
                       }
                    }

								    var barChart = new Chart(barChartCanvas, {
								      type: 'bar',
								      data: Data,
								      options: barChartOptions
								    })

           },
           error: function(data) {
                    console.log(data);
           }


    });
	  
	$.ajax({
              url: "datostablero.php?tipo=7&desde="+desde+"&hasta="+hasta,
              type: "POST",
              dataType: 'json',
              success:function(data){

                    var codservicior = [];
                    var cantidad = [];
				  
				    var color = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];
                        
				     var bordercolor =  ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];

                    console.log(data);

                    for(var i in data) {
                      codservicior.push(data[i].codservicior);
                      cantidad.push(data[i].cantidad);

                    }

										//-------------
								    //- BAR CHART -
								    //-------------
								    var barChartCanvas = $('#stackedBarChart').get(0).getContext('2d')

										var Data        = {
                      labels: codservicior,
                      datasets: [{
                          label: "Cantidad",
                          backgroundColor: color,
                          borderColor: color,
                          borderWidth: 2,
                          hoverBackgroundColor: color,
                          hoverBorderColor: bordercolor,
                          data: cantidad
                      }]
                    }

                    var barChartOptions     = {
                      maintainAspectRatio : false,
                      responsive : true,
                      scales: {
                           xAxes: [{
                               ticks: {
                                   display: false //this will remove only the label
                               }
                           }]
                       }
                    }

								    var barChart = new Chart(barChartCanvas, {
								      type: 'bar',
								      data: Data,
								      options: barChartOptions
								    })

           },
           error: function(data) {
                    console.log(data);
           }


    });

});



</script>
<script>



function gridReload()
{
      var codservicio = jQuery("#laboratorio").val();
      var hasta	      = jQuery("#hasta").val();
      var desde  		  = jQuery("#desde").val();

      var codservicio = jQuery("#laboratorio").val();

        $.ajax({
                  url: "datostablero.php?tipo=2&codservicio="+codservicio+"&desde="+desde+"&hasta="+hasta,
                  type: "POST",
                  dataType: 'json',
                  success:function(data){

                        var descripcion = [];
                        var cantidad = [];

                        var color = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];
                        var bordercolor =  ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];

                        console.log(data);

                        for(var i in data) {
                          descripcion.push(data[i].descripcion);
                          cantidad.push(data[i].cantidad);

                        }

                        //-------------
                        //- BAR CHART -
                        //-------------
                        $('#barChart').remove(); // this is my <canvas> element
                        $('.chart2').append('<canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"><canvas>');

                        var barChartCanvas = $('#barChart').get(0).getContext('2d')

                        var Data        = {
                          labels: descripcion,
                          datasets: [{
                              label: "Cantidad",
                              backgroundColor: color,
                              borderColor: color,
                              borderWidth: 2,
                              hoverBackgroundColor: color,
                              hoverBorderColor: bordercolor,
                              data: cantidad
                          }]
                        }

                        var barChartOptions     = {
                          maintainAspectRatio : false,
                          responsive : true
                        }

                        var barChart = new Chart(barChartCanvas, {
                          type: 'bar',
                          data: Data,
                          options: barChartOptions
                        })

               },
               error: function(data) {
                        console.log(data);
               }


        });

        $.ajax({
                  url: "datostablero.php?tipo=3&codservicio="+codservicio+"&desde="+desde+"&hasta="+hasta,
                  type: "POST",
                  dataType: 'json',
                  success:function(data){

                        var nomestudio = [];
                        var cantidad = [];

    										var color = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];
                        var bordercolor =  ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];

                        console.log(data);

                        for(var i in data) {
                          nomestudio.push(data[i].nomestudio);
                          cantidad.push(data[i].cantidad);

                        }

    										//-------------
    								    //- PIE CHART -
    								    //-------------
    								    // Get context with jQuery - using jQuery's .get() method.
                        $('#pieChart').remove(); // this is my <canvas> element
                        $('.chart3').append('<canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"><canvas>');

    								    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')

    										var Data        = {
                          labels: nomestudio,
                          datasets: [{
                              label: nomestudio,
                              backgroundColor: color,
                              borderColor: color,
                              borderWidth: 2,
                              hoverBackgroundColor: color,
                              hoverBorderColor: bordercolor,
                              data: cantidad
                          }]
                        }

    								    var pieData        = Data;
    								    var pieOptions     = {
    								      maintainAspectRatio : false,
    								      responsive : true,
                          legend: {
                              display: true,
                              position: 'right'
                          }
    								    }
    								    //Create pie or douhnut chart
    								    // You can switch between pie and douhnut using the method below.
    								    var pieChart = new Chart(pieChartCanvas, {
    								      type: 'pie',
    								      data: pieData,
    								      options: pieOptions
    								    })

               },
               error: function(data) {
                        console.log(data);
               }


        });

        $.ajax({
                  url: "datostablero.php?tipo=4&codservicio="+codservicio+"&desde="+desde+"&hasta="+hasta,
                  type: "POST",
                  dataType: 'json',
                  success:function(data){

                        var codservicior = [];

                        var color1 = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];
                        var bordercolor =  ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];

                        console.log(data);

                        for(var i in data) {

                          codservicior.push(i);

                        }

                        $('#lineChart').remove(); // this is my <canvas> element
                        $('.chart4').append('<canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"><canvas>');

                        var ctx = document.getElementById("lineChart");
                        var barChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                              labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre', 'Noviembre', 'Diciembre'],
                                  datasets: []
                        		}
                        });

                        var j = 0;

                        for(var i in data) {

                          addData(barChart, i, color1[j], [ data[i].Enero, data[i].Febrero, data[i].Marzo, data[i].Abril, data[i].Mayo, data[i].Junio, data[i].Julio, data[i].Agosto, data[i].Setiembre, data[i].Octubre, data[i].Noviembre, data[i].Diciembre ]);

                          j = j +1;

                        }

                        function addData(chart, label, color, data) {
                        		chart.data.datasets.push({
                        	    label: label,
                              backgroundColor: color,
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
                  url: "datostablero.php?tipo=5&codservicio="+codservicio+"&desde="+desde+"&hasta="+hasta,
                  type: "POST",
                  dataType: 'json',
                  success:function(data){

                        var codservicior = [];

                        var color1 = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];
                        var bordercolor =  ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];

                        console.log(data);

                        for(var i in data) {

                          codservicior.push(i);

                        }


                        $('#barChart1').remove(); // this is my <canvas> element
                        $('.chart5').append('<canvas id="barChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"><canvas>');

                        var ctx = document.getElementById("barChart1");
                        var barChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                              labels: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
                                  datasets: []
                        		}
                        });

                        barChart.clear();

                        var j = 0;

                        for(var i in data) {

                          addData(barChart, i, color1[j], [ data[i].domingo, data[i].lunes, data[i].martes, data[i].miercoles, data[i].jueves, data[i].viernes, data[i].sabado ]);

                          j = j +1;

                        }

                        function addData(chart, label, color, data) {
                        		chart.data.datasets.push({
                        	    label: label,
                              backgroundColor: color,
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
                  url: "datostablero.php?tipo=6&codservicio="+codservicio+"&desde="+desde+"&hasta="+hasta,
                  type: "POST",
                  dataType: 'json',
                  success:function(data){

                        var descripcion = [];
                        var cantidad = [];

                        var color = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];
                        var bordercolor =  ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#2e4053', '#2e7d32', '#f4511e', '#78909c'];

                        console.log(data);

                        for(var i in data) {
                          descripcion.push(data[i].codservicior);
                          cantidad.push(data[i].cantidad);

                        }

                        //-------------
                        //- BAR CHART -
                        //-------------
                        $('#stackedBarChart').remove(); // this is my <canvas> element
                        $('.chart6').append('<canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"><canvas>');

                        var barChartCanvas = $('#stackedBarChart').get(0).getContext('2d')

                        var Data        = {
                          labels: descripcion,
                          datasets: [{
                              label: "Cantidad",
                              backgroundColor: color,
                              borderColor: color,
                              borderWidth: 2,
                              hoverBackgroundColor: color,
                              hoverBorderColor: bordercolor,
                              data: cantidad
                          }]
                        }

                        var barChartOptions     = {
                          maintainAspectRatio : false,
                          responsive : true
                        }

                        var barChart = new Chart(barChartCanvas, {
                          type: 'bar',
                          data: Data,
                          options: barChartOptions
                        })

               },
               error: function(data) {
                        console.log(data);
               }


        });

        $.ajax({
                  url: "datostablero.php?tipo=7&desde="+desde+"&hasta="+hasta,
                  type: "POST",
                  dataType: 'json',
                  success:function(data){

                     var cantidadresultado = 0;
                     var cantidadorden = 0;

                     console.log(data);

                     cantidadresultado = data[0].cantidadresultado;
                     cantidadorden = data[0].cantidadorden;
					  
					 $("#cantidadresultado").text(cantidadresultado);
					 $("#cantidadorden").text(cantidadorden);

               },
               error: function(data) {
                        console.log(data);
               }


        });

}
</script>
</body>
</html>
