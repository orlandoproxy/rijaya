<?php
include('../../../clases/conexion.php');
$cadena="SELECT idCATEGORIA,Nombre FROM CATEGORIA";
$Catego=mysqli_query($conn,$cadena);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Nuevo Producto</title>
	<script src="../../../js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
	<script src="js/Insertar.js"></script>
</head>
<body>
	<h2>Nuevo Producto</h2>
	<div class="form-horizontal">  
		<div class="container">
			<div class="form-group">
				<label for="Clave" class="col-lg-2 control-label">Clave</label>
				<div class="col-lg-10">
					<input type="text" id="Clave" class="form-control" name="Clave" placeholder="Clave del Nuevo Producto"  />
				</div>
			</div>
			<div class="container">
			<div class="form-group">
				<label for="Nombre" class="col-lg-2 control-label">Nombre</label>
				<div class="col-lg-10">
					<input type="text" id="Nombre" name="Nombre" class="form-control" placeholder="Nombre del Nuevo Producto"  />
				</div>
			</div>
			<div class="form-group">
				<label for="Tipo" class="col-lg-2 control-label">Tipo de Producto</label>
				<div class="col-lg-10">
					<select id="Tipo" name="Tipo" class="form-control">
						<option >Linea</option>
						<option >Especial</option>
						<option >Prototipo</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="Estatus" class="col-lg-2 control-label">Estatus</label>
				<div class="col-lg-10">
					<select id="Estatus" name="Estatus" class="form-control">
						<option>Activo</option>
						<option>Suspendido</option>
						<option>Incompleto</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="Descripcion" class="col-lg-2 control-label">Descripcion</label>
				<div class="col-lg-10">
					<textarea id="Descripcion" name="Descripcion" class="form-control"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="Categoria" class="col-lg-2 control-label">Categoria</label>
				<div class="col-lg-10">
					<select id="Categoria" name="Categoria" class="form-control">
						<?php
						while ($fila=mysqli_fetch_array($Catego))
						{
							echo '<option>'.$fila['Nombre'].'</option>';
						}
						?>
					</select>

				</div>
			</div>
			<div class="col-lg-10">

				<label col-lg-2 control-label class="col-lg-2 control-label">Medidas:</label>
				<div class="col-lg-10">
					
					<input type="text" id="Medida1" >
					<label > * </label>					
					<input type="text" id="Medida2" >
					<label> * </label>
					<input type="text" id="Medida3">					
				</div>
			</div>
			<div id="mensaje" ></div>
		</div>
		<div class="container">
				<button id="insertar" class="btn btn-success">Continuar</button>
				<button class="btn btn-warning">Cancelar</button>
			</div>
	</div>
</body>
</html>