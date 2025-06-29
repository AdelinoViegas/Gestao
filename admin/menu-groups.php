<?php
session_start();
require_once "../connection.php";
require_once "../features/getData.php";

if (!isset($_SESSION['logged']))
  header("Location: index.php");

$data = getData($connection, "SELECT * FROM tb_groups order by name_g");

if (isset($_POST['btn-search'])) {
  $search = mysqli_real_escape_string($connection, trim($_POST['search']));
  $data = getData($connection, "SELECT * FROM tb_groups WHERE name_g LIKE '$search%'");
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
        <h5 class="fs-5 fw-bold">Turmas cadastradas</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3 fs-5 fw-bold">Administrador</h5>
      </div>
    </div>
  </div>

  <?php
  if (isset($_SESSION['group-message'])) {
    echo $_SESSION['group-message'];
    unset($_SESSION['group-message']);
  }
  ?>

  <?php require_once "navigation.php"; ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="fs-6 fw-bold rounded-3" id="container-table">
    <div id="head-third">
      <h5>Turmas cadastradas</h5>
    </div>

    <div id="divflex">
      <a href="groups-sign.php" type="button" id="adicionar" class="btn btn-primary">Adicionar</a>

      <form action="" method="post">
        <div id="btn-pesquisar">
          <input type="text" class="form-control me-2" name="search" placeholder="Pesquisa por nome"><button id="btn-p"
            type="submit" class="btn btn-secondary" name="btn-search">Pesquisar</button>
        </div>
      </form>
    </div>

    <div class="table-responsive" id="tabdados">
      <table class="table table-hover table-bordered" id="table">
        <thead class="table-secondary" id="theader">
          <tr>
            <th scope="col">Ações</th>
            <th scope="col">Nome</th>
          </tr>
        </thead>
        <?php if (count($data) > 0) { ?>
          <tbody>
            <?php foreach ($data as $group_data) { ?>
              <tr id="tr">
                <td id="editar">
                  <form action="groups-edit.php" method="post">
                    <input id="editar1" type="hidden" class="btn btn-warning" value="<?= $group_data['id_g']; ?>"
                      name="group_id">
                    <button id="editar1" type="submit" name="btn-update" class="btn btn-warning">Editar</button>
                  </form>
                </td>
                <td class="w-50"><?= $group_data['name_g']; ?></td>
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