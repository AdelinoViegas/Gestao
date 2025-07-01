<?php
session_start();
require_once "../../connection.php";
require_once "../../features/getData.php";

$professor_id = mysqli_real_escape_string($connection, trim($_SESSION['professor_id']));

if (isset($_POST['btn-search'])) {
  $_SESSION['quarter'] = mysqli_real_escape_string($connection, trim($_POST['quarter']));
  $_SESSION['management_id'] = mysqli_real_escape_string($connection, trim($_POST['management']));
  header('Location: student-notes.php');
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
        <h5 class="fs-5 fw-bold m-0">Notas-Trimestrais</h5>
      </div>
      <div class="d-flex py-1">
        <h5 class="mb-0 me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../../img/person.svg" id="IMG">
        <h5 class="mb-0 me-3 fs-5 fw-bold">Professor</h5>
      </div>
    </div>
  </div>

  <?php require_once "nav-professor.php"; ?>
  <?php require_once "navMob-professor.php"; ?>
  
  <div class="fs-6 fw-bold rounded-3" id="container-table">
    <div class="gap-2 py-2" id="head-third">
      <h5>Gerenciar</h5>
    </div>

    <form action="" method="post">
      <div class="row margB">
        <div class="col-md-4">
          <label for="textdisciplina">Disciplina e Turma</label>
          <select id="textdisciplina" class="form-select" name="management" required>
            <option value="">Selecione aqui</option>
            <?php $query = getData($connection, "SELECT m.id_m, g.name_g, d.name_d FROM tb_management AS m JOIN tb_disciplines AS d ON m.disciplineID_m = d.id_d JOIN tb_professors AS p ON m.professorID_m = p.id_p JOIN tb_groups AS g ON m.groupID_m = g.id_g WHERE p.id_P =?", [$professor_id]);
            foreach ($query as $data) 
              echo "<option value = '" . $data['id_m'] . "'>" . $data['name_d'] . " - " . $data['name_g'] . "</option>";            
            ?>
          </select>
        </div>

        <div class="col-md-4">
          <label for="texttrimestre">Trimestres</label>
          <select id="texttrimestre" class="form-select" name="quarter" required>
            <option value="">Selecione aqui</option>
            <option value="1">1ª Trimestre</option>
            <option value="2">2ª Trimestre</option>
            <option value="3">3ª Trimestre</option>
          </select>
        </div>

        <div class="col-md-2">
          <label></label>
          <button type="submit" class="btn btn-success col-md-12" name="btn-search">Buscar</button>
        </div>
      </div>
    </form>
  </div>

  <?php require_once "../../footer2.php"; ?>
  <script src="routing.js"></script>
</body>
</html>