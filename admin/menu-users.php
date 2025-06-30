<?php
session_start();
require_once "../connection.php";
require_once "../features/getData.php";

if (!isset($_SESSION['logged']))
  header("Location: index.php");

$data = getData($connection, "SELECT * FROM tb_users WHERE view_u = '1' AND painel_u != 'admin' ORDER BY name_u");

if (isset($_POST['btn-search'])) {
  $search = $_POST['search'];
  $data = getData($connection, "SELECT * FROM tb_users WHERE name_u LIKE '$search%' AND view_u = '1' AND painel_u != 'admin'");
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
        <h5 class="fs-5 fw-bold">Usuários cadastrados</h5>
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
      <h5>Usuários cadastrados</h5>
    </div>

    <div class="d-flex justify-content-between" id="margin">
      <h5 class="fw-bold text-black">Nª de Usuários : <span class="fw-normal"><?= count($data) ? count($data) : "0"; ?></span></h5>

      <form action="" method="post">
        <div id="btn-search">
          <input type="text" class="form-control me-2" name="search" placeholder="Pesquisa por nome"><button id="btn-p"
            type="submit" class="btn btn-secondary" name="btn-search">Pesquisar</button>
        </div>
      </form>
    </div>

    <div class="table-responsive" id="table">
      <table class="table table-hover table-bordered m-0">
        <thead class="table-secondary position-sticky top-0 left-0" id="theader">
          <tr>
            <th scope="col">Estado</th>
            <th scope="col">Nome</th>
            <th scope="col">Painel</th>
          </tr>
        </thead>
        <?php if (count($data) > 0) { ?>
          <tbody>
            <?php foreach ($data as $l_usuario) {
              ?>
              <tr>
                <td id="estado">
                  <?php
                  $button = $l_usuario['state_u'] === "activo" ? "btn-success" : "btn-danger";
                  ?>
                  <form action="change-user.php" method="post">
                    <input type="hidden" name="userState" value="<?= $l_usuario['state_u']; ?>">
                    <input type="hidden" name="userId" value="<?= $l_usuario['id_u']; ?>">
                    <button id="btn2" name="btn-state" type="submit" class="<?= "btn btn-md " . $button ?>">
                      <?= $l_usuario['state_u']; ?></button>
                  </form>
                </td>
                <td id="nome"><?= $l_usuario['name_u']; ?></td>
                <td id="painel"><?= $l_usuario['painel_u']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        <?php } else { ?>
          <tfoot class='text text-center'>
            <tr>
              <td colspan="3">
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