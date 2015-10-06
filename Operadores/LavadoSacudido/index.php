<?php
session_start();
if (isset($_SESSION['idproceso']))
{
	$proceso=$_SESSION['idproceso'];
	echo $proceso;
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
	<title>Ensamble</title>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<script type="text/javascript" src="../../js/jquery.js">	</script>
	<script type="text/javascript" src="js/carga.js">	</script>
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
		<div id="contenido">
		</div>
	</div>
</body>
</html>
<?php
mysqli_close($conn);
?>
