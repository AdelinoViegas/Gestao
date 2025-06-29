<?php
session_start();
require_once "../connection.php";
require_once "../features/getData.php";

$professor_id = $_POST['professor_id'];
$_SESSION['professor_id'] = $professor_id;
$data = getData($connection, "SELECT * FROM tb_professors WHERE id_p = ?", [$professor_id])[0];
$city_array = ["Luanda", "Viana", "Belas", "Cazenga", "Kissama", "Kilamba Kiaxi", "Talatona", "Cacuaco", "Icolo e Bengo"];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Samiga</title>
  <?php require_once "head.php"; ?>
</head>
<body>
  <div class="m-0" id="head-main">
    <h1 class="text-white text-center fs-1 fw-bold">Colégio Samiga</h1>
  </div>
  
  <div id="head-second">
    <div class="position-relative d-flex justify-content-between">
      <div>
        <h5 class="fs-5 fw-bold">Editar dados do professor</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3 fs-5 fw-bold">Administrador</h5>
      </div>
    </div>
  </div>

  <?php require_once "navigation.php"; ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fs-6 fw-bold rounded-3" id="container-table">
    <div id="head-third">
      <h5>Editar dados do professor</h5>
    </div>

    <form action="professors-edit-process.php" method="post">
      <div class="row">
        <div class="form-group col-md-6 mb-3">
          <label for="textname">Nome</label>
          <input type="text" id="textname" class="form-control" name="name" placeholder="Nome do professor"
            value="<?= $data['name_p']; ?>">
        </div>
        <div class="form-group col-md-6" id="margemB">
          <label for="textemail">E-mail</label>
          <input type="email" id="textemail" class="form-control" name="email" placeholder="E-mail do professor"
            value="<?= $data['email_p']; ?>">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-4 mb-3">
          <label for="textcity">Município</label>
          <select id="textcity" class="input form-control" name="city" required>
            <option value="<?= $data['city_p'] ?>"><?= $data['city_p'] ?></option>
           <?php   
             foreach($city_array as $city){
              if($city !== $data['city_p']){?>
                  <option value="<?= $city ?>"><?= $city ?></option>
           <?php }}?>
          </select>
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textneighborhood">Bairro</label>
          <input type="text" id="textneighborhood" class="form-control" name="neighborhood" placeholder="Seu bairro"
            value="<?= $data['neighborhood_p']; ?>" required>
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textgender">sexo</label>
          <select type="text" id="textgender" class="input md form-control" name="gender" required>
            <?php
            if ($data['gender_p'] === "Masculino") {
              ?>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
            <?php } else { ?>
              <option value="Femenino">Femenino</option>
              <option value="Masculino">Masculino</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-4 mb-3">
          <label for="textcontact">Contato</label>
          <input type="text" id="textcontact" class="form-control" name="contact" placeholder="xxx-xx-xx-xx"
            value="<?= $data['contact_p']; ?>">
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textbirthday">Data de Nascimento</label>
          <input type="date" id="textbirthday" class="form-control" name="birthday"
            value="<?= $data['birthday_p']; ?>">
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textbi">Número do BI</label>
          <input type="text" id="textbi" class="form-control" name="BI" placeholder="Nª do bilhete"
            value="<?= $data['BI_p']; ?>">
        </div>
      </div>

      <div class="d-flex justify-content-between mt-4">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-update">Salvar</button>

        <a href="menu-professors.php" class="btn btn-outline-secondary btn-block col-md-2">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>