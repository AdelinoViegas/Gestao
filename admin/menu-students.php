<?php
session_start();
require_once "../connection.php";
require_once "../features/getData.php";

if (!isset($_SESSION['logged']))
  header("Location: index.php");

$data = getData($connection, "SELECT * FROM tb_students AS s JOIN tb_groups AS g ON s.groupID_s = g.id_g JOIN tb_class AS c ON s.classID_s = c.id_c WHERE view_s = '1' ORDER BY name_s");

if (isset($_POST['btn-search'])) {
  $search = mysqli_real_escape_string($connection, trim($_POST['search']));
  $data = getData($connection, "SELECT * FROM tb_students AS s JOIN tb_groups AS g ON s.groupID_s = g.id_g JOIN tb_class AS c ON s.classID_s = c.id_c WHERE name_s LIKE '$search%' AND view_s = '1'");
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
        <h5 class="fs-5 fw-bold">alunos cadastrados</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3 fs-5 fw-bold">Administrador</h5>
      </div>
    </div>
  </div>

  <?php
  if (isset($_SESSION['student-message'])) {
    echo $_SESSION['student-message'];
    unset($_SESSION['student-message']);
  }
  ?>

  <?php require_once "navigation.php"; ?>
  <?php require_once "navbarMobile.php"; ?>

  <div class="rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Alunos cadastrados</h5>
    </div>

    <div id="divflex">
      <a href="students-sign.php" type="button" id="adicionar" class="btn btn-primary">Adicionar</a>

      <form action="" method="post">
        <div id="btn-pesquisar">
          <input type="text" class="form-control me-2" name="search" placeholder="Pesquisa por nome">

          <button id="btn-p" type="submit" class="btn btn-secondary" name="btn-search">
            Pesquisar
          </button>
        </div>
      </form>
    </div>

    <div class="table-responsive" id="tabdados">
      <table class="table table-hover table-bordered" id="table">
        <thead class="table-secondary" id="theader">
          <tr>
            <th scope="col">Ações</th>
            <th scope="col">Nome</th>
            <th scope="col">Município</th>
            <th scope="col">Bairro</th>
            <th scope="col">Sexo</th>
            <th scope="col">Classe</th>
            <th scope="col">Turma</th>
          </tr>
        </thead>
        <?php if (count($data) > 0) { ?>
          <tbody>
            <?php foreach ($data as $student_data) { ?>
              <tr id="tr">
                <td id="editar">
                  <form action="students-edit.php" method="post">
                    <input id="editar1" type="hidden" class="btn btn-warning" value="<?= $student_data['id_s']; ?>"
                      name="student_id">
                    <button id="editar1" type="submit" class="btn btn-warning">Editar</button>
                  </form>

                  <input id="editar1" type="hidden" class="btn btn-warning" value="<?= $student_data['id_s']; ?>"
                    name="id_estudante">
                  <button id="editar2" type="button"
                    data-bs-target="#apagar<?= $student_data['id_s']; ?>" data-bs-toggle="modal"
                    value="<?= $student_data['id_s']; ?>" class="btn btn-danger">Apagar</button>

                  <div class="modal fade" id="apagar<?= $student_data['id_s']; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title custom_align text-dark" id="Heading">Eliminar Registro</h4>

                          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>

                        <div class="modal-body">
                          <div class="alert alert-danger">
                            Deseja excluir
                            <strong><?= $student_data['name_s']; ?></strong> ?
                          </div>
                        </div>

                        <div class="modal-footer">
                          <form action="students-delete.php" method="post">
                            <input type="hidden" name="student_id" value="<?= $student_data['id_s']; ?>">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Sim</button>
                          </form>

                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                <td><?= $student_data['name_s']; ?></td>
                <td><?= $student_data['city_s']; ?></td>
                <td><?= $student_data['neighborhood_s']; ?></td>
                <td><?= $student_data['gender_s']; ?></td>
                <td><?= $student_data['name_c']; ?></td>
                <td><?= $student_data['name_g']; ?></td>
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