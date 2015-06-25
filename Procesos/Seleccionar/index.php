<?php
include('../../clases/conexion.php');
session_start();
if (isset($_SESSION['id'])) 
{
	$id = $_SESSION['id'];

}
else
{
	if (isset($_GET['ID'])) 
	{
		$id=$_GET['ID'];
	}
	else
	{
		header('Location: ../ index.html');
	}
}
echo $id;
$consulta= "SELECT * FROM REMPLAZO WHERE idPEDIDO = '$id'";
$query1=mysqli_query($conn,$consulta);
$fila=mysqli_fetch_array($query1);

unset($_SESSION['id']);
unset($_GET['ID']);

?>
<html lang="esp">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<title>Informacion General</title>
</head>
<body>
	<div class="container">
		<h2>Informcacion General del Pedido N°<?php echo $fila['Pedido']; ?></h2>
		<label class="form-control">Fecha de Entrega : <?php echo $fila['FechaEntrega']; ?></label>
		<label class="form-control">Estatus: <?php echo $fila['Estatus']; ?></label>
		<h5>Procesos</h5>
		<label class="form-inline">Corte:<?php echo $fila['Corte'],"%"; ?></label>
		<div class="progress">
		  	<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fila['Corte']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $fila['Corte']; ?>%;">
  		    </div>
		</div>
		<label class="form-inline">Prensado:<?php echo $fila['Prensado'],"%"; ?></label>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fila['Prensado']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $fila['Prensado']; ?>%;">
			</div>
		</div>
		<label class="form-inline">Doblado:<?php echo $fila['Doblado'],"%"; ?></label>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fila['Doblado']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $fila['Doblado']; ?>%;">
			</div>
		</div>
		<label class="form-inline">Soldadura:<?php echo $fila['Soldadura'],"%"; ?></label>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fila['Prensado']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $fila['Soldadura']; ?>%;">
			</div>
		</div>
		<label class="form-inline">Lavado:<?php echo $fila['Lavado'],"%"; ?></label>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fila['Prensado']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $fila['Lavado']; ?>%;">
			</div>
		</div>
		<label class="form-inline">Pintura:<?php echo $fila['Pintura'],"%"; ?></label>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fila['Pintura']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $fila['Lavado']; ?>%;">
			</div>
		</div>		
		<label class="form-inline">Terminado:<?php echo $fila['Soldadura'],"%"; ?></label>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $fila['Prensado']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $fila['Prensado']; ?>%;">
			</div>
		</div>
		<?php
		$total= $fila['Corte']+$fila['Prensado']+$fila['Doblado']+$fila['Soldadura']+$fila['Lavado']+$fila['Pintura']+$fila['Terminado']; 
		$barra = $total/7;
		
		?>
		<label class="form-inline">Total: <?php echo ceil($barra),"%"; ?></label>
		<div class="progress">
			<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $barra; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ceil($barra); ?>%;">
			</div>
		</div>	
		<label class="form-control">REFERENCIA RIJAYA COMERCIAL : <?php echo $fila['ReferenciaVentas']; ?></label>	
	<a class="btn btn-success" href="../index.html">Continuar</a>
	<a class="btn btn-info" href="../Modificar/index.php">Modificar</a>

	</div>

</body>
</html>
<?php 
mysqli_close($conn);
?>