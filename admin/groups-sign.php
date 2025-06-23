<?php
session_start();
require_once "../connection.php";
require_once "../features/getData.php";
require_once "../features/setMessage.php";
require_once "../features/signData.php";

if (isset($_POST['btn-cadastre'])) {
  $class = mysqli_real_escape_string($connection, trim($_POST['class']));
  $name = mysqli_real_escape_string($connection, trim($_POST['group']));
  $group_data = getData($connection, "SELECT * FROM tb_groups WHERE name_g=?", [$name]);

  if ($group_data) {
    setMessage("group-message", "alert-warning", "A turma já foi cadastrada!");
  } else {
    $sign_group = signData(
      $connection,
      "INSERT INTO tb_groups(name_g, classID_g) VALUES (?,?)",
      [$name, $class]
    );

    if ($sign_group)
      setMessage("group-message", "alert-success", "Turma cadastrado com sucesso!");
    else
      setMessage("group-message", "alert-danger", "Erro ao cadastrar!");
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
        <h5>Formulário de cadastramento de turmas</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
      </div>
    </div>
  </div>

  <?php
  if (isset($_SESSION['group-message'])) {
    echo $_SESSION['group-message'];
    unset($_SESSION['group-message']);
  }
  ?>

  <?php require_once "navigation.php" ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Formulário de cadastramento de turmas</h5>
    </div>
    <form action="groups-sign.php" method="post">
      <div class="row margB">
        <div class="form-group col-md-4" id="margemB">
          <label for="textgender">Escolhe a classe</label>
          <select id="textgender" class="input form-control" name="class" required>
           <?php 
            $class_data = getData($connection, "SELECT * FROM tb_class");
            foreach($class_data as $class){?>
             <option value="<?= $class['id_c'] ?>"><?= $class['name_c'] ?></option> 
            <?php }?>
          </select>
        </div>
        <div class="form-group col-md-4" id="margemB">
          <label for="textname">Digite a Turma</label>
          <input type="text" id="textname" class="form-control" name="group" maxlength="30" placeholder="Nome da turma"
            required>
        </div>
      </div>

      <div class="row marg">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-cadastre"
          id="margemBotao">Cadastrar</button>

        <div class="col-md-8" id="margemBotao"></div>

        <a href="menu-groups.php" class="btn btn-outline-secondary btn-block col-md-2">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>