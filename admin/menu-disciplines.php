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
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>

  <div class="divsuperior2">
    <div class="divflex">
      <div>
        <h5>Disciplinas cadastradas</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
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

  <div class="rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Disciplinas cadastradas</h5>
    </div>

    <div id="divflex">
      <a href="disciplines-sign.php" type="button" id="adicionar" class="btn btn-secondary">Adicionar</a>

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
            <th scope="col">Ações</th>
            <th scope="col">Nome</th>
          </tr>
        </thead>
        <?php if (count($data) > 0) { ?>
          <tbody>
            <?php foreach ($data as $discipline_data) { ?>
              <tr id="tr">
                <td id="editar">
                  <form action="disciplines-edit.php" method="post">
                    <input id="editar1" type="hidden" class="btn btn-warning" value="<?= $discipline_data['id_d']; ?>"
                      name="discipline_id">
                    <button id="editar1" type="submit" class="btn btn-warning">Editar</button>
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