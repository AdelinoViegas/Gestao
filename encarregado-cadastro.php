<?php
require_once "connection.php";
require_once "features/getData.php";
require_once "features/signData.php";
require_once "features/setMessage.php";
session_start();

if (isset($_POST['btn-cadastre'])) {
  $name = mysqli_real_escape_string($connection, trim($_POST['name']));
  $city = mysqli_real_escape_string($connection, trim($_POST['city']));
  $neighborhood = mysqli_real_escape_string($connection, trim($_POST['neighborhood']));
  $gender = mysqli_real_escape_string($connection, trim($_POST['gender']));
  $contact = mysqli_real_escape_string($connection, trim($_POST['contact']));
  $birthday = mysqli_real_escape_string($connection, trim($_POST['birthday']));
  $BI = mysqli_real_escape_string($connection, trim($_POST['BI']));

  $BI_verification = getData($connection, "SELECT numeroBI_e FROM sg_encarregado WHERE numeroBI_e = ?", [$BI]);

  if ($BI_verification) {
    setMessage("responsible-message", "alert-warning", "Codigo de BI já existente!");
  } else {
    date_default_timezone_set('Africa/Luanda');
    $date = date('Y/m/d H:i:s');
    $hash = password_hash('encarregado', PASSWORD_DEFAULT);

    $sign_user = signData(
      $connection,
      "INSERT INTO sg_usuarios(nome_u, senha_u, estado_u, painel_u, view, dataCadastro_u, dataModificacao_u) VALUES (?,?,?,?,?,?,?)",
      [$name, $hash, 'activo', 'encarregado', "1", $date, $date]
    );

    //Capturar o id do dado cadastrado
    $user_data = getData($connection, "SELECT id_u FROM sg_usuarios WHERE nome_u = ?", [$name]);
    $user_id = $user_data['id_u'];

    $sign_responsible = signData(
      $connection, 
      "INSERT INTO sg_encarregado(idUsuario, nome_e, sexo_e, municipio_e, bairro_e, nascimento_e, contato_e, numeroBI_e, view, dataCadastro_e, dataModificacao_e) VALUES (?,?,?,?,?,?,?,?,?,?,?)",
     [$user_id, $name, $gender, $city, $neighborhood, $birthday, $contact,  $BI, "1", $date, $date]
    );

    if ($sign_responsible && $sign_user) 
      setMessage("responsible-message", "alert-success", "Encarregado cadastrado com sucesso!");
    else 
      setMessage("responsible-message", "alert-success", "Erro ao cadastrar!");
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
        <h5>Formulário de cadastramento de encarregados</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
      </div>
    </div>
  </div>

  <?php
  if (isset($_SESSION['responsible-message'])) {
    echo $_SESSION['responsible-message'];
    unset($_SESSION['responsible-message']);
  }
  ?>

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
      <li class="list active">
        <a href="menu-Encarregados.php">
          <span class="icon"><img src="img/escalator_warning_white_24dp.svg"></span>
          <span class="title">Encarregados</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-alunos.php">
          <span class="icon"><img src="img/school_white_24dp.svg"></span>
          <span class="title">Alunos</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-usuarios.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Usuarios</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-disciplinas.php">
          <span class="icon"><img src="img/livro.png"></span>
          <span class="title">Disciplinas</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-turmas.php">
          <span class="icon"><img src="img/edit.png"></span>
          <span class="title">Turmas</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-classes.php">
          <span class="icon"><img src="img/edit.png"></span>
          <span class="title">Classes</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-gerenciar.php">
          <span class="icon"><img src="img/gerenciar.png"></span>
          <span class="title">Gerenciamento</span>
        </a>
      </li>
      <li class="list">
        <a href="menu-configurar.php">
          <span class="icon"><img src="img/settings.png"></span>
          <span class="title">Alterar-senha</span>
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
      <h5>Formulário de cadastramento de encarregados</h5>
    </div>

    <form action="encarregado-cadastro.php" method="post">
      <div class="row">
        <div class="form-group col-md-6 mb-3">
          <label for="textnome">Nome</label>
          <input type="text" id="textnome" class="form-control" name="name" maxlength="45"
            placeholder="Nome completo do encarregado/a" required>
        </div>
        <div class="form-group col-md-3 mb-3">
          <label for="textmun">Município</label>
          <select id="textmun" class="input form-control" name="city" placeholder="Seu município" required>
            <option value="">Selecione aqui</option>
            <option value="Luanda">Luanda</option>
            <option value="Viana">Viana</option>
            <option value="Belas">Belas</option>
            <option value="Cazenga">Cazenga</option>
            <option value="kissama">Kissama</option>
            <option value="Kilamba Kiaxi">Kilamba Kiaxi</option>
            <option value="Talatona">Talatona</option>
            <option value="Cacuaco">Cacuaco</option>
            <option value="Icolo e Bengo">Icolo e Bengo</option>
          </select>
        </div>
        <div class="form-group col-md-3 mb-3">
          <label for="textbairro">Bairro</label>
          <input type="text" id="textbairro" class="form-control" name="neighborhood" maxlength="20"
            placeholder="Seu bairro" required>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-3 mb-3">
          <label for="textsexo">sexo</label>
          <select id="textsexo" class="input form-control" name="gender" required>
            <option value="">Selecione aqui</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
          </select>
        </div>

        <div class="form-group col-md-3 mb-3">
          <label for="textcont">Contato</label>
          <input type="text" id="textcont" class="form-control" name="contact" placeholder="xxx-xx-xx-xx" maxlength="9"
            required>
        </div>

        <div class="form-group col-md-3 mb-3">
          <label for="textnasc">Data de Nascimento</label>
          <input type="date" id="textnasc" class="form-control" name="birthday" required>
        </div>
        <div class="form-group col-md-3 mb-3">
          <label for="textbi">Número do BI</label>
          <input type="text" id="textbi" class="form-control" name="BI" placeholder="Nª do bilhete" maxlength="15"
            required>
        </div>
      </div>

      <div class="row" id="marg">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-cadastre"
          id="margemBotao">Cadastrar</button>

        <div class="col-md-8" id="margemBotao"></div>

        <a href="menu-encarregados.php" class="btn btn-outline-secondary btn-block col-md-2"
          name="btn-voltar">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>