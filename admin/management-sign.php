<?php
session_start();
require_once "../connection.php";
require_once "../features/signData.php";
require_once "../features/getData.php";
require_once "../features/getCurrentDate.php";
require_once "../features/setMessage.php";

if (isset($_POST['btn-sign'])) {
  $discipline = mysqli_real_escape_string($connection, trim($_POST['discipline']));
  $professor = mysqli_real_escape_string($connection, trim($_POST['professor']));
  $group = mysqli_real_escape_string($connection, trim($_POST['group']));
  $date = '2022';

  $management_data = getData(
    $connection, 
    "SELECT * FROM tb_management WHERE disciplineID_m=? AND professorID_m=? AND groupID_m=?", 
    [$discipline, $professor, $group]
  );

  if ($management_data) {
    setMessage("management-message", "alert-warning", "Dados já existentes!");
  }else{
    $sign_management = signData(
      $connection, 
      "INSERT INTO tb_management(disciplineID_m, professorID_m, groupID_m, year_m) VALUES (?,?,?,?)",
      [$discipline, $professor, $group, $date]
    );

    if($sign_management)
      setMessage("management-message", "alert-success",  "Dados cadastrado com sucesso!");
    else
      setMessage("management-message", "alert-danger", "Erro ao cadastrar!!");
  } 
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Samiga</title>
  <?php require_once "head.php"; ?>
</head>
<body>
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>

  <div class="divsuperior2">
    <div class="divflex">
      <div>
        <h5>Gerenciar</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
      </div>
    </div>
  </div>

  <?php
  if (isset($_SESSION['management-message'])) {
    echo $_SESSION['management-message'];
    unset($_SESSION['management-message']);
  }
  ?>

  <?php require_once "navigation.php" ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Gerenciar</h5>
    </div>
    <form action="management-sign.php" method="post">
      <div class="row margB">
        <div class="form-group col-md-4" id="margemB">
          <label for="textdisciplina">Disciplinas</label>
          <select id="textdisciplina" class="input form-control" name="discipline" required>
            <option value="">Selecione aqui</option>
            <?php $discipline_data = getData($connection, "SELECT id_d, nome_d FROM tb_disciplines ORDER BY name_d");
            foreach ($discipline_data as  $data) 
              echo "<option value = '" . $data['id_d'] . "'>" . $data['name_d'] . "</option>";
            ?>
          </select>
        </div>
        <div class="form-group col-md-4" id="margemB">
          <label for="textprofessor">Professores</label>
          <select id="textprofessor" class="input form-control" name="professor" required>
            <option value="">Selecione aqui</option>
            <?php $professor_data = getData($connection, "SELECT id_p, nome_p FROM tb_professors ORDER BY name_p");
            foreach ($professor_data as $data) 
              echo "<option value = '" . $data['id_p'] . "'>" . $data['name_p'] . "</option>";
            ?>
          </select>
        </div>
        <div class="form-group col-md-4" id="margemB">
          <label for="textturma">Turmas</label>
          <select id="textturma" class="input form-control" name="group" required>
            <option value="">Selecione aqui</option>
            <?php $group_data = getData($connection, "SELECT id_g, name_g FROM tb_groups ORDER BY name_g");
            foreach ($group_data as $data) 
              echo "<option value = '" . $data['id_g'] . "'>" . $data['name_g'] . "</option>";
            ?>
          </select>
        </div>
      </div>

      <div class="row marg">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-sign"
          id="margemBotao">Salvar</button>

        <div class="col-md-8" id="margemBotao"></div>

        <a href="menu-management.php" class="btn btn-outline-secondary btn-block col-md-2" name="btn-voltar"
          id="margemBotao">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>