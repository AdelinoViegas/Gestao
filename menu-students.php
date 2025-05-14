<?php
require_once "connection.php";
require_once "features/getData.php";
session_start();

if (!isset($_SESSION['logged']))
  header("Location: index.php");

$data = getData($connection, "SELECT * FROM sg_aluno AS a JOIN sg_turma AS t ON a.idTurma_a = t.id_t JOIN sg_classe AS c ON a.idClasse = c.id_c WHERE view = '1' ORDER BY nome_a");

if (isset($_POST['btn-search'])) {
  $search = mysqli_real_escape_string($connection, trim($_POST['search']));
  $data = getData($connection, "SELECT * FROM sg_aluno AS a JOIN sg_turma AS t ON a.idTurma_a = t.id_t JOIN sg_classe AS c ON a.idClasse = c.id_c WHERE nome_a LIKE '$search%' AND view = '1'");
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
        <h5>Alunos cadastrados</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
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
      <a href="aluno-cadastro.php" type="button" id="adicionar" class="btn btn-secondary">Adicionar</a>

      <form action="" method="post">
        <div id="btn-pesquisar">
          <input type="text" class="form-control me-2" name="search" placeholder="Pesquisa por nome">

          <button id="btn-p" type="submit" class="btn btn-success" name="btn-search">
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
        <tbody>
          <?php
          if (count($data) > 0) {
            foreach ($data as $student_data) {
              ?>
              <tr id="tr">
                <td id="editar">
                  <form action="aluno-editar.php" method="post">
                    <input id="editar1" type="hidden" class="btn btn-warning" value="<?= $student_data['id_a']; ?>"
                      name="student_id">
                    <button id="editar1" type="submit" class="btn btn-warning">Editar</button>
                  </form>

                  <input id="editar1" type="hidden" class="btn btn-warning" value="<?= $student_data['id_a']; ?>"
                    name="id_estudante">
                  <button onclick="chamada()" id="editar2" type="button"
                    data-bs-target="#apagar<?= $student_data['id_a']; ?>" data-bs-toggle="modal"
                    value="<?= $student_data['id_a']; ?>" class="btn btn-danger">Apagar</button>

                  <div class="modal fade" id="apagar<?= $student_data['id_a']; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title custom_align text-dark" id="Heading">Eliminar Registro</h4>

                          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>

                        <div class="modal-body">
                          <div class="alert alert-danger">
                            Deseja excluir
                            <strong><?= $student_data['nome_a']; ?></strong> ?
                          </div>
                        </div>

                        <div class="modal-footer">
                          <form action="aluno-apagar.php" method="post">
                            <input type="hidden" name="student_id" value="<?= $student_data['id_a']; ?>">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Sim</button>
                          </form>

                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                <td><?= $student_data['nome_a']; ?></td>
                <td><?= $student_data['municipio_a']; ?></td>
                <td><?= $student_data['bairro_a']; ?></td>
                <td><?= $student_data['sexo_a']; ?></td>
                <td><?= $student_data['nome_c']; ?></td>
                <td><?= $student_data['nome_t']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php
          } else {
            ?>
        </tbody>
        </table>
        <tfooter class='text text-center'>
          <h5>Nenhum dado encontrado</h5>
        </tfooter>
        <?php
          }
          ?>
    </div>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>