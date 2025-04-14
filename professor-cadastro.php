<?php
require_once "connection.php";
require_once "features/getData.php";
require_once "features/signData.php";
session_start();

if (isset($_POST['btn-cadastre'])) {
  $name = mysqli_real_escape_string($connection, trim($_POST['name']));
  $email = mysqli_real_escape_string($connection, trim($_POST['email']));
  $city = mysqli_real_escape_string($connection, trim($_POST['city']));
  $neighborhood = mysqli_real_escape_string($connection, trim($_POST['neighborhood']));
  $gender = mysqli_real_escape_string($connection, trim($_POST['gender']));
  $contact = mysqli_real_escape_string($connection, trim($_POST['contact']));
  $birthday = mysqli_real_escape_string($connection, trim($_POST['birthday']));
  $BI = mysqli_real_escape_string($connection, trim($_POST['BI']));

  $sql_name = "SELECT nome_p FROM sg_professor WHERE nome_p = ?";
  $sql_BI = "SELECT numeroBI_p FROM sg_professor WHERE numeroBI_p = ?";
  $sql_email = "SELECT email_p FROM sg_professor WHERE email_p = ?";
  $name_verification = getData($connection, $sql_name, [$name]);
  $BI_verification = getData($connection, $sql_BI, [$BI]);
  $email_verification = getData($connection, $sql_email, [$email]);

  if (count($BI_verification) > 0) {
    $_SESSION['professor-message'] = "
                     <div id='alerta-confirmar'>
       <div class='alerta-confirmar'>
          <div class='alert alert-danger alert-dimissible'>
           <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
             Codigo de BI já existente!
          </div>
       </div>
       </div>";
  } else {
    if (count($email_verification) > 0) {
      $_SESSION['professor-message'] = "
                             <div id='alerta-confirmar'>
               <div class='alerta-confirmar'>
                  <div class='alert alert-danger alert-dimissible'>
                   <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
                     Email já existente por favor insira outro!
                  </div>
               </div>
               </div>";
    } elseif (count($BI_verification) > 0) {
      $_SESSION['professor-message'] = "
                             <div id='alerta-confirmar'>
               <div class='alerta-confirmar'>
                  <div class='alert alert-danger alert-dimissible'>
                   <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
                     Professor já existente!
                  </div>
               </div>
               </div>";
    } else {
      date_default_timezone_set('Africa/Luanda');
      $date = date('Y/m/d H:i:s');
      $hash = password_hash('professor', PASSWORD_DEFAULT);

      $r_usuario = signData(
        $connection, 
        "INSERT INTO sg_usuarios(nome_u,senha_u,estado_u,painel_u,dataCadastro_u,dataModificacao_u) VALUES (?,?,?,?,?,?)",
        [$name, $hash, 'activo', 'professor', $date, $date]
      );
      
      //Capturar o id do dado cadastrado
      $sql_id = getData($connection, "SELECT id_u FROM sg_usuarios WHERE nome_u = ?", [$params]);
      $iduser = $sql_id['id_u'];

      $r_professor = mysqli_query($connection, "INSERT INTO sg_professor(idUsuario,nome_p,email_p,municipio_p,bairro_p,contato_p,sexo_p,nascimento_p,numeroBI_p,dataCadastro_p,dataModificacao_p) VALUES ('$iduser','$nome','$email','$mun','$bairro','$contato','$sexo','$datNasc','$numeroBI','$dt','$dt')");

      if ($r_professor == true && $r_usuario == true) {
        $_SESSION['Professor-cadastrado'] = "
                                   <div id='alerta-confirmar'>
                     <div class='alerta-confirmar'>
                        <div class='alert alert-success alert-dimissible'>
                         <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
                           Professor cadastrado com sucesso!
                        </div>
                     </div>
                     </div>";
      } else {
        $_SESSION['Professor-cadastrado'] = "
                                   <div id='alerta-confirmar'>
                     <div class='alerta-confirmar'>
                        <div class='alert alert-danger alert-dimissible'>
                         <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
                            Erro ao cadastrar!
                        </div>
                     </div>
                     </div>";

      }
    }
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
        <h5>Formulário de cadastramento de professores</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
      </div>
    </div>
  </div>
  <?php

  if (isset($_SESSION['professor-message'])) {
    echo $_SESSION['professor-message'];
    unset($_SESSION['professor-message']);
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
      <li class="list active">
        <a href="menu-professores.php">
          <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
          <span class="title">Professores</span>
        </a>
      </li>
      <li class="list">
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

  <?php require_once "navbarMobile.php"; ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Formulário de cadastramento de professores</h5>
    </div>

    <form action="professor-cadastro.php" method="post">
      <div class="row">
        <div class="form-group col-md-6 mb-3">
          <label for="textnome">Nome</label>
          <input type="text" id="textnome" class="form-control" name="name" maxlength="45"
            placeholder="Nome completo do professor/a" required>
        </div>
        <div class="form-group col-md-6" id="margemB">
          <label for="textemail">E-mail</label>
          <input type="email" id="textemail" class="form-control" name="email" maxlength="45"
            placeholder="E-mail do professor" required>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-4 mb-3">
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
        <div class="form-group col-md-4 mb-3">
          <label for="textbairro">Bairro</label>
          <input type="text" id="textbairro" class="form-control" name="neighborhood" maxlength="20"
            placeholder="Seu bairro" required>
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textsexo">sexo</label>
          <select id="textsexo" class="input form-control" name="gender" required>
            <option value="">Selecione aqui</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-4 mb-3">
          <label for="textcont">Contato</label>
          <input type="text" id="textcont" class="form-control" name="contact" placeholder="xxx-xx-xx-xx" maxlength="9"
            required>
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textnasc">Data de Nascimento</label>
          <input type="date" id="textnasc" class="form-control" name="birthday" required>
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textbi">Número do BI</label>
          <input type="text" id="textbi" class="form-control" name="BI" placeholder="Nª do bilhete" maxlength="15"
            required>
        </div>
      </div>

      <div class="row" id="marg">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-cadastre"
          id="margemBotao">Cadastrar</button>

        <div class="col-md-8" id="margemBotao"></div>

        <a href="menu-professores.php" class="btn btn-outline-secondary btn-block col-md-2" name="btn-voltar">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>