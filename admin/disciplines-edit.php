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
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>

  <div class="divsuperior2">
    <div class="divflex">
      <div>
        <h5>Editar dados da disciplina</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
      </div>
    </div>
  </div>

  <?php require_once "navigation.php" ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Editar dados da disciplina</h5>
    </div>
    <form action="disciplines-edit-process.php" method="post">
      <div class="row margB">
        <div class="form-group col-md-4" id="margemB">
          <label for="textnome">Nome</label>
          <input type="text" id="textnome" class="form-control" name="name" maxlength="30"
            value="<?= $data['name_d']; ?>" placeholder="Nome da disciplina" required>
        </div>
      </div>

      <div class="row marg">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-update"
          id="margemBotao">Gravar</button>

        <div class="col-md-8" id="margemBotao"></div>

        <a href="menu-disciplines.php" class="btn btn-outline-secondary btn-block col-md-2" name="btn-voltar">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>