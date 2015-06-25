<?php
include("../../../clases/conexion.php");
$idPersona = $_GET['idpersonal'];
$ConsultaPersonal="SELECT * FROM PERSONAL WHERE idPERSONAL='$idPersona'";
$QueryPersonal=mysqli_query($conn,$ConsultaPersonal);
$fila=mysqli_fetch_assoc($QueryPersonal);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="esP">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
    <title>Informacion Personal</title>
</head>
<body>
	<div class="container">
		<h1>Informacion Personal</h1>
		<br>
		<label>Nombre:</label><label><?php echo $fila['Nombre']; ?></label>
		<br>
		<label>Apellidos:<?php echo $fila['ApellidoPaterno'],' ',$fila['ApellidoMaterno']; ?></label>
		<br>
		<h3>Datos de sesion</h3>
		<label>Nombre Usuario: </label>
		<label><?php echo $fila['Usuario']; ?></label>
		<br>
		<label>Estatus: </label><label><?php echo $fila['Estatus']; ?></label>
		<br>
		<?php
		$catego = $fila['Categoria'];
		switch ($catego) {
			case '1':
				$catego = "Admnistrador";
				break;
			case '2':
				$catego = "Jefe de Produccion";
				break;
			case '3':
				$catego = "Vendedor";
				break;
			case '4':
				$catego = "Trabajador";
				break;
			default:
				# code...
				break;
		}
		?>
		<label>Categoria: </label><label><?php echo $catego; ?></label>
		<br>
		<a class="btn btn-success" href="../">Continuar</a>
		<a class="btn btn-warning" href="../Editar/">Modificar</a>
	</div>
</body>
</html>