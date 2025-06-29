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
        <h5 class="me-3">Professor</h5>
      </div>
    </div>
  </div>

  <?php require_once "nav-professor.php"; ?>
  <?php require_once "navMob-professor.php"; ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Gerenciar</h5>
    </div>

    <form action="" method="post">
      <div class="row margB">
        <div class="form-group col-md-4" id="margemB">
          <label for="textdisciplina">Disciplina e Turma</label>
          <select id="textdisciplina" class="input form-control" name="management" required>
            <option value="">Selecione aqui</option>
            <?php $query = getData($connection, "SELECT m.id_m, g.name_g, d.name_d FROM tb_management AS m JOIN tb_disciplines AS d ON m.disciplineID_m = d.id_d JOIN tb_professors AS p ON m.professorID_m = p.id_p JOIN tb_groups AS g ON m.groupID_m = g.id_g WHERE p.id_P =?", [$professor_id]);
            foreach ($query as $data) 
              echo "<option value = '" . $data['id_m'] . "'>" . $data['name_d'] . " - " . $data['name_g'] . "</option>";            
            ?>
          </select>
        </div>

        <div class="form-group col-md-4" id="margemB">
          <label for="texttrimestre">Trimestres</label>
          <select id="texttrimestre" class="input form-control" name="quarter" required>
            <option value="">Selecione aqui</option>
            <option value="1">1ª Trimestre</option>
            <option value="2">2ª Trimestre</option>
            <option value="3">3ª Trimestre</option>
          </select>
        </div>

        <div class="form-group col-md-2" id="margemB">
          <label></label>
          <button type="submit" id="inserir" class="btn btn-success col-md-12" name="btn-search">Buscar</button>
        </div>
      </div>
    </form>
  </div>

  <?php require_once "../../footer2.php"; ?>
  <script src="routing.js"></script>
</body>
</html>