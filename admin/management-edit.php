<?php
session_start();
require_once "../connection.php";
require_once "../features/getData.php";

$management_id = $_POST['management_id'];
$_SESSION['management_id'] = $management_id;

$sql_gerenciar = "SELECT * FROM tb_management AS m JOIN tb_disciplines AS d ON m.disciplineID_m = d.id_d JOIN tb_professors AS p ON m.professorID_m = p.id_p JOIN tb_groups AS g ON m.groupID_m = g.id_g WHERE id_m =?";
$data = getData($connection, $sql_gerenciar, [$management_id])[0];
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
        <h5 class="fs-5 fw-bold">Gerenciar</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3 fs-5 fw-bold">Administrador</h5>
      </div>
    </div>
  </div>

  <?php require_once "navigation.php" ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fs-6 fw-bold rounded-3" id="container-table">
    <div id="head-third">
      <h5>Gerenciar</h5>
    </div>
    <form action="management-edit-process.php" method="post">
      <div class="row mb-4">
        <div class="col-md-4">
          <label for="textdiscipline">Disciplinas</label>
          <select id="textdiscipline" class="form-select" name="discipline" required>
            <option value="<?= $data['id_d']; ?>"><?= $data['name_d']; ?></option>
            <?php
            $discipline_data = getData($connection, "SELECT * FROM tb_disciplines ORDER BY name_d");
            foreach ($discipline_data as $discipline) {
              if ($discipline['name_d'] !== $data['name_d'])
                echo "<option value = '" . $discipline['id_d'] . "'>" . $discipline['name_d'] . "</option>";
            }
            ?>
          </select>
        </div>

        <div class="col-md-4">
          <label for="textprofessor">Professores</label>
          <select id="textprofessor" class="form-select" name="professor" required>
            <option value="<?= $data['id_p']; ?>"><?= $data['name_p']; ?></option>
            <?php $professor_data = getData($connection, "SELECT id_p, name_p FROM tb_professors ORDER BY name_p");
            foreach ($professor_data as $professor) {
              if ($professor['name_p'] !== $data['name_p'])
                echo "<option value = '" . $professor['id_p'] . "'>" . $professor['name_p'] . "</option>";
            }
            ?>
          </select>
        </div>

        <div class="col-md-4">
          <label for="textgroup">Turmas</label>
          <select id="textgroup" class="form-select" name="group" required>
            <option value="<?= $data['id_g'] ?>"><?= $data['name_g']; ?></option>
            <?php
            $group_data = getData($connection, "SELECT id_g, name_g FROM tb_groups ORDER BY name_g");
            foreach ($group_data as $group) {
              if ($group['name_g'] !== $data['name_g'])
                echo "<option value = '" . $group['id_g'] . "'>" . $group['name_g'] . "</option>";
            }
            ?>
          </select>
        </div>
      </div>

      <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-outline-primary btn-block col-md-2" name="btn-update">Salvar</button>

        <a href="menu-management.php" class="btn btn-outline-secondary btn-block col-md-2">Voltar</a>
      </div>
    </form>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>