<?php
require_once "../../connection.php";
require_once "../../features/getCurrentDate.php";
require_once "../../features/setMessage.php";
require_once "../../features/getData.php";
require_once "../../features/updateData.php";
session_start();

if (isset($_POST['btn-password'])) {
  $responsible_id = mysqli_real_escape_string($connection, trim($_SESSION['responsible_id']));
  $password = mysqli_escape_string($connection, trim($_POST['password']));
  $new_password = mysqli_escape_string($connection, trim($_POST['new_password']));
  $date = getCurrentDate();

  if ($password === $new_password) {
    $password = password_hash($new_password, PASSWORD_DEFAULT);
    $responsible_data = getData($connection, "SELECT userID_r FROM tb_responsibles WHERE id_r=?", [$responsible_id])[0];
     
    $update_data = updateData(
      $connection, 
      "UPDATE tb_users SET password_u =?, dateModification_u =? WHERE id_u =?",
      [$password, $date, $responsible_data['userID_r']]
    );
    
    if($update_data)
      setMessage("settings-message", "alert-success", "Senha actualizada com sucesso!");
    else
      setMessage("settings-message", "alert-danger", "Erro a actualizar");

  } else {
    setMessage("settings-message", "alert-warning", "As senhas devem ser iguais");
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>principal</title>
  <?php require_once "../../head2.php"; ?>
</head>
<body>
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>

  <div class="divsuperior2">
    <div class="divflex">
      <div>
        <h5>Alterar senha</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../../img/person.svg" id="IMG">
        <h5 class="me-3">Encarregado</h5>
      </div>
    </div>
  </div>

  <?php
  if (isset($_SESSION['settings-message'])) {
    echo $_SESSION['settings-message'];
    unset($_SESSION['settings-message']);
  }
  ?>

  <?php require_once "nav-responsibles.php" ?>
  <?php require_once "navMob-responsibles.php" ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Formulário de cadastramento de alunos</h5>
    </div>
    <form action="settings.php" method="post">
      <div class="row">
        <div class="form-group col-md-4 mb-3">
          <label for="tsenha">Senha</label>
          <input type="password" id="tsenha" class="form-control" name="password" maxlength="30"
            placeholder="Insira nova senha" required>
        </div>

        <div class="form-group col-md-4 mb-3">
          <label for="tsenha">Confirmar senha</label>
          <input type="password" id="tsenha" class="form-control" name="new_password" maxlength="30"
            placeholder="Confirmar nova senha" required>
        </div>

        <div class=" col-md-2 mb-3">
          <label></label>
          <button type="submit" id="inserir" class="btn btn-success col-md-12" name="btn-password">Gravar</button>
        </div>
      </div>
    </form>
  </div>

  <?php require_once "../../footer2.php"; ?>
  <script src="routing.js"></script>
</body>
</html>