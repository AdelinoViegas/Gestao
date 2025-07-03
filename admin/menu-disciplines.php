<?php
session_start();
require_once "../connection.php";
require_once "../features/getData.php";

if (!isset($_SESSION['logged']))
  header("Location: index.php");

$data = getData($connection, "SELECT * FROM tb_disciplines order by name_d");

if (isset($_POST['btn-search'])) {
  $search = mysqli_real_escape_string($connection, trim($_POST['search']));
  $data = getData($connection, "SELECT * FROM tb_disciplines WHERE name_d LIKE '$search%'");
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
        <h5 class="fs-5 fw-bold">Disciplinas cadastradas</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3 fs-5 fw-bold">Administrador</h5>
      </div>
    </div>
  </div>
  
  <?php
  if (isset($_SESSION['discipline-message'])) {
    echo $_SESSION['discipline-message'];
    unset($_SESSION['discipline-message']);
  }
  ?>

  <?php require_once "navigation.php"; ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fs-6 fw-bold rounded-3" id="container-table">
    <div id="head-third">
      <h5>Disciplinas cadastradas</h5>
    </div>

    <div class="d-flex justify-content-between" id="margin">
      <a href="disciplines-sign.php" type="button" id="adicionar" class="btn btn-primary">Adicionar</a>

      <form action="" method="post">
        <div id="container-search">
          <input type="text" class="form-control me-2" name="search" placeholder="Pesquisa por nome">
          <button id="btn-search" type="submit" class="btn btn-secondary" name="btn-search">Pesquisar</button>
        </div>
      </form>
    </div>

    <div class="table-responsive" id="table">
      <table class="table table-hover table-bordered m-0">
        <thead class="table-secondary position-sticky top-0 left-0" id="theader">
          <tr>
            <th scope="col">Ações</th>
            <th scope="col">Nome</th>
          </tr>
        </thead>
        <?php if (count($data) > 0) { ?>
          <tbody>
            <?php foreach ($data as $discipline_data) { ?>
              <tr>
                <td id="editar">
                  <form action="disciplines-edit.php" method="post">
                    <input type="hidden" class="btn btn-warning w-100 text-white" value="<?= $discipline_data['id_d']; ?>"
                      name="discipline_id">
                    <button type="submit" class="btn btn-warning w-100 text-white">Editar</button>
                  </form>
                </td>
                <td class="w-50"><?= $discipline_data['name_d']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        <?php } else { ?>
          <tfoot class='text text-center'>
            <tr>
              <td colspan="2">
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