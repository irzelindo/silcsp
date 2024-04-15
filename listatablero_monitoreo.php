<?php
@Header("Content-type: text/html; charset=iso-8859-1");
session_start();

include("conexion.php");
$link = Conectarse();

$nomyape = $_SESSION["nomyape"];
$codusu = $_SESSION['codusu'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Monitoreo</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./resources/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./resources/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block"><?php echo $nomyape; ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <!-- Filtro de fecha desde/hasta -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                  Filtro de Fecha
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <form id="filtroForm">
                    <div class="form-group">
                      <label for="desde">Desde:</label>
                      <input type="date" id="desde" name="desde" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="hasta">Hasta:</label>
                      <input type="date" id="hasta" name="hasta" class="form-control">
                    </div>
                    <button id="filtrar" type="button" class="btn btn-primary">Aplicar Filtro</button>
                  </form>
                </li>
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
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Monitoreo de Capacidades de los Laboratorios</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="col-sm-6">
            <h5>Muestras</h5>
          </div>
          <div class="row">
            <div class="col-md-6">
              <!-- DONUT CHART -->
              <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">Cantidad de muestras totales procesadas por Region</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="donutChartCanvas" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- DONUT CHART -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Cantidad de muestras totales procesadas por Laboratorios</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="donutChartCanvass1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <div class="col-md-6">
              <!-- DONUT CHART -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Cantidad de muestras totales procesadas por Estudio</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- DONUT CHART -->
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">Cantidad de muestras totales procesadas por Semana Epidemilogica</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <!-- /.col (LEFT) -->
          </div>
          <div class="col-sm-6">
            <h5>Personal</h5>
          </div>
          <div class="row">
            <div class="col-md-6">
              <!-- DONUT CHART -->
              <div class="card card-dark">
                <div class="card-header">
                  <h3 class="card-title">Cantidad de personal por Region</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="barChartw2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- DONUT CHART -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Cantidad de personal por Laboratorios</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="barChartw5" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Cantidad de personal por Semana Epidemilogica</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="barChartw" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <!-- /.col (LEFT) -->
          </div>
          <div class="col-sm-6">
            <h5>Reactivos</h5>
          </div>
          <div class="row">
            <div class="col-md-6">
              <!-- DONUT CHART -->
              <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">Cantidad de reactivos por Tipo</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="pieCharts" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- DONUT CHART -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Cantidad de reactivo por Region</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="donutChartCanvassf" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <div class="col-md-6">
              <!-- DONUT CHART -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Cantidad de reativos por Laboratorio</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="pieChartD" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- DONUT CHART -->
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">Cantidad de reactivos por Semana Epidemilogica</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="barChardst" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <!-- /.col (LEFT) -->
          </div>
          <div class="col-sm-6">
            <h5>Pacientes</h5>
          </div>
          <div class="row">
            <div class="col-md-6">
              <!-- DONUT CHART -->
              <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">Cantidad de pacientes remitidos por tipo al lcsp</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="pieChartsss" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

            </div>

            <!-- /.col (LEFT) -->
          </div>


          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="#">DGTIC - Sistemas</a>.</strong> All rights reserved.
    </footer>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Add Content Here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <!-- jQuery -->
  <script src="./resources/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./resources/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="./resources/chart.js/Chart.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./resources/js/adminlte.min.js"></script>
  <!-- Page specific script -->
  <script>
    $(document).ready(function() {
      // Cuando la página se carga por primera vez, cargar el contenido inicial
      muestra_region(); // Mostrar gráfico de dona para regiones
      muestra_laboratorio(); // Mostrar gráfico de dona para laboratorios
      muestra_estudio(); // Mostrar gráfico de tarta para estudios
      muestra_semana();
      personal_region();
      personal_lab();
      personal_semana();
      reactivo_tipo();
      reactivo_region();
      reactivo_laboratorio();
      reactivo_semana();
      paciente_tipo();

      // Cuando se hace clic en el botón "Aplicar Filtro", actualizar el contenido
      $('#filtrar').click(function(e) {
        e.preventDefault();
        muestra_region(); // Mostrar gráfico de dona para regiones
        muestra_laboratorio(); // Mostrar gráfico de dona para laboratorios
        muestra_estudio(); // Mostrar gráfico de tarta para estudios
        muestra_semana();
        personal_region();
        personal_lab();
        personal_semana();
        reactivo_tipo();
        reactivo_region();
        reactivo_laboratorio();
        reactivo_semana();
        paciente_tipo();
      });
    });

    // Función para mostrar gráfico de dona para regiones
    function muestra_region() {
      var donutChartCanvas = $('#donutChartCanvas').get(0).getContext('2d');

      var data_region = {
        "accion": "muestra_region",
        "desde": $("#desde").val(),
        "hasta": $("#hasta").val()
      };


      // Hacer una solicitud AJAX para cargar los datos desde el script PHP que genera JSON dinámicamente
      $.ajax({
        url: 'datostablero-monitoreo.php', // Ruta al script PHP que genera JSON
        type: 'GET', // Especificar el método POST
        dataType: 'json',
        data: data_region, // Datos a enviar junto con la solicitud POST
        success: function(data) {
          // El resto del código permanece igual
          var jsonData = data;
          var labels = [];
          var values = [];
          var backgroundColors = [];

          for (var i = 0; i < jsonData.length; i++) {
            labels.push(jsonData[i].region);
            values.push(parseInt(jsonData[i].cantidad));
            // Generar colores aleatorios para las barras
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.9)';
            backgroundColors.push(randomColor);
          }

          var barChartData = {
            labels: labels,
            datasets: [{
              label: 'Regiones',
              backgroundColor: backgroundColors,
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: values
            }]
          };

          var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
          };

          new Chart(donutChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          });
        },
        error: function(xhr, status, error) {
          console.error('Error al cargar los datos JSON:', error);
        }
      });
    }



    // Función para mostrar gráfico de dona para laboratorios
    function muestra_laboratorio() {
      var donutChartCanvass1 = $('#donutChartCanvass1').get(0).getContext('2d');

      var data_laboratorio = {
        "accion": "muestra_laboratorio",
        "desde": $("#desde").val(),
        "hasta": $("#hasta").val()
      };

      // Hacer una solicitud AJAX para cargar los datos desde el script PHP que genera JSON dinámicamente
      $.ajax({
        url: 'datostablero-monitoreo.php', // Ruta al script PHP que genera JSON
        type: 'GET', // Especificar el método POST
        dataType: 'json',
        data: data_laboratorio, // Datos a enviar junto con la solicitud POST
        success: function(data) {
          // El resto del código permanece igual
          var jsonData = data;
          var labels = [];
          var values = [];
          var backgroundColors = [];

          for (var i = 0; i < jsonData.length; i++) {
            labels.push(jsonData[i].laboratorio);
            values.push(parseInt(jsonData[i].cantidad));
            // Generar colores aleatorios para las barras
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.9)';
            backgroundColors.push(randomColor);
          }

          var barChartData = {
            labels: labels,
            datasets: [{
              label: 'Laboratorios',
              backgroundColor: backgroundColors,
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: values
            }]
          };

          var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
          };

          new Chart(donutChartCanvass1, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          });
        },
        error: function(xhr, status, error) {
          console.error('Error al cargar los datos JSON:', error);
        }
      });
    }



    // Función para mostrar gráfico de tarta para estudios
    function muestra_estudio() {
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d');

      var data_estudio = {
        "accion": "muestra_estudio",
        "desde": $("#desde").val(),
        "hasta": $("#hasta").val()
      };

      // Hacer una solicitud AJAX para cargar los datos desde el script PHP que genera JSON dinámicamente
      $.ajax({
        url: 'datostablero-monitoreo.php', // Ruta al script PHP que genera JSON
        type: 'GET', // Especificar el método POST
        dataType: 'json',
        data: data_estudio, // Datos a enviar junto con la solicitud POST
        success: function(data) {
          // El resto del código permanece igual
          var jsonData = data;
          var labels = [];
          var values = [];
          var backgroundColors = [];

          for (var i = 0; i < jsonData.length; i++) {
            labels.push(jsonData[i].estudio);
            values.push(parseInt(jsonData[i].cantidad));
            // Generar colores aleatorios para las barras
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.9)';
            backgroundColors.push(randomColor);
          }

          var barChartData = {
            labels: labels,
            datasets: [{
              label: 'Estudios',
              backgroundColor: backgroundColors,
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: values
            }]
          };

          var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
          };

          new Chart(pieChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          });
        },
        error: function(xhr, status, error) {
          console.error('Error al cargar los datos JSON:', error);
        }
      });
    }



    function muestra_semana() {
      var barChartCanvas = $('#barChart').get(0).getContext('2d');

      var data_semana = {
        "accion": "muestra_semana",
        "desde": $("#desde").val(),
        "hasta": $("#hasta").val()
      };

      // Hacer una solicitud AJAX para cargar los datos desde el script PHP que genera JSON dinámicamente
      $.ajax({
        url: 'datostablero-monitoreo.php', // Ruta al script PHP que genera JSON
        type: 'GET', // Especificar el método POST
        dataType: 'json',
        data: data_semana, // Datos a enviar junto con la solicitud POST
        success: function(data) {
          // El resto del código permanece igual
          var jsonData = data;
          var labels = [];
          var values = [];
          var backgroundColors = [];

          for (var i = 0; i < jsonData.length; i++) {
            labels.push(jsonData[i].semana);
            values.push(parseInt(jsonData[i].cantidad));
            // Generar colores aleatorios para las barras
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.9)';
            backgroundColors.push(randomColor);
          }

          var barChartData = {
            labels: labels,
            datasets: [{
              label: 'Semanas',
              backgroundColor: backgroundColors,
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: values
            }]
          };

          var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
          };

          new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          });
        },
        error: function(xhr, status, error) {
          console.error('Error al cargar los datos JSON:', error);
        }
      });
    }


    function personal_region() {
      var barChartCanvas4 = $('#barChartw2').get(0).getContext('2d');

      var data_pregion = {
        "accion": "personal_region",
        "desde": $("#desde").val(),
        "hasta": $("#hasta").val()
      };

      // Hacer una solicitud AJAX para cargar los datos desde el script PHP que genera JSON dinámicamente
      $.ajax({
        url: 'datostablero-monitoreo.php', // Ruta al script PHP que genera JSON
        type: 'GET', // Especificar el método POST
        dataType: 'json',
        data: data_pregion, // Datos a enviar junto con la solicitud POST
        success: function(data) {
          // El resto del código permanece igual
          var jsonData = data;
          var labels = [];
          var values = [];
          var backgroundColors = [];

          for (var i = 0; i < jsonData.length; i++) {
            labels.push(jsonData[i].region);
            values.push(parseInt(jsonData[i].cantidad));
            // Generar colores aleatorios para las barras
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.9)';
            backgroundColors.push(randomColor);
          }

          var barChartData = {
            labels: labels,
            datasets: [{
              label: 'Regiones',
              backgroundColor: backgroundColors,
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: values
            }]
          };

          var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
          };

          new Chart(barChartCanvas4, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          });
        },
        error: function(xhr, status, error) {
          console.error('Error al cargar los datos JSON:', error);
        }
      });
    }


    function personal_lab() {
      var barChartCanvas8 = $('#barChartw5').get(0).getContext('2d');

      var data_plab = {
        "accion": "personal_laboratorio",
        "desde": $("#desde").val(),
        "hasta": $("#hasta").val()
      };

      // Hacer una solicitud AJAX para cargar los datos desde el script PHP que genera JSON dinámicamente
      $.ajax({
        url: 'datostablero-monitoreo.php', // Ruta al script PHP que genera JSON
        type: 'GET', // Especificar el método POST
        dataType: 'json',
        data: data_plab, // Datos a enviar junto con la solicitud POST
        success: function(data) {
          // El resto del código permanece igual
          var jsonData = data;
          var labels = [];
          var values = [];
          var backgroundColors = [];

          for (var i = 0; i < jsonData.length; i++) {
            labels.push(jsonData[i].laboratorio);
            values.push(parseInt(jsonData[i].cantidad));
            // Generar colores aleatorios para las barras
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.9)';
            backgroundColors.push(randomColor);
          }

          var barChartData = {
            labels: labels,
            datasets: [{
              label: 'Laboratorios',
              backgroundColor: backgroundColors,
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: values
            }]
          };

          var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
          };

          new Chart(barChartCanvas8, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          });
        },
        error: function(xhr, status, error) {
          console.error('Error al cargar los datos JSON:', error);
        }
      });
    }


    function personal_semana() {
      var barChartCanvass = $('#barChartw').get(0).getContext('2d');

      var data_psemana = {
        "accion": "personal_semana",
        "desde": $("#desde").val(),
        "hasta": $("#hasta").val()
      };


      // Hacer una solicitud AJAX para cargar los datos desde el script PHP que genera JSON dinámicamente
      $.ajax({
        url: 'datostablero-monitoreo.php', // Ruta al script PHP que genera JSON
        type: 'GET', // Especificar el método POST
        dataType: 'json',
        data: data_psemana, // Datos a enviar junto con la solicitud POST
        success: function(data) {
          // El resto del código permanece igual
          var jsonData = data;
          var labels = [];
          var values = [];
          var backgroundColors = [];

          for (var i = 0; i < jsonData.length; i++) {
            labels.push(jsonData[i].semana);
            values.push(parseInt(jsonData[i].cantidad));
            // Generar colores aleatorios para las barras
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.9)';
            backgroundColors.push(randomColor);
          }

          var barChartData = {
            labels: labels,
            datasets: [{
              label: 'Semanas',
              backgroundColor: backgroundColors,
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: values
            }]
          };

          var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
          };

          new Chart(barChartCanvass, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          });
        },
        error: function(xhr, status, error) {
          console.error('Error al cargar los datos JSON:', error);
        }
      });
    }

    function reactivo_tipo() {
      var pieChartCanvass = $('#pieCharts').get(0).getContext('2d');

      var data_tipo = {
        "accion": "reactivo_tipo",
        "desde": $("#desde").val(),
        "hasta": $("#hasta").val()
      };

      // Hacer una solicitud AJAX para cargar los datos desde el script PHP que genera JSON dinámicamente
      $.ajax({
        url: 'datostablero-monitoreo.php', // Ruta al script PHP que genera JSON
        type: 'GET', // Especificar el método POST
        dataType: 'json',
        data: data_tipo, // Datos a enviar junto con la solicitud POST
        success: function(data) {
          // El resto del código permanece igual
          var jsonData = data;
          var labels = [];
          var values = [];
          var backgroundColors = [];

          for (var i = 0; i < jsonData.length; i++) {
            labels.push(jsonData[i].tipo);
            values.push(parseInt(jsonData[i].cantidad));
            // Generar colores aleatorios para las barras
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.9)';
            backgroundColors.push(randomColor);
          }

          var barChartData = {
            labels: labels,
            datasets: [{
              label: 'Cantidad',
              backgroundColor: backgroundColors,
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: values
            }]
          };

          var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
          };

          new Chart(pieChartCanvass, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          });
        },
        error: function(xhr, status, error) {
          console.error('Error al cargar los datos JSON:', error);
        }
      });
    }


    function reactivo_region() {
      var donutChartCanvassf = $('#donutChartCanvassf').get(0).getContext('2d');

      var data_rregion = {
        "accion": "reactivo_region",
        "desde": $("#desde").val(),
        "hasta": $("#hasta").val()
      };

      // Hacer una solicitud AJAX para cargar los datos desde el script PHP que genera JSON dinámicamente
      $.ajax({
        url: 'datostablero-monitoreo.php', // Ruta al script PHP que genera JSON
        type: 'GET', // Especificar el método POST
        dataType: 'json',
        data: data_rregion, // Datos a enviar junto con la solicitud POST
        success: function(data) {
          // El resto del código permanece igual
          var jsonData = data;
          var labels = [];
          var values = [];
          var backgroundColors = [];

          for (var i = 0; i < jsonData.length; i++) {
            labels.push(jsonData[i].region);
            values.push(parseInt(jsonData[i].cantidad));
            // Generar colores aleatorios para las barras
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.9)';
            backgroundColors.push(randomColor);
          }

          var barChartData = {
            labels: labels,
            datasets: [{
              label: 'Regiones',
              backgroundColor: backgroundColors,
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: values
            }]
          };

          var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
          };

          new Chart(donutChartCanvassf, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          });
        },
        error: function(xhr, status, error) {
          console.error('Error al cargar los datos JSON:', error);
        }
      });
    }

    function reactivo_laboratorio() {
      var pieChartD = $('#pieChartD').get(0).getContext('2d');

      var data_rlab = {
        "accion": "reactivo_laboratorio",
        "desde": $("#desde").val(),
        "hasta": $("#hasta").val()
      };

      // Hacer una solicitud AJAX para cargar los datos desde el script PHP que genera JSON dinámicamente
      $.ajax({
        url: 'datostablero-monitoreo.php', // Ruta al script PHP que genera JSON
        type: 'GET', // Especificar el método POST
        dataType: 'json',
        data: data_rlab, // Datos a enviar junto con la solicitud POST
        success: function(data) {
          // El resto del código permanece igual
          var jsonData = data;
          var labels = [];
          var values = [];
          var backgroundColors = [];

          for (var i = 0; i < jsonData.length; i++) {
            labels.push(jsonData[i].laboratorio);
            values.push(parseInt(jsonData[i].cantidad));
            // Generar colores aleatorios para las barras
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.9)';
            backgroundColors.push(randomColor);
          }

          var barChartData = {
            labels: labels,
            datasets: [{
              label: 'Laboratorios',
              backgroundColor: backgroundColors,
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: values
            }]
          };

          var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
          };

          new Chart(pieChartD, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          });
        },
        error: function(xhr, status, error) {
          console.error('Error al cargar los datos JSON:', error);
        }
      });
    }

    function reactivo_semana() {
      var barChardst = $('#barChardst').get(0).getContext('2d');

      var data_psemana = {
        "accion": "reactivo_semana",
        "desde": $("#desde").val(),
        "hasta": $("#hasta").val()
      };

      // Hacer una solicitud AJAX para cargar los datos desde el script PHP que genera JSON dinámicamente
      $.ajax({
        url: 'datostablero-monitoreo.php', // Ruta al script PHP que genera JSON
        type: 'GET', // Especificar el método POST
        dataType: 'json',
        data: data_psemana, // Datos a enviar junto con la solicitud POST
        success: function(data) {
          // El resto del código permanece igual
          var jsonData = data;
          var labels = [];
          var values = [];
          var backgroundColors = [];

          for (var i = 0; i < jsonData.length; i++) {
            labels.push(jsonData[i].semana);
            values.push(parseInt(jsonData[i].cantidad));
            // Generar colores aleatorios para las barras
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.9)';
            backgroundColors.push(randomColor);
          }

          var barChartData = {
            labels: labels,
            datasets: [{
              label: 'Semanas',
              backgroundColor: backgroundColors,
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: values
            }]
          };

          var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
          };

          new Chart(barChardst, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          });
        },
        error: function(xhr, status, error) {
          console.error('Error al cargar los datos JSON:', error);
        }
      });
    }

    function paciente_tipo() {
      var pieChartsss = $('#pieChartsss').get(0).getContext('2d');

      var data_paciente = {
        "accion": "paciente_tipo",
        "desde": $("#desde").val(),
        "hasta": $("#hasta").val()
      };

      // Hacer una solicitud AJAX para cargar los datos desde el script PHP que genera JSON dinámicamente
      $.ajax({
        url: 'datostablero-monitoreo.php', // Ruta al script PHP que genera JSON
        type: 'GET', // Especificar el método POST
        dataType: 'json',
        data: data_paciente, // Datos a enviar junto con la solicitud POST
        success: function(data) {
          // El resto del código permanece igual
          var jsonData = data;
          var labels = [];
          var values = [];
          var backgroundColors = [];

          for (var i = 0; i < jsonData.length; i++) {
            labels.push(jsonData[i].paciente);
            values.push(parseInt(jsonData[i].cantidad));
            // Generar colores aleatorios para las barras
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.9)';
            backgroundColors.push(randomColor);
          }

          var barChartData = {
            labels: labels,
            datasets: [{
              label: 'Pacientes',
              backgroundColor: backgroundColors,
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: values
            }]
          };

          var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
          };

          new Chart(pieChartsss, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          });
        },
        error: function(xhr, status, error) {
          console.error('Error al cargar los datos JSON:', error);
        }
      });
    }
  </script>


</body>

</html>
