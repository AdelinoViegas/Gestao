<?php
session_start();
require_once "../connection.php";
require_once "../features/signData.php";
require_once "../features/getData.php";
require_once "../features/setMessage.php";

if (isset($_POST['btn-cadastre'])) {
  $name = mysqli_real_escape_string($connection, trim($_POST['name']));

  $discipline_data = getData(
    $connection,
    "SELECT * FROM tb_disciplines WHERE name_d =?",
    [$name]
  );

  if ($discipline_data) {
    setMessage("discipline-message", "alert-danger", "A disciplina já foi cadastrada!");
  } else {
    $sign_discipline = signData(
      $connection,
      "INSERT INTO tb_disciplines(name_d) VALUES (?)",
      [$name]
    );

    if ($sign_discipline)
      setMessage("discipline-message", "alert-success", "Disciplina cadastrado com sucesso!");
    else
      setMessage("discipline-message", "alert-danger", "Erro ao cadastrar!");
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
        <h5 class="fs-5 fw-bold">Formulário de cadastramento de disciplinas</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3 fs-5 fw-bold">Administrador</h5>
      </div>
    </div>
  </div>

  <?php
  if (isset($_SESSION['discipline-message'])) {
    echo $_SESSION['discipline-message'];
    unset($_SESSION['discipline-message']);
  }
  ?>

  <?php require_once "navigation.php" ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fs-6 fw-bold rounded-3" id="container-table">
    <div id="head-third">
      <h5>Formulário de cadastramento de disciplinas</h5>
    </div>
    <form action="disciplines-sign.php" method="post">
      <div class="row mb-4">
        <div class="col-md-4">
          <label for="textname">Nome</label>
          <input type="text" id="textname" class="form-control" name="name" maxlength="30"
            placeholder="Nome da disciplina" required>
        </div>
      </div>

      <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-outline-primary btn-block col-md-2" name="btn-cadastre">Cadastrar</button>

        <a href="menu-disciplines.php" class="btn btn-outline-secondary btn-block col-md-2" id="margemBotao">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>