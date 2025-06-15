<?php
session_start();
require_once "../../connection.php";

if (!isset($_SESSION['logged']))
  header("Location: ../../index.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>principal</title>
  <?php require_once "../../head2.php"; ?>
</head>
<body>
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>
  <div class="divsuperior2">
    <div class="divflex">
      <div>
        <h5>Pailnel-principal</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../../img/person.svg" id="IMG">
        <h5 class="me-3">Encarregado</h5>
      </div>
    </div>
  </div>

  <?php require_once "nav-responsibles.php" ?>
  <?php require_once "navMob-responsibles.php" ?>

  <div id="imagem">
    <img src="../../img/enc-escola.png">
  </div>

  <?php require_once "../../footer2.php"; ?>
  <script src="routing.js"></script>
</body>
</html>