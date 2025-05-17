<?php
require_once "../../connection.php";
session_start();

if (!isset($_SESSION['logged']))
  header("Location: ../../index.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Samiga</title>
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
        <h5 class="me-3">Professor</h5>
      </div>
    </div>
  </div>

  <div class="navegacao">
    <ul>
      <li class="list active">
        <a href="home.php">
          <span class="icon"><img src="../../img/home_white_24dp.svg"></span>
          <span class="title">HOME</span>
        </a>
      </li>
      <li class="list">
        <a href="lancar-notas.php">
          <span class="icon"><img src="../../img/perm_identity_white_24dp.svg"></span>
          <span class="title">Lancar-notas</span>
        </a>
      </li>
      <li class="list">
        <a href="exames.php">
          <span class="icon"><img src="../../img/format_list_numbered_white_24dp.svg"></span>
          <span class="title">Exame</span>
        </a>
      </li>
      <li class="list">
        <a href="settings.php">
          <span class="icon"><img src="../../img/settings.png"></span>
          <span class="title">Alterar-senha</span>
        </a>
      </li>
      <li class="list">
        <a href="../../logoult.php">
          <span class="icon"><img src="../../img/logout_white_24dp.svg"></span>
          <span class="title">Sair</span>
        </a>
      </li>
    </ul>
  </div>

  <?php require_once "navMob-professor.php"; ?>

  <div id="imagem">
    <img src="../../img/prof-escola.png">
  </div>

  <?php require_once "../../footer2.php"; ?>
</body>
</html>