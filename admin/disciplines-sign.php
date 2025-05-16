<?php
require_once "../connection.php";
require_once "../features/signData.php";
require_once "../features/getData.php";
require_once "../features/setMessage.php";
session_start();

if (isset($_POST['btn-cadastre'])) {
  $name = mysqli_real_escape_string($connection, trim($_POST['name']));

  $discipline_data = getData(
    $connection,
    "SELECT * FROM sg_disciplina WHERE nome_d =?",
    [$name]
  );

  if ($discipline_data) {
    setMessage("discipline-message", "alert-danger", "A disciplina já foi cadastrada!");
  } else {
    $sign_discipline = signData(
      $connection,
      "INSERT INTO sg_disciplina(nome_d) VALUES (?)",
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
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>

  <div class="divsuperior2">
    <div class="divflex">
      <div>
        <h5>Formulário de cadastramento de disciplinas</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
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

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Formulário de cadastramento de disciplinas</h5>
    </div>
    <form action="disciplines-sign.php" method="post">
      <div class="row margB">
        <div class="form-group col-md-4" id="margemB">
          <label for="textnome">Nome</label>
          <input type="text" id="textnome" class="form-control" name="name" maxlength="30"
            placeholder="Nome da disciplina" required>
        </div>
      </div>

      <div class="row marg">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-cadastre"
          id="margemBotao">Cadastrar</button>

        <div class="col-md-8" id="margemBotao"></div>

        <a href="menu-disciplines.php" class="btn btn-outline-secondary btn-block col-md-2" name="btn-voltar"
          id="margemBotao">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>