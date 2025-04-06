<?php
require_once "conection.php";
session_start();

$sql = "SELECT * FROM teste";
$result = mysqli_query($conection, $sql);

print_r($result);
die();
//verficar se está logado
if (!isset($_SESSION['logado'])) {
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Professor</title>
  <?php require_once "head.php"; ?>
</head>
<body>
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>

  <!--Navebar-->
  <div class="navegacao">
    <ul>
      <li class="list active">
        <a href="home.php">
          <span class="icon"><img src="img/home_white_24dp.svg"></span>
          <span class="title">HOME</span>
        </a>
      </li>
      <li class="list">
        <a href="professor.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Professores</span>
        </a>
      </li>
      <li class="list ">
        <a href="aluno.php">
          <span class="icon"><img src="img/school_white_24dp.svg"></span>
          <span class="title">Alunos</span>
        </a>
      </li>
      <li class="list ">
        <a href="Encarregados.php">
          <span class="icon"><img src="img/escalator_warning_white_24dp.svg"></span>
          <span class="title">Encarregados</span>
        </a>
      </li>
      <li class="list ">
        <a href="usuarios.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Usuarios</span>
        </a>
      <li class="list ">
        <a href="disciplinas.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Disciplinas</span>
        </a>
      <li class="list ">
        <a href="turmas.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Turmas</span>
        </a>
      <li class="list ">
        <a href="classes.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Classes</span>
        </a>
      <li class="list ">
        <a href="grades.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Grades</span>
        </a>
      </li>
      <li class="list">
        <a href="pauta.php">
          <span class="icon"><img src="img/format_list_numbered_white_24dp.svg"></span>
          <span class="title">Pautas</span>
        </a>
      </li>
      <li class="list">
        <a href="logoult.php">
          <span class="icon"><img src="img/logout_white_24dp.svg"></span>
          <span class="title">Sair</span>
        </a>
      </li>
    </ul>
  </div>

  <!--Menu mobile-->
  <nav class="navbar navbar-dark" id="navMenu">
    <div class="container-fluid">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu-mobile"
        aria-expanded="true" id="menuMobile">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse" id="menu-mobile">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" id="opcMobile" href="home.php">
              <span class="icon"><img src="img/home_white_24dp.svg"></span>
              <span class="title">HOME</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="opcMobile" href="professor.php">
              <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
              <span class="title">Professores</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="opcMobile" href="aluno.php">
              <span class="icon"><img src="img/school_white_24dp.svg"></span>
              <span class="title">Alunos</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="opcMobile" href="encarregados.php">
              <span class="icon"><img src="img/escalator_warning_white_24dp.svg"></span>
              <span class="title">Encarregados</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="opcMobile" href="usuarios.php">
              <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
              <span class="title">Usuarios</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="opcMobile" href="disciplinas.php">
              <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
              <span class="title">Disciplinas</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="opcMobile" href="turmas.php">
              <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
              <span class="title">Turmas</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="opcMobile" href="classes.php">
              <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
              <span class="title">Classes</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="opcMobile" href="grades.php">
              <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
              <span class="title">Grades</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="opcMobile" href="pautas.php">
              <span class="icon"><img src="img/format_list_numbered_white_24dp.svg"></span>
              <span class="title">Pautas</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="opcMobile" href="logoult.php">
              <span class="icon"><img src="img/logout_white_24dp.svg"></span>
              <span class="title">Sair</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="alerta">
    <p>Bem Vindo ao sistema Sr.
      <?php $nome = $_SESSION['painel'];
      echo "<h1>$nome</h1>";
      ?>
    </p>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>