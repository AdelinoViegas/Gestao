<?php
require_once "../../connection.php";
require_once "../../features/getData.php";
session_start();

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
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>

  <div class="divsuperior2">
    <div class="divflex">
      <div>
        <h5>Ver-notas</h5>
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

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Gerenciar</h5>
    </div>

    <form action="" method="post">
      <div class="row">
        <div class="form-group col-md-4" id="margemB">
          <label for="textdisciplina">Aluno</label>
          <select id="textdisciplina" class="input form-control" name="student_id" required>
            <option value="">Selecione aqui</option>

            <?php $query = getData($connection, "SELECT s.name_s, s.id_s, r.id_r FROM tb_students AS s INNER JOIN tb_responsibles AS r ON s.responsibleID_s = r.id_r WHERE responsibleID_s =?", [$responsible_id]);
            foreach ($query as $data)
              echo "<option value = '" . $data['id_s'] . "'>" . $data['name_s'] . "</option>";
            ?>
          </select>
        </div>

        <div class="form-group col-md-4" id="margemB">
          <label for="ttrimAluno">Trimestres</label>
          <select id="ttrimAluno" class="input form-control" name="quarter" required>
            <option value="">Selecione aqui</option>
            <option value="1">1ª Trimestre</option>
            <option value="2">2ª Trimestre</option>
            <option value="3">3ª Trimestre</option>
          </select>
        </div>

        <div class="col-md-2" id="margemB">
          <label></label>
          <button type="submit" class="btn btn-success col-md-12" name="btn-notes">Ver-notas</button>
        </div>
      </div>
    </form>
  </div>

  <?php require_once "../../footer2.php"; ?>
  <script src="routing.js"></script>
</body>
</html>