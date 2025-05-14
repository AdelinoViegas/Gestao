<?php
require_once "connection.php";
require_once "features/getData.php";
session_start();

$professor_id = $_POST['professor_id'];
$_SESSION['professor_id'] = $professor_id;
$data = getData($connection, "SELECT * FROM sg_professor WHERE id_p = ?", [$professor_id])[0];
$city_array = ["Luanda", "Viana", "Belas", "Cazenga", "Kissama", "Kilamba Kiaxi", "Talatona", "Cacuaco", "Icolo e Bengo"];
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
        <h5>Editar dados do professor</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
      </div>
    </div>
  </div>

  <?php require_once "navigation.php"; ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Editar dados do professor</h5>
    </div>

    <form action="professors-edit-process.php" method="post">
      <div class="row">
        <div class="form-group col-md-6 mb-3">
          <label for="textnome">Nome</label>
          <input type="text" id="textnome" class="form-control" name="name" placeholder="Nome do professor"
            value="<?= $data['nome_p']; ?>">
        </div>
        <div class="form-group col-md-6" id="margemB">
          <label for="textemail">E-mail</label>
          <input type="email" id="textemail" class="form-control" name="email" placeholder="E-mail do professor"
            value="<?= $data['email_p']; ?>">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-4 mb-3">
          <label for="textmun">Município</label>
          <select id="textmun" class="input form-control" name="city" required>
            <option value="<?= $data['municipio_p'] ?>"><?= $data['municipio_p'] ?></option>
           <?php   
             foreach($city_array as $city){
              if($city !== $data['municipio_p']){?>
                  <option value="<?= $city ?>"><?= $city ?></option>
           <?php }}?>
          </select>
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textbairro">Bairro</label>
          <input type="text" id="textbairro" class="form-control" name="neighborhood" placeholder="Seu bairro"
            value="<?= $data['bairro_p']; ?>" required>
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textsexo">sexo</label>
          <select type="text" id="textsexo" class="input md form-control" name="gender" required>
            <?php
            if ($data['sexo_p'] === "Masculino") {
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
          <label for="textcont">Contato</label>
          <input type="text" id="textcont" class="form-control" name="contact" placeholder="xxx-xx-xx-xx"
            value="<?= $data['contato_p']; ?>">
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textnasc">Data de Nascimento</label>
          <input type="date" id="textnasc" class="form-control" name="birthday"
            value="<?= $data['nascimento_p']; ?>">
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textbi">Número do BI</label>
          <input type="text" id="textbi" class="form-control" name="BI" placeholder="Nª do bilhete"
            value="<?= $data['numeroBI_p']; ?>">
        </div>
      </div>

      <div class="row" id="marg">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-update"
          id="margemBotao">Salvar</button>

        <div class="col-md-8" id="margemBotao"></div>

        <a href="menu-professors.php" class="btn btn-outline-secondary btn-block col-md-2"
          name="cadastramento">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>