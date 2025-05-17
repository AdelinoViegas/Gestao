<?php
require_once "../../connection.php";
require_once "../../features/getData.php";
session_start();

$professor_id = $_SESSION['professor_id'];

if (isset($_POST['btn-search'])) {
  $_SESSION['quarter'] = $_POST['quarter'];
  $_SESSION['management_id'] = $_POST['management'];
  header('Location: notasAlunos.php');
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

  <div class="navegacao">
    <ul>
      <li class="list">
        <a href="home.php">
          <span class="icon"><img src="../../img/home_white_24dp.svg"></span>
          <span class="title">HOME</span>
        </a>
      </li>
      <li class="list active">
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
            <?php $query = getData($connection, "SELECT g.id_g, t.nome_t, d.nome_d FROM sg_gerenciar AS g JOIN sg_disciplina AS d ON g.idDisciplina = d.id_d JOIN sg_professor AS p ON g.idProfessor = p.id_p JOIN sg_turma AS t ON g.idTurma = t.id_t WHERE p.id_P =?", [$professor_id]);
            foreach ($query as $data) 
              echo "<option value = '" . $data['id_g'] . "'>" . $data['nome_d'] . " - " . $data['nome_t'] . "</option>";            
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
</body>
</html>