<?php
require_once "connection.php";
require_once "features/signData.php";
require_once "features/getData.php";
require_once "features/getCurrentDate.php";
require_once "features/setMessage.php";
session_start();

if (isset($_POST['btn-sign'])) {
  $discipline = mysqli_escape_string($connection, trim($_POST['discipline']));
  $professor = mysqli_escape_string($connection, trim($_POST['professor']));
  $group = mysqli_escape_string($connection, trim($_POST['group']));
  $date = '2022';//Date('Y');

  $management_data = getData(
    $connection, 
    "SELECT * FROM sg_gerenciar WHERE idDisciplina =? AND idProfessor =? AND idTurma =?", 
    [$discipline, $professor, $group]
  );

  if ($management_data) {
    setMessage("management-message", "alert-warning", "Dados já existentes!");
  }else{
    $sign_management = signData(
      $connection, 
      "INSERT INTO sg_gerenciar(idDisciplina,idProfessor,idTurma,ano) VALUES (?,?,?,?)",
      [$discipline, $professor, $group, $date]
    );

    if($sign_management)
      setMessage("management-message", "alert-success",  "Dados cadastrado com sucesso!");
    else
      setMessage("management-message", "alert-danger", "Erro ao cadastrar!!");
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
        <h5>Gerenciar</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
      </div>
    </div>
  </div>

  <?php
  if (isset($_SESSION['management-message'])) {
    echo $_SESSION['management-message'];
    unset($_SESSION['management-message']);
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
      <li class="list active">
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
      <h5>Gerenciar</h5>
    </div>
    <form action="gerenciar-cadastro.php" method="post">
      <div class="row margB">
        <div class="form-group col-md-4" id="margemB">
          <label for="textdisciplina">Disciplinas</label>
          <select id="textdisciplina" class="input form-control" name="discipline" required>
            <option value="">Selecione aqui</option>
            <?php $discipline_data = getData($connection, "SELECT id_d,nome_d FROM sg_disciplina ORDER BY nome_d");
            foreach ($discipline_data as  $data) 
              echo "<option value = '" . $data['id_d'] . "'>" . $data['nome_d'] . "</option>";
            ?>
          </select>
        </div>
        <div class="form-group col-md-4" id="margemB">
          <label for="textprofessor">Professores</label>
          <select id="textprofessor" class="input form-control" name="professor" required>
            <option value="">Selecione aqui</option>
            <?php $professor_data = getData($connection, "SELECT id_p,nome_p FROM sg_professor ORDER BY nome_p");
            foreach ($professor_data as $data) 
              echo "<option value = '" . $data['id_p'] . "'>" . $data['nome_p'] . "</option>";
            ?>
          </select>
        </div>
        <div class="form-group col-md-4" id="margemB">
          <label for="textturma">Turmas</label>
          <select id="textturma" class="input form-control" name="group" required>
            <option value="">Selecione aqui</option>
            <?php $group_data = getData($connection, "SELECT id_t,nome_t FROM sg_turma ORDER BY nome_t");
            foreach ($group_data as $data) 
              echo "<option value = '" . $data['id_t'] . "'>" . $data['nome_t'] . "</option>";
            ?>
          </select>
        </div>
      </div>

      <div class="row marg">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-sign"
          id="margemBotao">Salvar</button>

        <div class="col-md-8" id="margemBotao"></div>

        <a href="menu-gerenciar.php" class="btn btn-outline-secondary btn-block col-md-2" name="btn-voltar"
          id="margemBotao">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>