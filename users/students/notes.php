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
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>

  <div class="divsuperior2">
    <div class="divflex">
      <div>
        <h5>Notas-Trimestrais</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../../img/person.svg" id="IMG">
        <h5 class="me-3">Aluno</h5>
      </div>
    </div>
  </div>

  <?php require_once "nav-student.php" ?>
  <?php require_once "navMob-student.php" ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Notas-Trimestrais</h5>
    </div>

    <form action="" method="post">
      <div class="row margB">
        <div class="form-group col-md-4" id="margemB">
          <label for="ttrimAluno">Trimestres</label>
          <select id="ttrimAluno" class="input form-control" name="quarter" required>
            <option value="">Selecione aqui</option>
            <option value="1">1ª Trimestre</option>
            <option value="2">2ª Trimestre</option>
            <option value="3">3ª Trimestre</option>
          </select>
        </div>

        <div class="form-group col-md-2" id="margemB">
          <label></label>
          <button type="submit" id="inserir" class="btn btn-success col-md-12" name="search">Buscar</button>
        </div>
      </div>
    </form>
  </div>

  <?php require_once "../../footer2.php"; ?>
  <script src="routing.js"></script>
</body>
</html>