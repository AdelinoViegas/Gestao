<?php
session_start();
require_once "../connection.php";
require_once "../features/getData.php";

$student_id = $_POST['student_id'];
$_SESSION['student_id'] = $student_id;

$sql_student = "SELECT * FROM tb_students AS s join tb_class AS c ON s.classID_s = c.id_c join tb_groups AS g ON s.groupID_s = g.id_g WHERE id_s =?";
$student_data = getData($connection, $sql_student, [$student_id])[0];
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
        <h5>Editar dados do aluno</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
      </div>
    </div>
  </div>

  <?php require_once "navigation.php" ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Editar dados do aluno</h5>
    </div>
    <form action="students-edit-process.php" method="post">
      <div class="row">
        <div class="form-group col-md-6 mb-3">
          <label for="textnome">Nome</label>
          <input type="text" id="textnome" class="form-control" name="name" value="<?= $student_data['name_s']; ?>">
        </div>

        <div class="form-group col-md-3 mb-3">
          <label for="textclasse">Classe</label>
          <select id="textclasse" class="input form-control" name="class" required>
            <option value="<?= $student_data['classID_s'] ?>"><?= $student_data['name_c']; ?></option>
            <?php
            $class_data = getData($connection, "SELECT * FROM tb_class");
            foreach ($class_data as $class)
              echo "<option value = '" . $class['id_c'] . "'>" . $class['name_c'] . "</option>";
            ?>
          </select>
        </div>

        <div class="form-group col-md-3 mb-3">
          <label for="textturma">Turma</label>
          <select id="textturma" class="input form-control" name="group" required>
            <option value="<?= $student_data['groupID_s'] ?>"><?= $student_data['name_g']; ?></option>
            <?php 
            $group_data = getData($connection, "SELECT id_g, name_g FROM tb_groups");
            foreach ($group_data as $group) {
              echo "<option value = '" . $group['id_g'] . "'>" . $group['name_g'] . "</option>";
            }
            ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-4 mb-3">
          <label for="textmun">Município</label>
          <select id="textmun" class="input form-control" name="city" placeholder="Seu município" required>
            <option value="<?= $student_data['city_s'] ?>"><?= $student_data['city_s'] ?></option>
            <?php
            foreach ($city_array as $city) {
              if ($city !== $student_data['city_s']) { ?>
                <option value="<?= $city ?>"><?= $city ?></option>
              <?php }
            } ?>
          </select>
        </div>

        <div class="form-group col-md-4 mb-3">
          <label for="textbairro">Bairro</label>
          <input type="text" id="textbairro" class="form-control" name="neighborhood"
            value="<?= $student_data['neighborhood_s']; ?>">
        </div>

        <div class="form-group col-md-4 mb-3">
          <label for="textsexo">sexo</label>
          <select type="text" id="textsexo" class="input md form-control" name="gender"
            value="<?= $student_data['gender_s']; ?>" required>
            <?php
            if ($student_data['gender_s'] == 'Masculino') {
              ?>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
            <?php } else { ?>
              <option value="<?= $student_data['gender_s']; ?>">Femenino</option>
              <option value="Masculino">Masculino</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-4 mb-3">
          <label for="textcont">Contato</label>
          <input type="text" id="textcont" class="form-control" name="contact"
            value="<?= $student_data['contact_s']; ?>">
        </div>

        <div class="form-group col-md-4" id="margemB">
          <label for="textnasc">Data de Nascimento</label>
          <input type="date" id="textnasc" class="form-control" name="birthday"
            value="<?= $student_data['birthday_s']; ?>">
        </div>

        <div class="form-group col-md-4 mb-3">
          <label for="textbi">Número do BI</label>
          <input type="text" id="textbi" class="form-control" name="BI" value="<?= $student_data['BI_s']; ?>">
        </div>
      </div>

      <div class="row">
        <?php
        $responsible_data = getData($connection, "SELECT * FROM tb_students AS s INNER JOIN tb_responsibles AS r ON s.responsibleID_s = r.id_r WHERE id_s = ?", [$student_id])[0];
        ?>
        <div class="form-group col-md-6 mb-3">
          <label for="textencarregado">Encarregado</label>
          <input type="text" readonly id="textencarregado" class="form-control" name="responsible_id" maxlength="45"
            value="<?= $responsible_data['name_r']; ?>" required>
        </div>
      </div>

      <div class="row" id="marg">
        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" name="btn-update"
          id="margemBotao">Gravar</button>

        <div class="col-md-8" id="margemBotao"></div>

        <a href="menu-students.php" class="btn btn-outline-secondary btn-block col-md-2" name="cadastramento">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>