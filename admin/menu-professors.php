<?php
session_start();
require_once "../connection.php";
require_once "../features/getData.php";

if (!isset($_SESSION['logged']))
  header("Location: index.php");

$data = getData($connection, "SELECT * FROM tb_professors WHERE view_p = '1' ORDER BY name_p");

if (isset($_POST['btn-search'])) {
  $search = mysqli_real_escape_string($connection, trim($_POST['search']));
  $data = getData($connection, "SELECT * FROM tb_professors WHERE name_p LIKE '$search%' AND view_p = '1'");
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
        <h5 class="fs-5 fw-bold">Professores cadastrados</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3 fs-5 fw-bold">Administrador</h5>
      </div>
    </div>
  </div>

  <?php
  if (isset($_SESSION['professor-message'])) {
    echo $_SESSION['professor-message'];
    unset($_SESSION['professor-message']);
  }
  ?>

  <?php require_once "navigation.php"; ?>
  <?php require_once "navbarMobile.php"; ?>

  <div class="fs-6 fw-bold rounded-3" id="container-table">
    <div id="head-third">
      <h5>Professores cadastrados</h5>
    </div>

    <div class="d-flex justify-content-between" id="margin">
      <a href="professors-sign.php" type="button" class="btn btn-primary">Adicionar</a>

      <form action="" method="post">
        <div id="container-search">
          <input type="text" class="form-control me-2" name="search" placeholder="Pesquisa por nome">

          <button id="btn-search" type="submit" class="btn btn-secondary" name="btn-search">
            Pesquisar
          </button>
        </div>
      </form>
    </div>

    <div class="table-responsive" id="table">
      <table class="table table-hover table-bordered m-0">
        <thead class="table-secondary position-sticky top-0 left-0" id="theader">
          <tr>
            <th scope="col">Ações</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Município</th>
            <th scope="col">Bairro</th>
            <th scope="col">Sexo</th>
            <th scope="col">Contato</th>
          </tr>
        </thead>
        <?php if (count($data) > 0) { ?>
          <tbody>
            <?php foreach ($data as $professor_data) { ?>
              <tr>
                <td id="editar">
                  <form action="professors-edit.php" method="post">
                    <input type="hidden" class="btn btn-warning w-100 text-white" value="<?= $professor_data['id_p']; ?>"
                      name="professor_id">
                    <button type="submit" class="btn btn-warning w-100 text-white">Editar</button>
                  </form>

                  <button type="button" data-bs-target="#apagar<?= $professor_data['id_p']; ?>"
                    data-bs-toggle="modal" class="btn btn-danger w-100 text-white">Apagar</button>

                  <div class="modal fade" id="apagar<?= $professor_data['id_p']; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title custom_align text-dark" id="Heading">Eliminar Registro</h4>

                          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>

                        <div class="modal-body">
                          <div class="alert alert-danger">
                            Deseja excluir
                            <strong><?= $professor_data['name_p']; ?></strong> ?
                          </div>
                        </div>

                        <div class="modal-footer">
                          <form action="professors-delete.php" method="post">
                            <input type="hidden" name="professor_id" value="<?= $professor_data['id_p']; ?>">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Sim</button>
                          </form>

                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                <td><?= $professor_data['name_p']; ?></td>
                <td><?= $professor_data['email_p']; ?></td>
                <td><?= $professor_data['city_p']; ?></td>
                <td><?= $professor_data['neighborhood_p']; ?></td>
                <td><?= $professor_data['gender_p']; ?></td>
                <td><?= $professor_data['contact_p']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        <?php } else { ?>
          <tfoot class='text text-center'>
            <tr>
              <td colspan="7">
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