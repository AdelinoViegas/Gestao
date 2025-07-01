<?php
session_start();
require_once "../../connection.php";

if (isset($_POST['search'])) {
  $_SESSION['quarter'] = $_POST['quarter'];
  header('Location: quarter.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>principal</title>
  <?php require_once "../../head2.php"; ?>
</head>
<body>
  <div class="m-0" id="head-main">
    <h1 class="text-white text-center fs-1 fw-bold m-0">Colégio Samiga</h1>
  </div>
  
  <div id="head-second">
    <div class="position-relative d-flex justify-content-between align-items-center">
      <div>
        <h5 class="fs-5 fw-bold m-0">Notas-Trimestrais</h5>
      </div>
      <div class="d-flex py-1">
        <h5 class="mb-0 me-2 fs-5 fw-bold">Usuário:</h5>
        <img class="me-1" src="../../img/person.svg" id="IMG">
        <h5 class="mb-0 me-3 fs-5 fw-bold">Aluno</h5>
      </div>
    </div>
  </div>

  <?php require_once "nav-student.php" ?>
  <?php require_once "navMob-student.php" ?>

  <div class="fs-6 fw-bold rounded-3" id="container-table">
    <div id="head-third">
      <h5 class="fs-6 m-0 py-2 ps-3">Notas-Trimestrais</h5>
    </div>

    <form action="" method="post">
      <div class="row mb-4">
        <div class="form-group col-md-4" id="margemB">
          <label for="quarterstudent">Trimestres</label>
          <select id="quarterstudent" class="form-select" name="quarter" required>
            <option value="">Selecione aqui</option>
            <option value="1">1ª Trimestre</option>
            <option value="2">2ª Trimestre</option>
            <option value="3">3ª Trimestre</option>
          </select>
        </div>

        <div class="col-md-2">
          <label></label>
          <button type="submit" class="btn btn-success col-md-12" name="search">Buscar</button>
        </div>
      </div>
    </form>
  </div>

  <?php require_once "../../footer2.php"; ?>
  <script src="routing.js"></script>
</body>
</html>