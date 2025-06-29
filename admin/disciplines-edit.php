<?php
session_start();
require_once "../connection.php";
require_once "../features/getData.php";

$discipline_id = $_POST['discipline_id'];
$_SESSION['discipline_id'] = $discipline_id;

$data = getData($connection, "SELECT * FROM tb_disciplines WHERE id_d=?", [$discipline_id])[0];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Aluno</title>
  <?php require_once "head.php"; ?>
</head>
<body>
  <div class="m-0" id="head-main">
    <h1 class="text-white text-center fs-1 fw-bold">Colégio Samiga</h1>
  </div>
  
  <div id="head-second">
    <div class="position-relative d-flex justify-content-between">
      <div>
        <h5 class="fs-5 fw-bold">Editar dados da disciplina</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3 fs-5 fw-bold">Administrador</h5>
      </div>
    </div>
  </div>

  <?php require_once "navigation.php" ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fs-6 fw-bold rounded-3" id="container-table">
    <div id="head-third">
      <h5>Editar dados da disciplina</h5>
    </div>
    <form action="disciplines-edit-process.php" method="post">
      <div class="row mb-4">
        <div class="col-md-4">
          <label for="textname">Nome</label>
          <input type="text" id="textname" class="form-control" name="name" maxlength="30"
            value="<?= $data['name_d']; ?>" placeholder="Nome da disciplina" required>
        </div>
      </div>

      <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-outline-primary btn-block col-md-2" name="btn-update">Gravar</button>

        <a href="menu-disciplines.php" class="btn btn-outline-secondary btn-block col-md-2">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>