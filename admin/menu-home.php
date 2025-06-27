<?php
session_start();
require_once "../connection.php";

if (!isset($_SESSION['logged'])) 
  header("Location: ../index.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Samiga</title>
  <?php require_once "head.php"; ?>
</head>
<body>
  <div class="m-0" id="head-main">
    <h1 class="text-white text-center fs-1 fw-bold">Colégio Samiga</h1>
  </div>
  
  <div id="head-second">
    <div class="position-relative d-flex justify-content-between">
      <div>
        <h5 class="fs-5 fw-bold">Painel-principal</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3 fs-5 fw-bold">Administrador</h5>
      </div>
    </div>
  </div>

  <?php require_once "navigation.php"; ?>
  <?php require_once "navbarMobile.php"; ?>

  <div id="image-main">
    <img src="../img/admin.png">
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>