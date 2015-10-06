<?php
include('../clases/conexion.php');
//include('../clases/redireccion.php');
session_start();
$id= $_SESSION['id'];
$categoria= $_SESSION['categoria'];
$SelecionarNombre="SELECT * FROM PERSONAL WHERE idPERSONAL=$id";
$queryNombre=mysqli_query($conn,$SelecionarNombre);
$filanombre=mysqli_fetch_assoc($queryNombre);
$nombre=$filanombre['Nombre'];
?>
<html lang="esp">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Vendedores</title>
<link rel="stylesheet" href="../css/bootstrap.css" media="screen" title="no title" charset="utf-8">
<script type="text/javascript" src="../js/jquery.js"></script>
</head>
<body>
	<h1>Vendedor:<?php echo $nombre; ?></h1>
	<table class="table">
		<thead>
			<tr>
				<td>N° Pedido</td>
				<td>Estatus</td>
				<td>Prioridad</td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<?php
			$selecionarpedido="SELECT * FROM PEDIDO WHERE PERSONAL_idPERSONAL=$id";
			$querypedido=mysqli_query($conn,$selecionarpedido);
			while ($filapedido=mysqli_fetch_array($querypedido))
			{
				echo '<tr>';
				echo '<td>'.$filapedido['NumPedido'].'</td>';
				echo '<td>'.$filapedido['Estatus'].'</td>';
				echo '<td>'.$filapedido['Prioridad'].'</td>';
				echo '<td><a class="btn btn-primary" href="Selecionar/index.php?id='.$filapedido['idPEDIDO'].'">Seleccionar</a></td>';
				echo '</tr>';
			}
			 ?>
		</tbody>
	</table>
</body>
</html>
