<?php
session_start();
require_once "../connection.php";
require_once "../features/getData.php";
require_once "../features/signData.php";
require_once "../features/setMessage.php";
require_once "../features/getCurrentDate.php";

if (isset($_POST['btn-cadastre'])) {
  $name = mysqli_real_escape_string($connection, trim($_POST['name']));
  $city = mysqli_real_escape_string($connection, trim($_POST['city']));
  $neighborhood = mysqli_real_escape_string($connection, trim($_POST['neighborhood']));
  $gender = mysqli_real_escape_string($connection, trim($_POST['gender']));
  $contact = mysqli_real_escape_string($connection, trim($_POST['contact']));
  $birthday = mysqli_real_escape_string($connection, trim($_POST['birthday']));
  $BI = mysqli_real_escape_string($connection, trim($_POST['BI']));

  $BI_verification = getData($connection, "SELECT BI_r FROM tb_responsibles WHERE BI_r = ?", [$BI]);

  if ($BI_verification) {
    setMessage("responsible-message", "alert-warning", "Codigo de BI já existente!");
  } else {
    $date = getCurrentDate();
    $hash = password_hash('encarregado', PASSWORD_DEFAULT);

    $sign_user = signData(
      $connection,
      "INSERT INTO tb_users(name_u, password_u, state_u, painel_u, view_u, dateCadastre_u, dateModification_u) VALUES (?,?,?,?,?,?,?)",
      [$name, $hash, 'activo', 'encarregado', "1", $date, $date]
    );

    $user_data = getData($connection, "SELECT id_u FROM tb_users WHERE name_u = ? AND dateCadastre_u =?", [$name, $date])[0];
    $user_id = $user_data['id_u'];

    $sign_responsible = signData(
      $connection, 
      "INSERT INTO tb_responsibles(userID_r, name_r, gender_r, city_r, neighborhood_r, birthday_r, contact_r, BI_r, view_r, dateCadastre_r, dateModification_r) VALUES (?,?,?,?,?,?,?,?,?,?,?)",
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
        <img class="me-1" src="../img/person.svg" id="IMG">
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

  <?php require_once "navigation.php" ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Formulário de cadastramento de encarregados</h5>
    </div>

    <form action="responsibles-sign.php" method="post">
      <div class="row">
        <div class="form-group col-md-6 mb-3">
          <label for="textname">Nome</label>
          <input type="text" id="textname" class="form-control" name="name" maxlength="45"
            placeholder="Nome completo do encarregado/a" required>
        </div>
        <div class="form-group col-md-3 mb-3">
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
        <div class="form-group col-md-3 mb-3">
          <label for="textneighborhood">Bairro</label>
          <input type="text" id="textneighborhood" class="form-control" name="neighborhood" maxlength="20"
            placeholder="Seu bairro" required>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-3 mb-3">
          <label for="textgender">sexo</label>
          <select id="textgender" class="input form-control" name="gender" required>
            <option value="">Selecione aqui</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
          </select>
        </div>

        <div class="form-group col-md-3 mb-3">
          <label for="textcontact">Contato</label>
          <input type="text" id="textcontact" class="form-control" name="contact" placeholder="xxx-xx-xx-xx" maxlength="9"
            required>
        </div>

        <div class="form-group col-md-3 mb-3">
          <label for="textbirthday">Data de Nascimento</label>
          <input type="date" id="textbirthday" class="form-control" name="birthday" required>
        </div>
        <div class="form-group col-md-3 mb-3">
          <label for="textbi">Número do BI</label>
          <input type="text" id="textbi" class="form-control" name="BI" placeholder="Nª do bilhete" maxlength="15"
            required>
        </div>
      </div>

      <div class="d-flex justify-content-between mt-4">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-cadastre">Salvar</button>

        <a href="menu-responsibles.php" class="btn btn-outline-secondary btn-block col-md-2">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>