<?php
session_start();
require_once "../connection.php";
require_once "../features/setMessage.php";
require_once "../features/getCurrentDate.php";
require_once "../features/updateData.php";

if (isset($_POST['btn-password'])) {
  $admin_id = mysqli_real_escape_string($connection, trim($_SESSION['admin_id']));
  $password = mysqli_real_escape_string($connection, trim($_POST['password']));
  $new_password = mysqli_real_escape_string($connection, trim($_POST['new_password']));
  $date = getCurrentDate();

  if ($password === $new_password) {
    $password = password_hash($new_password, PASSWORD_DEFAULT);
    
    $update_data = updateData(
      $connection, 
      "UPDATE tb_users SET password_u = ?, dateModification_u = ? WHERE id_u = ?",
      [$password, $date, $admin_id]
    );

    if($update_data)
      setMessage("settings-message", "alert-success", "Senha actualizada com sucesso!");
    else
      setMessage("settings-message", "alert-danger", "Erro ao actualizar!");
  } else {
    setMessage("settings-message", "alert-warning", "As senhas devem ser iguais");
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
        <h5>Configurações do Admin</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
      </div>
    </div>
  </div>

  <?php
  if (isset($_SESSION['settings-message'])) {
    echo $_SESSION['settings-message'];
    unset($_SESSION['settings-message']);
  }
  ?>

  <?php require_once "navigation.php"; ?>
  <?php require_once "navbarMobile.php"; ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Formulário de cadastramento de alunos</h5>
    </div>

    <form action="menu-set.php" method="post">
      <div class="row">
        <div class="form-group col-md-4 mb-3">
          <label for="textpassword">Senha</label>
          <input type="password" id="textpassword" class="form-control" name="password" maxlength="30"
            placeholder="Insira nova senha" required>
        </div>

        <div class="form-group col-md-4 mb-3">
          <label for="textpassword-confirm">Confirmar senha</label>
          <input type="password" id="textnewpassword-confirm" class="form-control" name="new_password" maxlength="30"
            placeholder="Confirmar nova senha" required>
        </div>

        <div class=" col-md-2 mb-3">
          <label></label>
          <button type="submit" id="inserir" class="btn btn-success col-md-12" name="btn-password">Gravar</button>
        </div>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>