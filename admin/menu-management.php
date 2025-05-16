<?php
require_once "../connection.php";
require_once "../features/getData.php";
session_start();

if (!isset($_SESSION['logged']))
  header("Location: index.php");

$data = getData($connection, "SELECT * FROM sg_gerenciar AS g JOIN sg_disciplina AS d ON g.idDisciplina = d.id_d JOIN sg_professor AS p ON g.idProfessor = p.id_p JOIN sg_turma AS t ON g.idTurma = t.id_t WHERE view = '1'");

if (isset($_POST['btn-search'])) {
  $search = $_POST['search'];
  $data = getData($connection, "SELECT * FROM sg_gerenciar AS g JOIN sg_disciplina AS d ON g.idDisciplina = d.id_d JOIN sg_professor AS p ON g.idProfessor = p.id_p JOIN sg_turma AS t ON g.idTurma = t.id_t WHERE (nome_p LIKE '$search%') OR (nome_t LIKE '$search%') OR (nome_d LIKE '$search%') AND (view ='1')");
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
        <h5>Gerenciar</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3">Administrador</h5>
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

  <div class="rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Gerenciar</h5>
    </div>

    <div id="divflex">
      <a href="management-sign.php" type="button" id="adicionar" class="btn btn-secondary">Adicionar</a>

      <form action="" method="post">
        <div id="btn-pesquisar">
          <input type="text" class="form-control me-2" name="search" placeholder="Pesquisa por disciplina"><button id="btn-p"
            type="submit" class="btn btn-success" name="btn-search">Pesquisar</button>
        </div>
      </form>
    </div>

    <div class="table-responsive" id="tabdados">
      <table class="table table-hover table-bordered" id="table">
        <thead class="table-secondary" id="theader">
          <tr>
            <th scope="col">Ações</th>
            <th scope="col">Disciplinas</th>
            <th scope="col">Professores</th>
            <th scope="col">turmas</th>
            <th scope="col">Ano</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (count($data) > 0) {
            foreach ($data as $manage_data) { ?>
              <tr id="tr">
                <td>
                  <form action="management-edit.php" method="post">
                    <input id="editar1" type="hidden" value="<?= $manage_data['id_g']; ?>" name="management_id">
                    <button id="editar1" type="submit" class="btn btn-warning">Editar</button>
                  </form>
                </td>
                <td><?= $manage_data['nome_d']; ?></td>
                <td><?= $manage_data['nome_p']; ?></td>
                <td><?= $manage_data['nome_t']; ?></td>
                <td><?= $manage_data['ano']; ?></td>
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
  </div>
  </div>

  <?php require_once "footer.php"; ?>
</body>
</html>