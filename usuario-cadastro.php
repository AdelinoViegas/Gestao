<?php
require_once "conexao.php";
session_start();

if (isset($_POST['btn-cadastrar'])) {
  $nome = mysqli_escape_string($conexao, $_POST['txtnome']);
  $email = mysqli_escape_string($conexao, $_POST['txtemail']);
  $mun = mysqli_escape_string($conexao, $_POST['txtmun']);
  $bairro = mysqli_escape_string($conexao, $_POST['txtbairro']);
  $sexo = mysqli_escape_string($conexao, $_POST['txtsexo']);
  $contato = mysqli_escape_string($conexao, $_POST['txtcont']);
  $datNasc = mysqli_escape_string($conexao, $_POST['txtnasc']);
  $numeroBI = mysqli_escape_string($conexao, $_POST['txtbi']);

  $sql = "INSERT INTO teste(id,nome,email,sexo,dataNascimento,municipio,bairro,contato,numeroBI) VALUES (default,'$nome','$email','$sexo','$datNasc','$mun','$bairro','$contato','$numeroBI')";
  mysqli_query($conexao, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Professor</title>
  <?php require_once "head.php"; ?>
</head>
<body>
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>

  <div class="divsuperior2">
    <h5>Formulário de cadastramento de usuários</h5>
  </div>

  <!--Navebar-->
  <div class="navegacao">
    <ul>
      <li class="list">
        <a href="menu-home.php">
          <span class="icon"><img src="img/home_white_24dp.svg"></span>
          <span class="title">HOME</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-professores.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Professores</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-alunos.php">
          <span class="icon"><img src="img/school_white_24dp.svg"></span>
          <span class="title">Alunos</span>
        </a>
      </li>
      <li class="list ">
        <a href="menu-Encarregados.php">
          <span class="icon"><img src="img/escalator_warning_white_24dp.svg"></span>
          <span class="title">Encarregados</span>
        </a>
      </li>
      <li class="list active">
        <a href="menu-usuarios.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Usuarios</span>
        </a>
      <li class="list">
        <a href="menu-disciplinas.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Disciplinas</span>
        </a>
      <li class="list ">
        <a href="menu-turmas.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Turmas</span>
        </a>
      <li class="list ">
        <a href="menu-classes.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Classes</span>
        </a>
      <li class="list ">
        <a href="menu-gerenciar.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Gerenciamento</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-pautas.php">
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

  <?php require_once "navbarMobile.php" ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Formulário de cadastramento de usuarios</h5>
    </div>

    <form action="cadastro-usuario.php" method="post">
      <div class="row margB">
        <div class="form-group col-md-6" id="margemB">
          <label for="textnome">Nome</label>
          <input type="text" id="textnome" class="form-control" name="txtnome" placeholder="Nome do aluno">
        </div>
        <div class="form-group col-md-6" id="margemB">
          <label for="textsexo">Painel</label>
          <select type="text" id="textsexo" class="input md form-control" name="txtsexo">
            <option>Admin</option>
            <option>Professor</option>
            <option>Encarregado</option>
            <option>Aluno</option>
          </select>
        </div>
      </div>

      <div class="row margB">
        <div class="form-group col-md-4" id="margemB">
          <label for="textsexo">Estado</label>
          <select type="text" id="textsexo" class="input md form-control" name="txtsexo">
            <option>activo</option>
            <option>inactivo</option>
          </select>
        </div>
        <div class="form-group col-md-4" id="margemB">
          <label for="textsenha">Senha</label>
          <input type="password" id="textsenha" class="form-control" name="txtsenha" placeholder="Senha">
        </div>
        <div class="form-group col-md-4" id="margemB">
          <label for="textcsenha">Confirmar-Senha</label>
          <input type="password" id="textcsenha" class="form-control" name="txtcsenha" placeholder="Confirmar a senha">
        </div>
      </div>

      <div class="row marg">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-cadastrar"
          id="margemBotao">Cadastrar</button>

        <div class="col-md-8" id="margemBotao"></div>

        <a href="menu-usuarios.php" class="btn btn-outline-secondary btn-block col-md-2" name="btn-voltar"
          id="margemBotao">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>