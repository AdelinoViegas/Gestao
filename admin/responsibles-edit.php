<?php
require_once "../connection.php";
require_once "../features/getData.php";
session_start();

$responsible_id = $_POST['responsible_id'];
$_SESSION['responsible_id'] = $responsible_id;
$data = getData($connection, "SELECT * FROM sg_encarregado WHERE id_e = ?", [$responsible_id])[0];
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
        <h5>Editar dados do encarregado</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
      </div>
    </div>
  </div>

  <?php require_once "navigation.php" ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Editar dados do encarregado</h5>
    </div>

    <form action="responsibles-edit-process.php" method="post">
      <div class="row">
        <div class="form-group col-md-6 mb-3">
          <label for="textnome">Nome</label>
          <input type="text" id="textnome" class="form-control" name="name" maxlength="45" placeholder="Nome do aluno"
            value="<?= $data['nome_e']; ?>" required>
        </div>
        <div class="form-group col-md-3 mb-3">
          <label for="textmun">Município</label>
          <select id="textmun" class="input form-control" name="city" required>
            <option value="<?= $data['municipio_e'] ?>"><?= $data['municipio_e'] ?></option>
            
            <?php
            foreach ($city_array as $city) {
              if ($city !== $data['municipio_e']) { ?>
                <option value="<?= $city ?>"><?= $city ?></option>
              <?php }
            } ?>
          </select>
        </div>
        <div class="form-group col-md-3 mb-3">
          <label for="textbairro">Bairro</label>
          <input type="text" id="textbairro" class="form-control" name="neighborhood" maxlength="20"
            placeholder="Seu bairro" value="<?= $data['bairro_e']; ?>" required>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-4 mb-3">
          <label for="textsexo">sexo</label>
          <select type="text" id="textsexo" class="input md form-control" name="gender" value="<?= $data['sexo_e']; ?>"
            required>
            <?php
            if ($data['sexo_e'] == 'Masculino') {
              ?>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
            <?php } else { ?>
              <option value="Femenino">Femenino</option>
              <option value="Masculino">Masculino</option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textcont">Contato</label>
          <input type="text" id="textcont" class="form-control" name="contact" maxlength="9"
            value="<?= $data['contato_e']; ?>" placeholder="xxx-xx-xx-xx" required>
        </div>
        <div class="form-group col-md-4 mb-3">
          <label for="textnasc">Data de Nascimento</label>
          <input type="date" id="textnasc" class="form-control" name="birthday" value="<?= $data['nascimento_e']; ?>"
            required>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-3 mb-3">
          <label for="textbi">Número do BI</label>
          <input type="text" id="textbi" class="form-control" name="BI" value="<?= $data['numeroBI_e']; ?>"
            placeholder="Nª do bilhete" maxlength="15" required>
        </div>
      </div>

      <div class="row" id="marg">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-update"
          id="margemBotao">Gravar</button>

        <div class="col-md-8" id="margemBotao"></div>

        <a href="menu-responsibles.php" class="btn btn-outline-secondary btn-block col-md-2"
          name="btn-voltar">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>