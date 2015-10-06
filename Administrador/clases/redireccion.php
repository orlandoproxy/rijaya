<?php
session_start();
  if (isset($_SESSION['categoria']))
  {

  }
  else
  {
    header('Location: ../');
  }
 ?>
