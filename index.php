<?php
require_once "conexao.php";
require_once "features/getData.php";
session_start();

if (isset($_POST['enviar-dados'])) {
  $erros = array();

  $login = mysqli_escape_string(
    $conection,
    $_POST['txtnome']
  );
  $password = mysqli_escape_string(
    $conection,
    $_POST['txtsenha']
  );
  $painel = mysqli_escape_string(
    $conection,
    $_POST['selecao']
  );

  $consult = mysqli_prepare($conection, "SELECT * FROM sg_usuarios WHERE nome_u = ?");
  mysqli_stmt_bind_param($consult, "s", $login);
  mysqli_stmt_execute($consult);
  $user = mysqli_fetch_assoc(mysqli_stmt_get_result($consult)); 
 
  if (count($user) > 0) {
    $state = $user['senha_u'];

    if (password_verify($password, $state)) {
      $password = $state;
    }
  }

  $sql = "SELECT * FROM sg_usuarios WHERE nome_u = ? AND senha_u = ? AND estado_u = 'activo' AND painel_u = ?";
  $consult = mysqli_prepare($conection,$sql);
  mysqli_stmt_bind_param($consult,"sss", $login, $password, $painel);
  mysqli_stmt_execute($consult);
  $user = mysqli_fetch_assoc(mysqli_stmt_get_result($consult)); 

  if (empty($login) || empty($password)) {
    $erros[] = "<span>O campo login e senha preecisa ser preenchido</span>";
  } else {
    if (empty($user)) {
      $erros[] = "<span>Usuário enexistente</span>";
    } else {
      if ($painel === 'admin') {
        if ($user['senha_u'] === $password && $user['nome_u'] === $login) {
          $_SESSION['logado'] = true;
          $_SESSION['id_adm'] = $user['id_u'];
          $_SESSION['nome'] = $user['painel_u'];
          header('Location: menu-home.php');
        }
      } elseif ($painel === 'professor') {
        if ($user['senha_u'] === $password && $user['nome_u'] === $login) {
          $sql = "SELECT id_p FROM sg_professor WHERE idUsuario = ?";
          $route = 'Location: professor/homeprof.php';
          authentication($conection,$sql,$route,$user['id_u'],"professor");
        }
      } elseif ($painel === 'encarregado') {
        if ($user['senha_u'] === $password && $user['nome_u'] === $login) {
          $sql = "SELECT id_e FROM sg_encarregado WHERE idUsuario = ?";
          $route = 'Location: encarregado/homepais.php';
          authentication($conection,$sql,$route,$user['id_u'],"encarregado");
        }
      } elseif ($painel === 'aluno') {
        if ($user['senha_u'] === $password && $user['nome_u'] === $login) {
          $sql = "SELECT * FROM sg_aluno WHERE idUsuario = ?";
          $route = 'Location: aluno/homealuno.php';
          authentication($conection,$sql,$route,$user['id_u'],"aluno");
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
        foreach ($erros as $value) {
          echo $value . "<br>";
        }
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