<?php
session_start();
if (isset($_SESSION['idproceso']))
{
	$proceso=$_SESSION['idproceso'];
}
else
{

	 header('location: ../../');
}
include("../../clases/conexion.php");

?>
<!DOCTYPE html>
<html lang="esp">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Maquinado</title>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<script type="text/javascript" src="../../js/jquery.js"></script>
	<script type="text/javascript" src="../../js/bootstrap.js"></script>
	<script type="text/javascript" src="js/carga.js"></script>
</head>
<body>
	<div class="container">

	<div class="row">
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">

		<div id="navbar" class="navbar-collapse collapse">
			<div class="navbar-form navbar-left">
				<label>Bienvenido:<?php
				$idoperdor=$_SESSION['id'];
				echo $idoperdor;
				$selecionaroperador="SELECT Nombre,ApellidoPaterno,ApellidoMaterno FROM PERSONAL WHERE idPERSONAL=$idoperdor";
				$queryoperador=mysqli_query($conn,$selecionaroperador);
				$fila=mysqli_fetch_assoc($queryoperador);
				echo $fila['Nombre']," ",$fila['ApellidoPaterno']," ",$fila['ApellidoMaterno'];


				 ?></label>
			</div>
			<div class="navbar-form navbar-right">
				<a class="btn btn-warning" href="../clases/Salir.php">Salir</a>
			</div>
		</div>
			</div>
	</nav>

	</div>
	<br>
	<br>
	<br>
	<br>
	<div class="row">
		<label for="lista">Seleccione una orden de proceso</label>
		<select id="lista" class="form-control">
			<option> ... </option>
			<?php
			$selecionarpedidos="SELECT * FROM ORDENPROCESO WHERE Estatus='Iniciado'";
			$querypedido=mysqli_query($conn,$selecionarpedidos);
			while ($filapedido=mysqli_fetch_array($querypedido))
			{
				echo '<option value="'.$filapedido["idORDENPROCESO"].'">'.$filapedido["Clave"].'</option>';
			}
			 ?>
		</select>
		<div id="contenido" >
			<input class="btn btn-primary" id="boton1" type="button" value="Inicio" onclick="boton(this.name,'boton1,boton2,boton3')" />
			<d>
			<input class="btn btn-warning" id="boton2" type="button" value="Pausa" onclick="boton(this.name,'boton1,boton2,boton3')"/>
			<d>
			<input class="btn btn-danger" id="boton3" type="button" value="Finalizar" onclick="boton(this.name,'boton1,boton2,boton3')" />
			<d>
			<script type="text/javascript">
			//Esta funcion servira, pone en nombreBotones los nombres de los botones separados por coma como se ve en el ejemplo de arriba
			function desactivar(name,nombreBotones){
				var partesBotones = nombreBotones.split(",");
				for(i=0;i<partesBotones.length;i++){
					var boton = document.getElementById(partesBotones[i]);
					if(boton.name == name)boton.disabled = false;
					else boton.disabled = true;
				}
			}
			</script>
		</div>
	</div>
</body>
</html>
<?php
mysqli_close($conn);
?>
