<?php
function Personal($usuario,$contra)
{
	include('../clases/conexion.php');
	$seleccionarUsuario="SELECT Usuario FROM PERSONAL WHERE Usuario='$usuario'  AND Estatus='Activo'";
		$queryusu=mysqli_query($conn,$seleccionarUsuario);
		if (mysqli_fetch_assoc($queryusu)>0) 
			{
				$pass=md5($contra);
				//si el personal existe
				$selectcontraseña="SELECT * FROM PERSONAL WHERE Usuario='$usuario' AND Contra='$pass'";
				$queryContra=mysqli_query($conn,$selectcontraseña);
				if (mysqli_fetch_assoc($queryContra)>0) 
					{
						$selectcontraseña="SELECT * FROM PERSONAL WHERE Usuario='$usuario' AND Contra='$pass'";
						$queryContra1=mysqli_query($conn,$selectcontraseña);
						session_start();
						while ($fila=mysqli_fetch_array($queryContra1)) 
						{
							$catego=$fila['Categoria'];
							$_SESSION['id']=$fila['idPERSONAL'];
							$_SESSION['categoria']=$catego;
							switch ($catego) {
								case '1':
									echo '3';
								break;
								case '2':
									echo '4';
								break;
								case '3':
									echo '5';
								break;
								case '4':
									echo '6';
								break;
								case '5':
									echo '7';
								break;
								
							}
						}
					}
				else
					{
						//la contraseña es incorrecta
						echo '2';
					}
			}
		else
			{
				echo '1';
			}
mysqli_close($conn);

}
if (isset($_POST['usu']) and isset($_POST['pass'])) 
	{
		$usu = addslashes($_POST['usu']);
		$pass = addslashes($_POST['pass']);

		Personal($usu,$pass);
		
	}
		elseif (isset($_POST['escaneo'])) 
		{
			$escaneo=$_POST['escaneo'];
			$lista=explode("-", $escaneo);
			if (isset($lista[1])) 
				{
					Personal($lista[0],$lista[1]);					
				}
			else
				{
					echo '0';
				}

		}
else
{
	
}
?>