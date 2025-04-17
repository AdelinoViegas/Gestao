<?php
require_once "conexao.php";
session_start();

if (isset($_POST['btn-cadastrar'])) {
  $turmaAluno = mysqli_escape_string($connection, trim($_POST['txtturma']));
  $classeAluno = mysqli_escape_string($connection, trim($_POST['txtclasse']));
  $nome = mysqli_escape_string($connection, trim($_POST['txtnome']));
  $mun = mysqli_escape_string($connection, trim($_POST['txtmun']));
  $bairro = mysqli_escape_string($connection, trim($_POST['txtbairro']));
  $sexo = mysqli_escape_string($connection, trim($_POST['txtsexo']));
  $contato = mysqli_escape_string($connection, trim($_POST['txtcont']));
  $datNasc = mysqli_escape_string($connection, trim($_POST['txtnasc']));
  $numeroBI = mysqli_escape_string($connection, trim($_POST['txtbi']));
  $encarregado = mysqli_escape_string($connection, trim($_POST['txtencarregado']));

  $sql_bi = "SELECT numeroBI_a FROM sg_aluno WHERE numeroBI_a = '$numeroBI' ";
  $BI_verification = mysqli_query($connection, $sql_bi);


  if ($BI_verification) {
    $message = $BI_verification ? "Codigo de BI já existente!" : "Email já existente por favor insira outro!";
    setMessage("professor-message", "alert-danger", $message);
  } else {

      date_default_timezone_set('Africa/Luanda');
      $dt = date('Y/m/d H:i:s');
      $senha = password_hash('aluno', PASSWORD_DEFAULT);

      $sql_enc = mysqli_query($connection, "SELECT * FROM sg_encarregado WHERE nome_e = '$encarregado'");

      if (mysqli_num_rows($sql_enc) > 0) {
        $enc = mysqli_fetch_assoc($sql_enc);
        $id_enc = $enc['id_e'];
      }



      $r_usuario = mysqli_query($connection, "INSERT INTO  sg_usuarios(nome_u,senha_u,estado_u,painel_u,dataCadastro_u,dataModificacao_u) VALUES ('$nome','$senha','activo','aluno','$dt','$dt')");

      //Capturar o id do dado cadastrado
      $sql_id = mysqli_query($connection, "SELECT id_u FROM sg_usuarios WHERE nome_u = '$nome'");
      $arr = mysqli_fetch_assoc($sql_id);
      $iduser = $arr['id_u'];

      $r_aluno = mysqli_query($connection, "INSERT INTO sg_aluno(idTurma_a,idClasse,idEncarregado,idUsuario,nome_a,sexo_a,nascimento_a,municipio_a,bairro_a,contato_a,numeroBI_a,dataCadastro_a,dataModificacao_a) VALUES ('$turmaAluno','$classeAluno','$id_enc','$iduser','$nome','$sexo','$datNasc','$mun','$bairro','$contato','$numeroBI','$dt','$dt')");


      if ($r_aluno == true && $r_usuario == true) {

        $_SESSION['Aluno-cadastrado'] = "
                         <div id='alerta-confirmar'>
           <div class='alerta-confirmar'>
              <div class='alert alert-success alert-dimissible'>
               <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
                 Aluno cadastrado com sucesso!
              </div>
           </div>
           </div>";


      } else {

        $_SESSION['Aluno-cadastrado'] = "
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
        <h5>Formulário de cadastramento de alunos</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
      </div>
    </div>
  </div>-->

  <?php
  if (isset($_SESSION['Aluno-cadastrado'])) {
    echo $_SESSION['Aluno-cadastrado'];
    unset($_SESSION['Aluno-cadastrado']);
  }

  ?>

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
        <a href="menu-Encarregados.php">
          <span class="icon"><img src="img/escalator_warning_white_24dp.svg"></span>
          <span class="title">Encarregados</span>
        </a>
      </li>
      <li class="list active">
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
      <h5>Formulário de cadastramento de alunos</h5>
    </div>
    <form action="aluno-cadastro.php" method="post">

      <div class="row">
        <div class="form-group col-md-6 mb-3">
          <label for="textnome">Nome</label>
          <input type="text" id="textnome" class="form-control" name="txtnome" maxlength="45"
            placeholder="Nome completo do aluno/a" required>
        </div>
        <div class="form-group col-md-3 mb-3">
          <label for="textclasse">Classe</label>
          <select id="textclasse" class="input form-control" name="txtclasse" required>
            <option value="">Selecione aqui</option>

            <?php
            $query = mysqli_query($connection, "SELECT id_c,nome_c FROM sg_classe ORDER BY id_c");

            while ($dados = mysqli_fetch_assoc($query)) {
              echo "<option value = '" . $dados['id_c'] . "'>" . $dados['nome_c'] . "</option>";
            }

            ?>

          </select>
        </div>
        <div class="form-group col-md-3 mb-3">
          <label for="textturma">Turmas</label>
          <select id="textturma" class="input form-control" name="txtturma" required>
            <option value="">Selecione aqui</option>

            <?php
            $query = mysqli_query($connection, "SELECT id_t,nome_t FROM sg_turma ORDER BY nome_t");

            while ($dados = mysqli_fetch_assoc($query)) {
              echo "<option value = '" . $dados['id_t'] . "'>" . $dados['nome_t'] . "</option>";
            }

            ?>

          </select>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-4 mb-3">
          <label for="textmun">Município</label>
          <select id="textmun" class="input form-control" name="txtmun" placeholder="Seu município" required>
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
          <input type="text" id="textbairro" class="form-control" name="txtbairro" maxlength="20"
            placeholder="Seu bairro" required>
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textsexo">sexo</label>
          <select id="textsexo" class="input form-control" name="txtsexo" required>
            <option value="">Selecione aqui</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-4 mb-3">
          <label for="textcont">Contato</label>
          <input type="text" id="textcont" class="form-control" name="txtcont" placeholder="xxx-xx-xx-xx" maxlength="9"
            value="Opcional">
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textnasc">Data de Nascimento</label>
          <input type="date" id="textnasc" class="form-control" name="txtnasc" required>
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textbi">Número do BI</label>
          <input type="text" id="textbi" class="form-control" name="txtbi" placeholder="Nª do bilhete" maxlength="15"
            required>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-6 mb-3">
          <label for="textencarregado">Encarregado</label>
          <input type="text" id="textencarregado" class="form-control" name="txtencarregado" maxlength="45"
            placeholder="Nome completo do encarregado/a" required>
        </div>
      </div>

      <div class="row" id="marg">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-cadastrar"
          id="margemBotao">Cadastrar</button>

        <div class="col-md-8" id="margemBotao"></div>

        <a href="menu-alunos.php" class="btn btn-outline-secondary btn-block col-md-2" name="btn-voltar">Voltar</a>

      </div>

    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>

</html>