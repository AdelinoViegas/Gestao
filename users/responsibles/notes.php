<?php
session_start();
require_once "../../connection.php";
require_once "../../features/getData.php";

$responsible_id = mysqli_real_escape_string($connection, trim($_SESSION['responsible_id']));

if(isset($_POST['btn-notes'])){
  $_SESSION['student_id'] = mysqli_real_escape_string($connection, trim($_POST['student_id']));
  $_SESSION['quarter'] = mysqli_real_escape_string($connection, trim($_POST['quarter']));
  header('Location: quarter-notes.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Samiga</title>
  <?php require_once "../../head2.php"; ?>
</head>
<body>
  <div class="m-0" id="head-main">
    <h1 class="text-white text-center fs-1 fw-bold m-0">Colégio Samiga</h1>
  </div>
  
  <div id="head-second">
    <div class="position-relative d-flex justify-content-between align-items-center">
      <div>
        <h5 class="fs-5 fw-bold m-0">Ver-notas</h5>
      </div>
      <div class="d-flex py-1">
        <h5 class="mb-0 me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../../img/person.svg" id="IMG">
        <h5 class="mb-0 me-3 fs-5 fw-bold">Encarregado</h5>
      </div>
    </div>
  </div>

  <?php require_once "nav-responsibles.php" ?>
  <?php require_once "navMob-responsibles.php" ?>

  <div class="fs-6 fw-bold rounded-3" id="container-table">
    <div class="gap-2 py-2" id="head-third">
      <h5>Gerenciar</h5>
    </div>

    <form action="" method="post">
      <div class="row">
        <div class="col-md-4">
          <label for="textdiscipline">Aluno</label>
          <select id="textdiscipline" class="form-select" name="student_id" required>
            <option value="">Selecione aqui</option>
            <?php $query = getData($connection, "SELECT s.name_s, s.id_s, r.id_r FROM tb_students AS s INNER JOIN tb_responsibles AS r ON s.responsibleID_s = r.id_r WHERE responsibleID_s =?", [$responsible_id]);
            foreach ($query as $data)
              echo "<option value = '" . $data['id_s'] . "'>" . $data['name_s'] . "</option>";
            ?>
          </select>
        </div>

        <div class="col-md-4">
          <label for="quarterstudent">Trimestres</label>
          <select id="quarterstudent" class="form-select" name="quarter" required>
            <option value="">Selecione aqui</option>
            <option value="1">1ª Trimestre</option>
            <option value="2">2ª Trimestre</option>
            <option value="3">3ª Trimestre</option>
          </select>
        </div>
        
        <div class="col-md-2 align-self-end" id="margin-top-button">
          <button type="submit" class="btn btn-success" name="btn-notes">Ver-notas</button>
        </div>
      </div>
    </form>
  </div>

  <?php require_once "../../footer2.php"; ?>
  <script src="routing.js"></script>
</body>
</html>