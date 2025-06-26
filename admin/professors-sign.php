<?php
session_start();
require_once "../connection.php";
require_once "../features/getData.php";
require_once "../features/signData.php";
require_once "../features/setMessage.php";
require_once "../features/getCurrentDate.php";

if (isset($_POST['btn-cadastre'])) {
  $name = mysqli_real_escape_string($connection, trim($_POST['name']));
  $email = mysqli_real_escape_string($connection, trim($_POST['email']));
  $city = mysqli_real_escape_string($connection, trim($_POST['city']));
  $neighborhood = mysqli_real_escape_string($connection, trim($_POST['neighborhood']));
  $gender = mysqli_real_escape_string($connection, trim($_POST['gender']));
  $contact = mysqli_real_escape_string($connection, trim($_POST['contact']));
  $birthday = mysqli_real_escape_string($connection, trim($_POST['birthday']));
  $BI = mysqli_real_escape_string($connection, trim($_POST['BI']));

  $sql_name = "SELECT name_p FROM tb_professors WHERE name_p = ?";
  $sql_BI = "SELECT BI_p FROM tb_professors WHERE BI_p = ?";
  $sql_email = "SELECT email_p FROM tb_professors WHERE email_p = ?";
  $name_verification = getData($connection, $sql_name, [$name]);
  $BI_verification = getData($connection, $sql_BI, [$BI]);
  $email_verification = getData($connection, $sql_email, [$email]);

  if ($BI_verification || $email_verification) {
    $message = $BI_verification ? "Codigo de BI já existente!" : "Email já existente por favor insira outro!";
    setMessage("professor-message", "alert-danger", $message);
  } else {
    $date = getCurrentDate();
    $hash = password_hash('professor', PASSWORD_DEFAULT);
    count($BI_verification);

    $sign_user = signData(
      $connection,
      "INSERT INTO tb_users(name_u, password_u, state_u, painel_u, view_u, dateCadastre_u, dateModification_u) VALUES (?,?,?,?,?,?,?)",
      [$name, $hash, 'activo', 'professor', '1', $date, $date]
    );

    $user_data = getData($connection, "SELECT id_u FROM tb_users WHERE name_u =? AND dateCadastre_u =?", [$name, $date])[0];
    $user_id = $user_data['id_u'];

    $sign_professor = signData(
      $connection,
      "INSERT INTO tb_professors(userID_p, name_p, email_p, city_p, neighborhood_p, contact_p, gender_p, birthday_p, BI_p, view_p, dateCadastre_p, dateModification_p) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)",
      [$user_id, $name, $email, $city, $neighborhood, $contact, $gender, $birthday, $BI, "1", $date, $date]
    );

    if ($sign_professor && $sign_user)
      setMessage("professor-message", "alert-success", "Professor cadastrado com sucesso!");
    else 
      setMessage("professor-message", "alert-danger", "Erro ao cadastrar!");
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
        <img class="me-1" src="../img/person.svg" id="IMG">
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

  <?php require_once "navigation.php"; ?>
  <?php require_once "navbarMobile.php"; ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Formulário de cadastramento de professores</h5>
    </div>

    <form action="professors-sign.php" method="post">
      <div class="row">
        <div class="form-group col-md-6 mb-3">
          <label for="textname">Nome</label>
          <input type="text" id="textname" class="form-control" name="name" maxlength="45"
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
          <label for="textcity">Município</label>
          <select id="textcity" class="input form-control" name="city" placeholder="Seu município" required>
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
          <label for="textcontact">Contato</label>
          <input type="text" id="textcontact" class="form-control" name="contact" placeholder="xxx-xx-xx-xx" maxlength="9"
            required>
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textbirthday">Data de Nascimento</label>
          <input type="date" id="textbirthday" class="form-control" name="birthday" required>
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textbi">Número do BI</label>
          <input type="text" id="textbi" class="form-control" name="BI" placeholder="Nª do bilhete" maxlength="15"
            required>
        </div>
      </div>

      <div class="d-flex justify-content-between mt-4">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-cadastre">Salvar</button>
        
        <a href="menu-professors.php" class="btn btn-outline-secondary btn-block col-md-2">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>