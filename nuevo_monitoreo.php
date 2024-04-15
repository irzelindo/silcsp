<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();

include("conexion.php"); 
$conn = Conectarse();

include("conexionsaa.php");
$consaa=Conectarsesaa();

$nomyape=$_SESSION["nomyape"];
$codusu=$_SESSION['codusu'];

$elusuario=$nomyape;
$email = $_SESSION['email'];










if($_SESSION['usuario'] != "SI")
{
header("Location: index.php");	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8"/>
<title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica</title>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes"/>
<link rel="shortcut icon" href="favicon.ico"/> 
<meta http-equiv="Content-Language" content="es-py"/>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1; Content-Encoding: gzip; Vary: Accept-Encoding;" />
<meta name="description" content="Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica"/>
<meta name="keywords" content="Estudios clinicos, bacteriologia, analisis, bioquimica, Paraguay, salud, muestras clinicas"/>
<meta name="author" content="Victor Diaz Ovando"/>
<meta name="Distribution" content="Global" />
<meta name="Robots" content="index,follow" />
<link href="css/style-monitoreo.css" rel="stylesheet">

<link href="font-awesome.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
<script src="jquery-1.12.4.min.js"></script>
<script src="wb.stickylayer.min.js"></script>
<script src="affix.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>



 <!----------- PARA ALERTAS  ---------->
<script src="jquery.ui.draggable.js" type="text/javascript"></script>

<script src="js/sweetalert.min.js" type="text/javascript"></script>




</head>
<body>
<div id="container">
</div>
<div id="wb_LayoutGrid1">
	<div id="LayoutGrid1">
		<div class="row">
			<div class="col-1">
				<div id="wb_Image3">
					<img src="images/logolcsp2.png" id="Image3" alt=""/>
				</div>
				<div id="wb_Image4">
					<img src="images/banner1lcsp.png" id="Image4" alt=""/>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="wb_LayoutGrid2">
	<div id="LayoutGrid2">
		<div class="row">
			<div class="col-1">
                <?php 
                
                require('menuprincipal.php');
                
                ?>				
			</div>
		</div>
	</div>
</div>
<div id="wb_LayoutGrid3">
	<div id="LayoutGrid3">
		<div class="row">
			<div class="col-1">
				<hr id="Line9"/>
				<div id="wb_Text1">
					<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>USUARIO: </strong></span><span style="color:#FF0000;font-family:Arial;font-size:13px;"><strong><?php echo $elusuario;?></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br />      
					<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>FECHA: </strong></span><span style="color:#FF0000;font-family:Arial;font-size:13px;"><strong><?php echo date('d/m/Y');?></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br />
               <span style="color:#000000;font-family:Arial;font-size:13px;"><strong>EMAIL: </strong></span><span style="color:#FF0000;font-family:Arial;font-size:13px;"><strong><?php echo $email;?></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br />
               <br />
					<br />
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<form id="form" class="user">
   <div id="wb_LayoutGrid4">
      <div class="container">
         <h2>MONITOREO DE CAPACIDADES</h2>
         <ul class="nav nav-pills flex-column flex-sm-row">
          
            <li class="nav-item active"><a class="nav-link" data-toggle="pill" href="#menu2" >Datos de Laboratorio</a></li>
            <li class="nav-item">       <a class="nav-link" data-toggle="pill" href="#menu3" >Muestras</a></li>
            <li class="nav-item">       <a class="nav-link" data-toggle="pill" href="#menu4" >Personal</a></li>
            <li class="nav-item">       <a class="nav-link" data-toggle="pill" href="#menu5" >Reactivos</a></li>
         </ul>
         
         <div class="tab-content">
          
            <div id="menu2" class="tab-pane fade  in active">
               <br> <br>  
               <div class="row">
                  
                  <div class="col-md-10">
                     <button type="button" class="btn btn-primary btn-user btn-block" onclick="cambiarPestana(1)">Siguiente</button>
                  </div>
               </div>            
             
             <br>
              <div class="row">
                 
                 <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                       <label for="region">Región</label>                       
                       <select class="form-control seleccion form-control-user" id="codregion" name="codregion">
                     <option value="">--- Seleccionar Region ---</option>
                     <?php 
                     //Regiones Query
                     $sql="SELECT codreg, subcreg, nomreg FROM regiones WHERE codreg != '50'";
                     $regiones = pg_query( $conn , $sql);
                     while($region = pg_fetch_array($regiones)) 
                     {                          
                       echo '<option value="' . $region['codreg'] .''. $region['subcreg'] . '">' . $region['nomreg'] . '</option>';
                     } ?>
                   </select>
                    </div>
                 </div>
                 <div class="col-md-5 col-sm-12">
                    <div class="form-group">
                       <label>Laboratorio</label>
                       <input type="text" class="form-control" id="laboratorio" name="laboratorio">
                    </div>
                 </div>                 
              </div>
              <div class="row">                 
                 
                 <div class="col-md-10 col-sm-12">
                    <div class="form-group">
                       <label for="txt">Semana Epidemiologica</label>
                       <select class="form-control seleccion form-control-user" id="semana" name="semana">
                          <option value="">Seleccionar</option>
                          <?php
                          // Semanas Epidemiologicas
                          $sql1 = "SELECT codsemana, numero_semana, mes, desde, hasta, anhio FROM semana_epidemiologica WHERE anhio = '2024'";
                          $semanas = pg_exec($conn, $sql1);

                          $currentMonth = null;
                          while ($sem = pg_fetch_array($semanas)) {
                             if ($currentMonth !== $sem['mes']) {
                                if ($currentMonth !== null) {
                                   echo '</optgroup>';
                                }
                             echo '<optgroup label="' . $sem['mes'] . '" >';
                             $currentMonth = $sem['mes'];
                          }
                          echo '<option value="' . $sem['codsemana'] . '">' . $sem['codsemana'] .' - '. date("d/m/Y", strtotime($sem['desde'])) . ' - '. date("d/m/Y", strtotime($sem['hasta'])) . '</option>';
                          }
                          
                          if ($currentMonth !== null) {
                             echo '</optgroup>';
                          }
                          ?>
                       </select>                  
                    </div>
                 </div>
              </div>
              <div class="row">
                 <div class="col-md-10 colsms-12">
                    <div class="form-group">
                       <label>Horario de cobertura del servicio de laboratorio:</label>
                       <input type="text" class="form-control" id="horario" name="horario">
                    </div>
                 </div>
                 <div class="col-md-10 colsms-12">
                    <div class="form-group">
                       <label>Cantidad de Pacientes atendidos en el servicio de laboratorio (ambulatorio-hospitalizado) en la última semana:</label>
                       <input type="number" class="form-control" id="cantidad_paciente" name="cantidad_paciente">
                    </div>
                 </div>
                 <div class="col-md-10 colsms-12">
                    <div class="form-group">
                       <label>Cantidad de Pacientes atendidos para Biologia Molecular:</label>
                       <input type="number" class="form-control" id="cantidad_paciente_bio" name="cantidad_paciente_bio">
                    </div>
                 </div>
              </div>                       
            </div>
            <div id="menu3" class="tab-pane fade ">
               <br> <br>
               <div class="row">
                  <div class="col-md-5">
                     <button type="button" class="btn btn-primary btn-user btn-block" onclick="cambiarPestana(-1)">Anterior</button>
                  </div>
                  <div class="col-md-5">
                     <button type="button" class="btn btn-primary btn-user btn-block" onclick="cambiarPestana(1)">Siguiente</button>
                  </div>
               </div>
               
               <br>             
               
               
               <div class="row">
                  <div class="col-md-10 colsms-12">
                     <div class="form-group">
                        <label>Número total de pruebas realizados en la semana epidemiologica:</label>
                        <input type="number" class="form-control" id="pruebas_total" name="pruebas_total">
                     </div>
                  </div>
               </div> 
               <div class="row">
                  <div class="col-md-10 colsms-12">
                     <div class="form-group">
                        <label>Número total de pruebas realizadas en el Laboratorio de Biologia Molecular:</label>
                        <input type="number" class="form-control" id="numero_muestras_bio" name="numero_muestras_bio" readonly>
                     </div>
                  </div>
               </div> 
               <div class="row">
                  <div class="col-md-2 col-sm-12">
                     <div class="form-group">
                        <label>PCR</label>
                        <input type="number" class="form-control" id="pcr" name="pcr" oninput="calcularMuestras()">
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                     <div class="form-group">
                        <label>Elisa IgG:</label>
                        <input type="number" class="form-control" id="elisa_igc" name="elisa_igc" oninput="calcularMuestras()">
                     </div>
                  </div>
                  <div class="col-md-2 col-sm-12">
                     <div class="form-group">
                        <label>Elisa IgM:</label>
                        <input type="number" class="form-control" id="elisa_igm" name="elisa_igm" oninput="calcularMuestras()">
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                     <div class="form-group">
                        <label>Elisa NS1:</label>
                        <input type="number" class="form-control" id="elisa_ns1" name="elisa_ns1" oninput="calcularMuestras()">
                     </div>
                  </div>
               </div>                 
               <div class="row">
                  <div class="col-md-10 colsms-12">
                     <div class="form-group">
                        <label>Número de muestras enviadas al LCSP:</label>
                        <input type="number" class="form-control" id="muestras_lcsp_enviadas" name="muestras_lcsp_enviadas" readonly>
                     </div>
                  </div>
               </div> 
               <div class="row">
                  <div class="col-md-3 col-sm-12">
                     <div class="form-group">
                        <label>Pacientes Hospitalizado</label>
                        <input type="number" class="form-control" id="hospitalizado" name="hospitalizado" oninput="calcularMuestras3()">
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                     <div class="form-group">
                        <label>Pacientes Obito:</label>
                        <input type="number" class="form-control" id="obito" name="obito" oninput="calcularMuestras3()">
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                     <div class="form-group">
                        <label>Paciente Ambulatoria:</label>
                        <input type="number" class="form-control" id="ambulatoria" name="ambulatoria" oninput="calcularMuestras3()">
                     </div>
                  </div>
               </div>                       
            </div>
            <div id="menu4" class="tab-pane fade">
                <br> <br>
                <div class="row">
                  <div class="col-md-5">
                     <button type="button" class="btn btn-primary btn-user btn-block" onclick="cambiarPestana(-1)">Anterior</button>
                  </div>
                  <div class="col-md-5">
                     <button type="button" class="btn btn-primary btn-user btn-block" onclick="cambiarPestana(1)">Siguiente</button>
                  </div>
               </div>
              
               <br>
               <div class="row">
                  <div class="col-md-10 colsms-12">
                     <div class="form-group">
                        <label>Número de personal de laboratorio activo en la semana actual:</label>
                        <input type="number" class="form-control" id="personal" name="personal" readonly>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-12">
                     <div class="form-group">
                        <label>Bioquímicos:</label>
                        <input type="number" class="form-control" id="bioquimico" name="bioquimico" oninput="calcularPersonal()">
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                     <div class="form-group">
                        <label> Técnico de Laboratorio:</label>
                        <input type="number" class="form-control" id="tecnico" name="tecnico" oninput="calcularPersonal()">
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                     <div class="form-group">
                        <label>Apoyo Administrativo:</label>
                        <input type="number" class="form-control" id="apoyo" name="apoyo" oninput="calcularPersonal()">
                     </div>
                  </div>
               </div>               
               <div class="row">
                  <div class="col-md-10 colsms-12">
                     <div class="form-group">
                        <label>Número de Bioquímicos activos con manejo de técnicas moleculares:</label>
                        <input type="number" class="form-control" id="bioactivo" name="bioactivo">
                     </div>
                  </div>
               </div>               
            </div>
            <div id="menu5" class="tab-pane fade">
               <br> <br>
               <div class="row">
                  <div class="col-md-10">
                     <button type="button" class="btn btn-primary btn-user btn-block" onclick="cambiarPestana(-1)">Anterior</button>
                  </div>
                  
               </div>
             
           
               <br>
               
             
               <div class="row">
                  <div class="col-md-10 colsms-12">
                     <div class="form-group">
                        <label>Stock de pruebas  disponibles  en la semana Epidemiologia:</label>
                        <input type="number" class="form-control" id="stock" name="stock" readonly>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2 col-sm-12">
                     <div class="form-group">
                        <label>RTP-PCR:</label>
                        <input type="number" class="form-control" id="rcpcr" name="rcpcr" oninput="calcularStock2()">
                     </div>
                  </div>
                  <div class="col-md-2 col-sm-12">
                     <div class="form-group">
                        <label>Elisa NS1:</label>
                        <input type="number" class="form-control" id="elisa_ns1_epi" name="elisa_ns1_epi" oninput="calcularStock2()">
                     </div>
                  </div>
                  <div class="col-md-2 col-sm-12">
                     <div class="form-group">
                        <label>Elisa IgG:</label>
                        <input type="number" class="form-control" id="elisa_igc_epi" name="elisa_igc_epi" oninput="calcularStock2()">
                     </div>
                  </div>
                  <div class="col-md-2 col-sm-12">
                     <div class="form-group">
                        <label>Elisa IgM:</label>
                        <input type="number" class="form-control" id="elisa_igm_epi" name="elisa_igm_epi" oninput="calcularStock2()">
                     </div>
                  </div>
                  <div class="col-md-1 col-sm-12">
                     <div class="form-group">
                        <label>Hemograma:</label>
                        <input type="number" class="form-control" id="hemograma_epi" name="hemograma_epi" oninput="calcularStock2()">
                     </div>
                  </div>
                  <div class="col-md-1 col-sm-12">
                     <div class="form-group">
                        <label>Hepatograma:</label>
                        <input type="number" class="form-control" id="hepatograma_epi" name="hepatograma_epi" oninput="calcularStock2()">
                     </div>
                  </div>
               </div>             
               <div class="row">
                  <div class="col-md-10 colsms-12">
                     <div class="form-group">
                        <label>Observacion:</label>
                        <textarea  class="form-control" rows="3" id="observaciones" name="observaciones"></textarea>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-10 colsms-12">
                     <div class="form-group">
                        <label><h2>Responsable de la Carga</h2></label>                       
                     </div>
                  </div>
               </div>
               <div class="row">                  
                  <div class="col-md-4 col-sm-12">
                     <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" id="rnombre" name="rnombre">
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                     <div class="form-group">
                        <label>Contacto:</label>
                        <input type="text" class="form-control" id="rcontacto" name="rcontacto">
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                     <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" id="remail" name="remail">
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-10 colsms-12">
                     <div class="form-group">
                        <input type="hidden" name="accion" value="agregar">
                        <button id="guardar" type="submit" class="btn btn-primary btn-user btn-block">
                           Guardar
                        </button>
                     </div>
                  </div>                  
               </div>
            </div>
         </div>
      </div>
   </div>

</form>

<div id="Layer2">
	<div id="wb_FontAwesomeIcon3">
		<a href="menu.php">
		<div id="FontAwesomeIcon3">
			<i class="fa fa-commenting-o">&nbsp;</i>
		</div>
		</a>
	</div>
</div>

</div>
<div id="wb_sintomas_detallesLayoutGrid1">
	<div id="sintomas_detallesLayoutGrid1">
		<div class="row">
			<div class="col-1">
				<hr id="sintomas_detallesLine1"/>
				<div id="wb_sintomas_detallesText1">
					<span style="color:#FF0000;font-family:Arial;font-size:13px;">[&nbsp;<a href="#" onclick="window.location.href='monitoreos.php';"> VOLVER </a>&nbsp;]</span>
                    
				</div>
				<hr id="sintomas_detallesLine2"/>
			</div>
			<div class="col-2">
			</div>
		</div>
	</div>
</div>
<div id="wb_LayoutGrid9">
	<div id="LayoutGrid9">
		<div class="row">
			<div class="col-1">
				<div id="wb_Text8">
					<span style="color:#FFFFFF;font-family:Arial;font-size:13px;">&#169; 2018 Laboratorio Central de Salud P&uacute;blica. <br />
        				Todos los derechos reservados.<br />
        				Asunci&oacute;n, Paraguay</span>
				</div>
			</div>
			<div class="col-2">
				<div id="wb_FontAwesomeIcon8">
					<div id="FontAwesomeIcon8">
						<i class="fa fa-facebook-f">&nbsp;</i>
					</div>
				</div>
				<div id="wb_FontAwesomeIcon9">
					<div id="FontAwesomeIcon9">
						<i class="fa fa-envelope-o">&nbsp;</i>
					</div>
				</div>
				<div id="wb_FontAwesomeIcon11">
					<div id="FontAwesomeIcon11">
						<i class="fa fa-cloud">&nbsp;</i>
					</div>
				</div>
            <br />
			</div>

		</div>
	</div>
</div>


<script>

      function cambiarPestana(direccion) {
         var pestanas = document.querySelectorAll('.nav-pills .nav-item');
         var activa = document.querySelector('.nav-pills .active');
         var indice = Array.prototype.indexOf.call(pestanas, activa);

         // Calcular el nuevo índice
         var nuevoIndice = indice + direccion;

         // Asegurarse de que el nuevo índice esté en el rango correcto
         if (nuevoIndice >= 0 && nuevoIndice < pestanas.length) {
            // Quitar la clase 'active' de la pestaña actual
            activa.classList.remove('active');

            // Agregar la clase 'active' a la nueva pestaña
            pestanas[nuevoIndice].classList.add('active');

            // Mostrar el contenido de la nueva pestaña
            document.querySelectorAll('.tab-content .tab-pane')[indice].classList.remove('in', 'active');
            document.querySelectorAll('.tab-content .tab-pane')[nuevoIndice].classList.add('in', 'active');
         }
      }

   

    

   //funcion para calcular Número total de pruebas realizadas en el Laboratorio de Biologia Molecular
   function calcularMuestras() {
      var pcr = parseInt(document.getElementById('pcr').value) || 0;
      var elisa_igc = parseInt(document.getElementById('elisa_igc').value) || 0;
      var elisa_igm = parseInt(document.getElementById('elisa_igm').value) || 0;
      var elisa_ns1 = parseInt(document.getElementById('elisa_ns1').value) || 0;

      var muestras2 = pcr + elisa_igc + elisa_igm + elisa_ns1;
      document.getElementById('numero_muestras_bio').value = muestras2;
   };

   //funcion para calcular Número de muestras enviadas al LCSP:
   function calcularMuestras3() {
      var hospitalizado = parseInt(document.getElementById('hospitalizado').value) || 0;
      var obito = parseInt(document.getElementById('obito').value) || 0;
      var ambulatoria = parseInt(document.getElementById('ambulatoria').value) || 0;

      var muestras3 = hospitalizado + obito + ambulatoria;
      document.getElementById('muestras_lcsp_enviadas').value = muestras3;
   };
   
   //funcion para calcular personal de laboratorio activo
   function calcularPersonal() {
      var bioquimico = parseInt(document.getElementById('bioquimico').value) || 0;
      var tecnico = parseInt(document.getElementById('tecnico').value) || 0;
      var apoyo = parseInt(document.getElementById('apoyo').value) || 0;

      var personales = bioquimico + tecnico + apoyo;
      document.getElementById('personal').value = personales;
   };

   //funcion para calcular stock de pruebas
   function calcularStock() {
      var rcpcr = parseInt(document.getElementById('rcpcr').value) || 0;
      var inmunocro = parseInt(document.getElementById('inmunocro').value) || 0;
      var hemograma = parseInt(document.getElementById('hemograma').value) || 0;
      var hepatograma = parseInt(document.getElementById('hepatograma').value) || 0;

      var stock_pruebas = rcpcr + inmunocro + hemograma + hepatograma;
      document.getElementById('stock').value = stock_pruebas;
   };

   //funcion para calcular stock de pruebas de semana epidemiologica
   function calcularStock2() {
      var rcpcr = parseInt(document.getElementById('rcpcr').value) || 0;
      var elisa_ns1_epi = parseInt(document.getElementById('elisa_ns1_epi').value) || 0;
      var elisa_igc_epi = parseInt(document.getElementById('elisa_igc_epi').value) || 0;
      var elisa_igm_epi = parseInt(document.getElementById('elisa_igm_epi').value) || 0;
      var hemograma_epi = parseInt(document.getElementById('hemograma_epi').value) || 0;
      var hepatograma_epi = parseInt(document.getElementById('hepatograma_epi').value) || 0;

      var stock_pruebas2 = rcpcr + elisa_ns1_epi + elisa_igc_epi + elisa_igm_epi + hemograma_epi + hepatograma_epi;
      document.getElementById('stock').value = stock_pruebas2;
   };

$(document).ready(function()
{
   $("#Layer2").stickylayer({orientation: 3, position: [45, 50], delay: 500});
    //$("#wb_ResponsiveMenu1").affix({offset:{top: $("#wb_ResponsiveMenu1").offset().top}});
   $('.seleccion').select2();

   function enviarFormulario(){
      $('#guardar').attr("disabled", "disabled");
      $.ajax({
         url : 'insertar_monitoreo.php',
         method : 'POST',
         data : $('#form').serialize(),
         success: function(data){
            try{
               response = JSON.parse(data);
               if (response.status == "success")
               {
                  $('#guardar').removeAttr("disabled");
                  alert(response.message);
                  document.getElementById("form").reset();
                  //redirege a otra pagina despues de 3 segundos
                  setTimeout(function(){ window.location="monitoreos.php"; },  3000);                  
               }
               else
               {
                  alert(response.message);
                  $('#guardar').removeAttr("disabled");
               }
            }catch(error){
               alert("Advertencia ocurrio un error intentado resolver la solicitud. Por favor contacte con el administrador del sistema");
               console.log(error);
            }
         },
         error: function(error){
            alert("Advertencia ocurrio un error intentado comunicarse con el servidor. Por favor contacte con el administrador de la red");
            console.log(error);
         }
      });
   };
   
   $('#form').submit(function(e){  
      e.preventDefault();
      
      if($('#codregion').val() == ""){        
         alert('Favor seleccionar una region');
         return; 
      }else if($('#laboratorio').val() == ""){        
         alert('Favor de ingresar el laboratorio');
         return; 
      }else if($('#semana').val() == ""){        
         alert('Favor seleccionar la semana epidemiologica');
         return; 
      }else if($('#horario').val() == ""){        
         alert('Favor cargar el horario de cobertura');
         return; 
      }else if($('#cantidad_paciente').val() == ""){        
         alert('Favor cargar la cantidad de pacientes atendidos5');
         return; 
      }else if($('#cantidad_paciente_bio').val() == ""){        
         alert('Favor cargar la cantidad de pacientes atendidos para Biologia Molecular');
         return; 
      }else if($('#hospitalizado').val() == "" ){        
         alert('Favor cargar el Número de pacientes Hospitalizado2');
         return; 
      }else if($('#obito').val() == "" ){        
         alert('Favor cargar el Número de pacientes Obito');
         return; 
      }else if($('#ambulatoria').val() == "" ){        
         alert('Favor cargar el Número de pacientes  Ambulatoria');
         return; 
      }else if($('#pruebas_total').val() == ""){        
         alert('Favor cargar el Número de pruebas realizadas en la semana epedemiologica');
         return; 
      }else if($('#bioquimico').val() == ""){        
         alert('Favor cargar el Número de Bioquímicos');
         return; 
      }else if($('#tecnico').val() == ""){        
         alert('Favor cargar el Número de Técnico de Laboratorio');
         return; 
      }else if($('#apoyo').val() == ""){        
         alert('Favor cargar el Número de Apoyo Administrativo');
         return; 
      }else if($('#bioactivo').val() == ""){        
         alert('Favor cargar el Número de Bioquímicos activos');
         return; 
      }else if($('#rcpcr').val() == ""){        
         alert('Favor cargar el Número de Pruebas RT-PCR');
         return; 
      }else if($('#rcpcr').val() == ""){        
         alert('Favor cargar el Número de Pruebas RTP-PCR');
         return; 
      }else if($('#pcr').val() == ""){        
         alert('Favor cargar el Número de Pruebas PCR');
         return; 
      }else if($('#elisa_igc').val() == "" || $('#elisa_igc_epi').val() == ""){        
         alert('Favor cargar el Número de Pruebas Elisa IgG');
         return; 
      }else if($('#elisa_igm').val() == "" || $('#elisa_igm_epi').val() == ""){        
         alert('Favor cargar el Número de Pruebas Elisa IgM');
         return; 
      }else if($('#elisa_ns1').val() == "" || $('#elisa_ns1_epi').val() == ""){        
         alert('Favor cargar el Número de Pruebas EElisa NS1');
         return; 
      }else if($('#inmunocro').val() == ""){        
         alert('Favor cargar el Número de Pruebas Inmunocromatográfico');
         return; 
      }else if($('#hemograma').val() == "" || $('#hemograma_epi').val() == ""){        
         alert('Favor cargar el Número de Pruebas Hemograma');
         return; 
      }else if($('#hepatograma').val() == "" || $('#hepatograma_epi').val() == ""){        
         alert('Favor cargar el Número de Pruebas Hepatograma');
         return; 
      }else if($('#rnombre').val() == "" || $('#rcontacto').val() == "" || $('#remail').val() == ""){        
         alert('Favor cargar los Datos del Responsable de la carga');
         return; 
      }else {        
         enviarFormulario();
      }
   });
   
   


});
</script>
<script type="text/javascript" src="js/script.js"></script>




</body>
</html>
