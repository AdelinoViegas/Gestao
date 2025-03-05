<?php
require_once "../conexao.php";
session_start();

$id = $_SESSION['student_id'];

if (isset($_POST['btn-senha'])) {
  $password = mysqli_escape_string($conection, $_POST['txtsenha']);
  $new_password = mysqli_escape_string($conection, $_POST['txtnova']);
  $date = date('Y/m/d');

  if ($password === $new_password) {
    $password = password_hash($new_password, PASSWORD_DEFAULT);
    mysqli_query($conection, "UPDATE sg_usuarios SET senha_u ='$password',dataModificacao_u = '$date' WHERE id_u ='$id'");

    $_SESSION['Configurar-actualizado'] = "
          <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-success alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
        Senha actualizada com sucesso!
      </div>
   </div>
   </div>";

  } else {
    $_SESSION['Configurar-actualizado'] = "
         <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-danger alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
         Erro! as senhas não são iguais
      </div>
   </div>
   </div>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>principal</title>
  <?php require_once "../head2.php"; ?>
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
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3">Aluno</h5>
      </div>
    </div>
  </div>

  <?php
  if (isset($_SESSION['Configurar-actualizado'])) {
    echo $_SESSION['Configurar-actualizado'];
    unset($_SESSION['Configurar-actualizado']);
  }
  ?>

	<?php require_once "nav-aluno.php" ?>
  <?php require_once "navMob-aluno.php" ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Formulário de cadastramento de alunos</h5>
    </div>
    <form action="conf-aluno.php" method="post">
      <div class="row">
        <div class="form-group col-md-4 mb-3">
          <label for="tsenha">Senha</label>
          <input type="password" id="tsenha" class="form-control" name="txtsenha" maxlength="30"
            placeholder="Insira nova senha" required>
        </div>

        <div class="form-group col-md-4 mb-3">
          <label for="tsenha">Confirmar senha</label>
          <input type="password" id="tsenha" class="form-control" name="txtnova" maxlength="30"
            placeholder="Confirmar nova senha" required>
        </div>

        <div class=" col-md-2 mb-3">
          <label></label>
          <button type="submit" id="inserir" class="btn btn-success col-md-12" name="btn-senha">Gravar</button>
        </div>
      </div>
    </form>
  </div>

  <?php require_once "../footer2.php"; ?>
</body>
</html>