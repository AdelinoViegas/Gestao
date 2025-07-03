<?php
session_start();
require_once "connection.php";
require_once "features/authentication.php";
$errors = [];

if (isset($_POST['btn-login'])) {
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
   
  if (empty($name) || empty($password)) {
    $errors[] = "<span>O campo login e senha preecisa ser preenchido</span>";
  } else {
    $consult = mysqli_prepare($connection, "SELECT * FROM tb_users WHERE name_u = ?");
    mysqli_stmt_bind_param($consult, "s", $name);
    mysqli_stmt_execute($consult);
    $user = mysqli_fetch_assoc(mysqli_stmt_get_result($consult)); 

    if($user && password_verify($password, $user['password_u']) && $user['state_u'] === 'activo' && $user['painel_u'] === $painel){
      session_regenerate_id(true);
      
      if($painel === 'admin'){
        $_SESSION['logged'] = true;
        $_SESSION['admin_id'] = $user['id_u'];
        header('Location: admin/menu-home.php');
        exit;
      }elseif($painel === 'professor'){
        $sql = "SELECT * FROM tb_professors WHERE userID_p = ?";
        $route = 'Location: users/professors/home.php';
        authentication($connection,$sql,$route,$user['id_u'],"professor");
      }elseif($painel === 'encarregado'){
        $sql = "SELECT * FROM tb_responsibles WHERE userID_r = ?";
        $route = 'Location: users/responsibles/home.php';
        authentication($connection,$sql,$route,$user['id_u'],"encarregado");
      }elseif($painel === 'aluno'){
        $sql = "SELECT * FROM tb_students WHERE userID_s = ?";
        $route = 'Location: users/students/home.php';
        authentication($connection,$sql,$route,$user['id_u'],"aluno");
      }
    } else {
      $errors[] = "<span>Usuário enexistente</span>";
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
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="css/media.css">
</head>
<body>
  <div class="card position-absolute top-50 start-50" id="login-form">
    <div class="text-center fs-2 fw-bold" id="txtlogin">Login</div>
    <div class="card-body">
      <div id="login-image">
        <img src="img/logo/logo3.jpg">
      </div>
      <?php
      if (!empty($errors)) {
        foreach ($errors as $value)
          echo $value . "<br>";
      }
      ?>
      <form id="formulario" action="index.php" method="post">
        <div class=" mt-2 mb-3">
          <input type="text" id="textnome" class="form-control" name="name" placeholder="Nome do usuário" required>
        </div>

        <div class="mt-2 mb-3">
          <input type="password" id="textsenha" class="form-control" name="password" placeholder="Senha do usuário" required>
        </div>

        <div class="mb-3">
          <label for="textpainel" class="form-label fw-bold" id="label-select">Painel</label>
          <select id="textpainel" class="form-select" name="selection" required>
            <option value="">Selecione o painel</option>
            <option value="aluno">Aluno</option>
            <option value="admin">Administrador</option>
            <option value="professor">Professor</option>
            <option value="encarregado">Encarregado</option>
          </select>
        </div>

        <button type="submit" class="btn btn-outline-primary w-100 mt-3" name="btn-login">Entrar</button>
      </form>
    </div>
  </div>

  <script src="bootstrap5/js/bootstrap.bundle.min.js"></script>
</body>
</html>