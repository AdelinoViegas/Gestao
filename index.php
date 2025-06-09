<?php
require_once "connection.php";
require_once "features/authentication.php";
session_start();

if (isset($_POST['enviar-dados'])) {
  $erros = array();

  $name = mysqli_real_escape_string(
    $connection,
    trim($_POST['name'])
  );
  $password = mysqli_real_escape_string(
    $connection,
    trim($_POST['password'])
  );
  $painel = mysqli_real_escape_string(
    $connection,
    trim($_POST['selection'])
  );

  $consult = mysqli_prepare($connection, "SELECT * FROM tb_users WHERE name_u = ?");
  mysqli_stmt_bind_param($consult, "s", $name);
  mysqli_stmt_execute($consult);
  $user = mysqli_fetch_assoc(mysqli_stmt_get_result($consult)); 

  if (count($user) > 0) {
    $state = $user['password_u'];

    if (password_verify($password, $state)) 
      $password = $state;
  }
  
  $sql = "SELECT * FROM tb_users WHERE name_u = ? AND password_u = ? AND state_u = 'activo' AND painel_u = ?";
  $consult = mysqli_prepare($connection,$sql);
  mysqli_stmt_bind_param($consult,"sss", $name, $password, $painel);
  mysqli_stmt_execute($consult);
  $user = mysqli_fetch_assoc(mysqli_stmt_get_result($consult)); 

  if (empty($name) || empty($password)) {
    $erros[] = "<span>O campo login e senha preecisa ser preenchido</span>";
  } else {
    if (empty($user)) {
      $erros[] = "<span>Usuário enexistente</span>";
    } else {
      if ($painel === 'admin') {
        if ($user['password_u'] === $password && $user['name_u'] === $name) {
          $_SESSION['logged'] = true;
          $_SESSION['admin_id'] = $user['id_u'];
          header('Location: admin/menu-home.php');
        }
      } elseif ($painel === 'professor') {
        if ($user['password_u'] === $password && $user['name_u'] === $name) {
          $sql = "SELECT id_p FROM tb_professors WHERE userID_p = ?";
          $route = 'Location: users/professors/home.php';
          authentication($connection,$sql,$route,$user['id_u'],"professor");
        }
      } elseif ($painel === 'encarregado') {
        if ($user['password_u'] === $password && $user['name_u'] === $name) {
          $sql = "SELECT id_e FROM tb_responsibles WHERE userID_r = ?";
          $route = 'Location: users/responsibles/home.php';
          authentication($connection,$sql,$route,$user['id_u'],"encarregado");
        }
      } elseif ($painel === 'aluno') {
        if ($user['password_u'] === $password && $user['nome_u'] === $name) {
          $sql = "SELECT * FROM sg_aluno WHERE userID_s = ?";
          $route = 'Location: users/students/home.php';
          authentication($connection,$sql,$route,$user['id_u'],"aluno");
        }
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <title>login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="bootstrap5/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/login.css?v=2">
  <link rel="stylesheet" type="text/css" href="css/media.css?v=5">
</head>
<body>
  <div class="card" id="formlog">
    <div id="txtlogin">Login</div>
    <div class="card-body">
      <div id="img">
        <img src="img/logo/logo3.jpg">
      </div>
      <?php
      if (!empty($erros)) {
        foreach ($erros as $value)
          echo $value . "<br>";
      }
      ?>
      <form id="formulario" action="index.php" method="post">
        <div class="form-group">
          <input type="texy" id="textnome" class="form-control" name="name" placeholder="Nome do usuário">
        </div>
        <div class="form-group">
          <input type="password" id="textsenha" class="form-control" name="password" placeholder="Senha do usuário">
        </div>
        <div class="form-group">
          <label for="textusuario">Painel</label>
          <select id="textusuario" class="input form-control" name="selection" required>
            <option value="">Selecione o painel</option>
            <option value="aluno">Aluno</option>
            <option value="admin">Administrador</option>
            <option value="professor">Professor</option>
            <option value="encarregado">Encarregado</option>
          </select>
        </div>
        <button type="submit" class="btn btn-outline-primary btn-block" name="enviar-dados">Entrar</button>
      </form>
    </div>
  </div>

  <script src="bootstrap5/js/bootstrap.bundle.min.js"></script>
</body>
</html>