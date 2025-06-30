<?php
session_start();
require_once "../connection.php";
require_once "../features/getData.php";

if (!isset($_SESSION['logged']))
  header("Location: index.php");

$data = getData($connection, "SELECT * FROM tb_management AS m JOIN tb_disciplines AS d ON m.disciplineID_m = d.id_d JOIN tb_professors AS p ON m.professorID_m = p.id_p JOIN tb_groups AS g ON m.groupID_m = g.id_g WHERE view_p = '1'");

if (isset($_POST['btn-search'])) {
  $search = $_POST['search'];
  $data = getData($connection, "SELECT * FROM tb_management AS m JOIN tb_disciplines AS d ON m.disciplineID_m = d.id_d JOIN tb_professors AS p ON m.professorID_m = p.id_p JOIN tb_groups AS g ON m.groupID_m = g.id_g WHERE (name_p LIKE '$search%') OR (name_g LIKE '$search%') OR (name_d LIKE '$search%') AND (view_p ='1')");
}
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

  <?php
  if (isset($_SESSION['management-message'])) {
    echo $_SESSION['management-message'];
    unset($_SESSION['management-message']);
  }
  ?>

  <?php require_once "navigation.php"; ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fs-6 fw-bold rounded-3" id="container-table">
    <div id="head-third">
      <h5>Gerenciar</h5>
    </div>

    <div id="divflex">
      <a href="management-sign.php" type="button" id="adicionar" class="btn btn-primary">Adicionar</a>

      <form action="" method="post">
        <div id="btn-pesquisar">
          <input type="text" class="form-control me-2" name="search" placeholder="Pesquisa por disciplina"><button
            id="btn-p" type="submit" class="btn btn-secondary" name="btn-search">Pesquisar</button>
        </div>
      </form>
    </div>

    <div class="table-responsive" id="table">
      <table class="table table-hover table-bordered m-0">
        <thead class="table-secondary position-sticky top-0 left-0" id="theader">
          <tr>
            <th scope="col">Ações</th>
            <th scope="col">Disciplinas</th>
            <th scope="col">Professores</th>
            <th scope="col">turmas</th>
            <th scope="col">Ano</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($data) > 0) { ?>
          <tbody>
            <?php foreach ($data as $management_data) { ?>
              <tr>
                <td>
                  <form action="management-edit.php" method="post">
                    <input id="editar1" type="hidden" value="<?= $management_data['id_g']; ?>" name="management_id">
                    <button id="editar1" type="submit" class="btn btn-warning">Editar</button>
                  </form>
                </td>
                <td><?= $management_data['name_d']; ?></td>
                <td><?= $management_data['name_p']; ?></td>
                <td><?= $management_data['name_g']; ?></td>
                <td><?= $management_data['year_m']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        <?php } else { ?>
          <tfoot class='text text-center'>
            <tr>
              <td colspan="5">
                <h5>Nenhum dado encontrado</h5>
              </td>
            </tr>
          </tfoot>
        <?php } ?>
      </table>  
    </div>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>