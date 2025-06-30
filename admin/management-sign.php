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
  $date = Date('Y');
  
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
  <div class="m-0" id="head-main">
    <h1 class="text-white text-center fs-1 fw-bold">Colégio Samiga</h1>
  </div>
  
  <div id="head-second">
    <div class="position-relative d-flex justify-content-between">
      <div>
        <h5 class="fs-5 fw-bold">Gerenciar</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3 fs-5 fw-bold">Administrador</h5>
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

  <div class="fs-6 fw-bold rounded-3" id="container-table">
    <div id="head-third">
      <h5>Gerenciar</h5>
    </div>
    <form action="management-sign.php" method="post">
      <div class="row mb-4">
        <div class="col-md-4">
          <label for="textdiscipline">Disciplinas</label>
          <select id="textdiscipline" class="form-select" name="discipline" required>
            <option value="">Selecione aqui</option>
            <?php $discipline_data = getData($connection, "SELECT * FROM tb_disciplines ORDER BY name_d");
            foreach ($discipline_data as  $data) 
              echo "<option value = '" . $data['id_d'] . "'>" . $data['name_d'] . "</option>";
            ?>
          </select>
        </div>

        <div class="col-md-4">
          <label for="textprofessor">Professores</label>
          <select id="textprofessor" class="form-select" name="professor" required>
            <option value="">Selecione aqui</option>
            <?php $professor_data = getData($connection, "SELECT id_p, name_p FROM tb_professors ORDER BY name_p");
            foreach ($professor_data as $data) 
              echo "<option value = '" . $data['id_p'] . "'>" . $data['name_p'] . "</option>";
            ?>
          </select>
        </div>
        <div class="col-md-4">
          <label for="textgroup">Turmas</label>
          <select id="textgroup" class="form-select" name="group" required>
            <option value="">Selecione aqui</option>
            <?php $group_data = getData($connection, "SELECT * FROM tb_groups ORDER BY name_g");
            foreach ($group_data as $data) 
              echo "<option value = '" . $data['id_g'] . "'>" . $data['name_g'] . "</option>";
            ?>
          </select>
        </div>
      </div>

      <div class="d-flex justify-content-between mt-4">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-sign">Salvar</button>

        <a href="menu-management.php" class="btn btn-outline-secondary btn-block col-md-2">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>