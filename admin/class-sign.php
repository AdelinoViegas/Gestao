<?php
session_start();
require_once "../connection.php";
require_once "../features/getData.php";
require_once "../features/signData.php";
require_once "../features/setMessage.php";

if (isset($_POST['btn-cadastre'])) {
  $name = mysqli_real_escape_string($connection, trim($_POST['name']));
  $class_data = getData($connection, "SELECT * FROM tb_class WHERE name_c=?", [$name]);

  if ($class_data) {
    setMessage("class-message", "alert-warning", "A classe já foi cadastrada!");
  } else {
    $sign_class = signData(
      $connection,
      "INSERT INTO tb_class(name_c) VALUES (?)",
      [$name]
    );

    if ($sign_class) 
      setMessage("class-message", "alert-success", "Classe cadastrado com sucesso!");
    else 
      setMessage("class-message", "alert-danger", "Erro ao cadastrar!");
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
        <h5 class="fs-5 fw-bold">Formulário de cadastramento de classes</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3 fs-5 fw-bold">Administrador</h5>
      </div>
    </div>
  </div>

  <?php
  if (isset($_SESSION['class-message'])) {
    echo $_SESSION['class-message'];
    unset($_SESSION['class-message']);
  }
  ?>

  <?php require_once "navigation.php" ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fs-6 fw-bold rounded-3" id="container-table">
    <div id="head-third">
      <h5>Formulário de cadastramento de classes</h5>
    </div>
    <form action="class-sign.php" method="post">
      <div class="row mb-4">
        <div class="col-md-4">
          <label for="textname">Nome</label>
          <input type="text" id="textname" class="form-control" name="name" maxlength="30"
            placeholder="Nome da classe" required>
        </div>
      </div>

      <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-outline-primary btn-block col-md-2" name="btn-cadastre">Salvar</button>

        <a href="menu-class.php" class="btn btn-outline-secondary btn-block col-md-2" name="btn-voltar">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>