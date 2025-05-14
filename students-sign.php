<?php
require_once "connection.php";
require_once "features/getData.php";
require_once "features/signData.php";
require_once "features/setMessage.php";
session_start();

if (isset($_POST['btn-cadastre'])) {
  $student_group = mysqli_real_escape_string($connection, trim($_POST['group']));
  $student_class = mysqli_real_escape_string($connection, trim($_POST['class']));
  $name = mysqli_real_escape_string($connection, trim($_POST['name']));
  $city = mysqli_real_escape_string($connection, trim($_POST['city']));
  $neighborhood = mysqli_real_escape_string($connection, trim($_POST['neighborhood']));
  $gender = mysqli_real_escape_string($connection, trim($_POST['gender']));
  $contact = mysqli_real_escape_string($connection, trim($_POST['contact']));
  $birthday = mysqli_real_escape_string($connection, trim($_POST['birthday']));
  $BI = mysqli_real_escape_string($connection, trim($_POST['BI']));
  $responsible = mysqli_real_escape_string($connection, trim($_POST['responsible']));

  $BI_verification = getData($connection, "SELECT numeroBI_a FROM sg_aluno WHERE numeroBI_a = ?", [$BI]);

  if ($BI_verification) {
    setMessage("student-message", "alert-danger", "Codigo de BI já existente!");
  } else {
    date_default_timezone_set('Africa/Luanda');
    $date = date('Y/m/d H:i:s');
    $hash = password_hash('aluno', PASSWORD_DEFAULT);

    $responsible_data = getData($connection, "SELECT * FROM sg_encarregado WHERE nome_e = ?", [$responsible]);
    
    if (count($responsible_data) > 0){
      $responsible_id = $responsible_data['id_e'];

      $sign_user = signData(
        $connection,
        "INSERT INTO  sg_usuarios(nome_u, senha_u, estado_u, painel_u, view, dataCadastro_u, dataModificacao_u) VALUES (?,?,?,?,?,?,?)",
        [$name, $hash, 'activo', 'aluno', '1', $date, $date]
      );
  
      $user_data = getData($connection, "SELECT id_u FROM sg_usuarios WHERE nome_u = ?", [$name]);
      $user_id = $user_data['id_u'];

      $sign_student = signData(
        $connection,
        "INSERT INTO sg_aluno(idTurma_a, idClasse, idEncarregado, idUsuario, nome_a, sexo_a, nascimento_a, municipio_a, bairro_a, contato_a, numeroBI_a, view, dataCadastro_a, dataModificacao_a) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
        [$student_group, $student_class, $responsible_id, $user_id, $name, $gender, $birthday, $city, $neighborhood, $contact, $BI, "1", $date, $date]
      );
    }else{
      $error = "Nome do encarregado não foi encontrado, cadastre-o primeiramente ou digite o nome correctamente";
    }

    if (isset($sign_student) && isset($sign_user))
      setMessage("student-message", "alert-success", "Aluno cadastrado com sucesso!");
    else
      setMessage("student-message", "alert-danger", $error?$error:"Erro ao cadastrar!");
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
  </div>

  <?php
  if (isset($_SESSION['student-message'])) {
    echo $_SESSION['student-message'];
    unset($_SESSION['student-message']);
  }
  ?>

  <?php require_once "navigation.php"; ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Formulário de cadastramento de alunos</h5>
    </div>
    <form action="students-sign.php" method="post">
      <div class="row">
        <div class="form-group col-md-6 mb-3">
          <label for="textnome">Nome</label>
          <input type="text" id="textnome" class="form-control" name="name" maxlength="45"
            placeholder="Nome completo do aluno/a" required>
        </div>
        <div class="form-group col-md-3 mb-3">
          <label for="textclasse">Classe</label>
          <select id="textclasse" class="input form-control" name="class" required>
            <option value="">Selecione aqui</option>

            <?php
            $class = getData($connection, "SELECT id_c, nome_c FROM sg_classe ORDER BY id_c");

            foreach ($class as $data)
              echo "<option value = '" . $data['id_c'] . "'>" . $data['nome_c'] . "</option>";
            ?>
          </select>
        </div>

        <div class="form-group col-md-3 mb-3">
          <label for="textturma">Turmas</label>
          <select id="textturma" class="input form-control" name="group" required>
            <option value="">Selecione aqui</option>
            <?php
            $group = getData($connection, "SELECT id_t,nome_t FROM sg_turma ORDER BY nome_t");

            foreach($group as $data) 
              echo "<option value = '" . $data['id_t'] . "'>" . $data['nome_t'] . "</option>";
            ?>
          </select>
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
          <label for="textcont">Contato(opcional)</label>
          <input type="text" id="textcont" class="form-control" name="contact" placeholder="xxx-xx-xx-xx" maxlength="9">
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

      <div class="row">
        <div class="form-group col-md-6 mb-3">
          <label for="textencarregado">Encarregado</label>
          <input type="text" id="textencarregado" class="form-control" name="responsible" maxlength="45"
            placeholder="Nome completo do encarregado/a" required>
        </div>
      </div>

      <div class="row" id="marg">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-cadastre"
          id="margemBotao">Cadastrar</button>

        <div class="col-md-8" id="margemBotao"></div>

        <a href="menu-students.php" class="btn btn-outline-secondary btn-block col-md-2" name="btn-voltar">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>