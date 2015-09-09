<!DOCTYPE html>
<html lang="esP">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
    <title>Modificar Personal</title>
</head>
<body>
	<?php
	include("../../../clases/conexion.php");
	$idPersona=$_GET['idpersonal'];
	session_start();
	$_SESSION['id']=$idPersona;
	$SelecionarPersonal="SELECT * FROM PERSONAL WHERE idPERSONAL='$idPersona'";
	$querySelecionar=mysqli_query($conn,$SelecionarPersonal);
	$fila=mysqli_fetch_assoc($querySelecionar);
	?>
	<div class="container">
		<h1>Modificar Personal</h1>
		<form method="post" action="ProcesoModificar.php">
			<div class="form-group">
				<label for="Nombre-modi" >Nombre</label>
				<input type="text" name="Nombre" id="Nombre-modi" class="form-control" value="<?php echo $fila['Nombre']; ?>">
			</div>
			<div class="form-group">
				<label for="ApellidoPa">Apellido Paterno</label>
				<input type="text" class="form-control" id="ApellidoPa" name="ApellidoPaterno" value="<?php echo $fila['ApellidoPaterno']; ?>">
			</div>
			<div class="form-group">
				<label for="ApellidoMa">Apellido Materno</label>
				<input type="text" class="form-control" id="ApellidoPa" name="ApellidoMaterno" value="<?php echo $fila['ApellidoMaterno']; ?>">
			</div>
			<h2>Datos de Sesion</h2>
			<div class="form-group">
				<label for="NombreUsu">Nombre Usuario</label>
				<input type="text" class="form-control" id="NombreUsu" name="NombreUsuario" value="<?php echo $fila['Usuario']; ?>">
			</div>
			<div class="form-group">
				<label for="Contra">Contraseña</label>
				<input type="text" class="form-control" id="Contra" name="Contrase" value="">
			</div>
			<?php
			$cate=$fila['Categoria'];
			switch ($cate)
			{
				case '1':
					$categoria="Administrador";
					break;
				case '2':
					$categoria="Jefe de Produccion";
					break;
				case '3':
					$categoria="Vendedor";
					break;
				case '4':
					$categoria="Trabajador";
					break;
					default:
					# code...
					break;
			}
			?>
				<div class="form-group">
				<label for="Categori">Categoria</label>
				<select id="Categori" name="Categoria" class="form-control" value="<?php echo $categoria; ?>">
				<option>Administrador</option>
				<option>Jefe de Produccion</option>
				<option>Vendedor</option>
				<option>Operador</option>
			</select>
			</div>
			<div class="form-group">

				<label for="Estatu">Estatus</label>
				<select id="Estatu" name="Estatus" class="form-control" value="<?php echo $fila['Estatus']; ?>">
				<option>Activo</option>
				<option>Inactivo</option>
			</select>
			</div>
			<button class="btn btn-success" type="submit">Guardar</button>
      <a class="btn btn-warning" href="../">Cancelar</a>
		</form>
	</div>
</body>
</html>
