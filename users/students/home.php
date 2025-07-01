<?php
session_start();
require_once "../../connection.php";

if (!isset($_SESSION['logged']))
  header("Location: ../../index.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <?php require_once "../../head2.php"; ?>
</head>
<body>
  <div class="m-0" id="head-main">
    <h1 class="text-white text-center fs-1 fw-bold m-0">Colégio Samiga</h1>
  </div>
  
  <div id="head-second">
    <div class="position-relative d-flex justify-content-between align-items-center">
      <div>
        <h5 class="fs-5 fw-bold m-0">Pailnel-principal</h5>
      </div>
      <div class="d-flex py-1">
        <h5 class="mb-0 me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../../img/person.svg" id="IMG">
        <h5 class="mb-0 me-3 fs-5 fw-bold">Aluno</h5>
      </div>
    </div>
  </div>

  <?php require_once "nav-student.php" ?>
  <?php require_once "navMob-student.php" ?>

  <div id="image-main">
    <img src="../../img/aluno-escola.png">
  </div>

  <?php require_once "../../footer2.php"; ?>
  <script src="routing.js"></script>
</body>
</html>