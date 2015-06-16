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
</body>
</html>