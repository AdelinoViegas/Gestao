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
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>
  <div class="divsuperior2">

  </div>
  <div class="divsuperior2">
    <div class="divflex">
      <div>
        <h5>Usuários cadastrados</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
      </div>
    </div>
  </div>

  <?php require_once "navigation.php"; ?>
  <?php require_once "navbarMobile.php" ?>

  <div class="rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Usuários cadastrados</h5>
    </div>

    <div id="divflex">
      <h5 id="adicionar">Nª de Usuários : <span id='num'><?= count($data) ? count($data) : "0"; ?></span></h5>

      <form action="" method="post">
        <div id="btn-pesquisar">
          <input type="text" class="form-control me-2" name="search" placeholder="Pesquisa por nome"><button id="btn-p"
            type="submit" class="btn btn-success" name="btn-search">Pesquisar</button>
        </div>
      </form>
    </div>

    <div class="table-responsive" id="tabdados">
      <table class="table table-hover table-bordered" id="table">
        <thead class="table-secondary" id="theader">
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