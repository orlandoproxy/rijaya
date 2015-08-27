<<<<<<< HEAD
<!DOCTYPE html>
<html lang="esp">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Acceso</title>
<!-- codigo css -->
    <link rel="icon" href="/iconos/favicon.jpg">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-switch.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
    </style>

    <script src="./js/jquery.js"></script>
    <script src="./js/mijava.js"></script>

    <!-- Custom styles for this template -->
 
<!-- -->
</head>
<body>
    <div class="container">

      <div class="form-signin">
        <div class="row">
            <a id="automatico" class="btn btn-success" href='JavaScript:Automatico();'>Automatico</a>
        <a id="manual" class="btn btn-warning" href='JavaScript:Manual();'>Manual</a>
        </div>
        <h2 class="form-signin-heading">Ingrese sus Datos</h2>
        <div id="tipo">
          <input type='text' id='usuario' class='form-control' placeholder='Usuario' required='' autofocus=''>
          <input type='password' id='pass' class='form-control' placeholder='Contraseña' required=''>
          <a class='btn btn-lg btn-primary btn-block'  id='ingresar' href='JavaScript:AgregarManual();'>Ingresar </a>
        </div>
        
        <div class="alert-info" id="mensaje"></div>
      </div>

    </div>
=======
<!DOCTYPE HTML>
<html lang="esp">
<?php include_once __DIR__.'/web/layout/head.html'; ?>
<body>
<header>
    Develorm
<?php include_once __DIR__.'/web/layout/nav.html'; ?>
</header>
<?php 
if(isset($_GET['login']))
{
    if($_GET['login'] === "usuario")
    {
        include_once __DIR__.'/web/layout/loginusuario.html';     
    }
    elseif($_GET['login'] === "operador")
    {
        include_once __DIR__.'/web/layout/loginoperador.html';
    }
}
else
{
    include_once __DIR__.'/web/layout/loginoperador.html';
}
?>
>>>>>>> a924101382fda2dc3eeaaa65d2431054136902b5
</body>
</html>