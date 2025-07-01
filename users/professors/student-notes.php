<?php
session_start();
require_once "../../connection.php";
require_once "../../features/getData.php";
require_once "../../features/signData.php";

$management_id = mysqli_real_escape_string($connection, trim($_SESSION['management_id']));
$quarter = mysqli_real_escape_string($connection, trim($_SESSION['quarter']));

$data = getData($connection, "SELECT s.name_s, s.id_s FROM tb_students AS s JOIN tb_management AS m ON s.groupID_s = m.groupID_m WHERE id_m =? ORDER BY name_s", [$management_id]);

if (isset($_POST['btn-search'])) {
  $search = mysqli_real_escape_string($connection, trim($_POST['search']));
  $data = getData($connection, "SELECT s.name_s, s.id_s FROM tb_students AS s JOIN tb_management AS m ON s.groupID_s = m.groupID_m WHERE name_s LIKE '$search%' AND id_m = ?", [$management_id]);
}

if (isset($_POST['btn-update'])) {
  $_SESSION['student_id'] = mysqli_real_escape_string($connection, trim($_POST['student_id']));
  header('Location: notes-edit.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Samiga</title>
  <?php require_once "../../head2.php"; ?>
</head>
<body>
    <div class="m-0" id="head-main">
    <h1 class="text-white text-center fs-1 fw-bold m-0">Colégio Samiga</h1>
  </div>

  <div id="head-second">
    <div class="position-relative d-flex justify-content-between align-items-center py-1">
      <div class="d-flex align-items-center gap-3 ms-2 fs-5">
        <?php
          $query = getData($connection, "SELECT * FROM tb_management AS m JOIN tb_disciplines AS d ON m.disciplineID_m = d.id_d JOIN tb_groups AS g ON m.groupID_m = g.id_g WHERE id_m =?", [$management_id])[0];
          echo "<h5 class='fw-bold m-0'>" . $quarter . "º Trimestre  </h5> <h5 class='fw-bold m-0'> " . $query['name_d'] . "</h5> <h5 class='fw-bold m-0'>" . $query['name_g'] . "</h5>";
        ?>
      </div>
      <div class="d-flex">
        <h5 class="mb-0 me-2 fs-5 fw-bold">Usuário :</h5>
        <img class="me-1" src="../../img/person.svg" id="IMG">
        <h5 class="mb-0 me-3 fs-5 fw-bold">Encarregado</h5>
      </div>
    </div>
  </div>

  <?php require_once "nav-professor.php" ?>
  <?php require_once "navMob-professor.php" ?>

  <div class="fs-6 fw-bold rounded-3" id="container-table">
    <div class="gap-2 py-2" id="head-third">
      <?php
        $query = getData($connection, "SELECT * FROM tb_management AS m JOIN tb_disciplines AS d ON m.disciplineID_m = d.id_d JOIN tb_groups AS g ON m.groupID_m = g.id_g WHERE id_m =?", [$management_id])[0];
        echo "<h5 class='fs-6 fw-bold m-0'>" . $quarter . "º Trimestre  </h5> <h5 class='fs-6 fw-bold m-0'> " . $query['name_d'] . "</h5> <h5 class='fs-6 fw-bold m-0'>" . $query['name_g'] . "</h5>";
      ?>
    </div>

    <div class="d-flex justify-content-between" id="margin">
      <button type="button" class="btn btn-primary" data-bs-target="#apagar"
        data-bs-toggle="modal">Gravar</button>

      <form action="student-notes.php" method="post">
        <div class="d-flex align-items-center" id="container-search">
          <input type="text" class="form-control me-2" name="search" placeholder="Pesquisa por nome">
          <button id="btn-search" type="submit" class="btn btn-success" name="btn-search">Pesquisar</button>
        </div> 
      </form>
    </div>

    <div class="table-responsive" id="table">
      <table class="table table-hover table-bordered m-0">
        <thead class="table-secondary position-sticky top-0 left-0" id="theader">
          <tr>
            <th scope="col">Ação</th>
            <th scope="col">Nome</th>
            <th scope="col">Av1</th>
            <th scope="col">Av2</th>
            <th scope="col">Av3</th>
            <th scope="col">Media-Avaliação</th>
            <th scope="col">Pv1</th>
            <th scope="col">Pv2</th>
            <th scope="col">Media-Prova</th>
            <th scope="col">Media-Final</th>
            <th scope="col">Classificação</th>
          </tr>
        </thead>
          <?php if (count($data) > 0) { ?>
          <tbody>
           <?php foreach ($data as $student) {
              $student_id = $student['id_s'];
              $consult = getData($connection, "SELECT * FROM tb_notes WHERE studentID_n =? AND quarterID_n =? AND managementID_n =?", [$student_id, $quarter, $management_id]);

              if (!count($consult) > 0) {
                signData(
                  $connection,
                  "INSERT INTO tb_notes (studentID_n, quarterID_n, managementID_n) VALUES (?,?,?)",
                  [$student_id, $quarter, $management_id]
                );
              }

              $notes = getData($connection, "SELECT * FROM tb_notes WHERE studentID_n =? AND quarterID_n =? AND managementID_n =?", [$student_id, $quarter, $management_id])[0];
              ?>
              <tr>
                <td>
                  <form action="student-notes.php" method="post">
                    <input id="editar1" type="hidden" value="<?= $student['id_s']; ?>" name="student_id">
                    <button type="submit" class="btn btn-warning text-white" name="btn-update">Editar</button>
                  </form>
                </td>
                <td><?= $student['name_s']; ?></td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name = 'aval1' readonly value='" . $notes['evaluation1_n'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='aval2' readonly value='" . $notes['evaluation2_n'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='aval3' readonly value='" . $notes['evaluation3_n'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' name='mediav' readonly value='" . number_format($notes['mediaAv_n'], 1) . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='prova1' readonly value='" . $notes['test1_n'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='prova2' readonly value='" . $notes['test2_n'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' name='mediap' readonly value='" . number_format($notes['mediaPv_n'], 1) . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' name='mediaf' readonly value='" . number_format($notes['mediaF_n'], 1) . "'>" ?>
                </td>
                <td><?= $notes['classification_n']; ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
          <?php } else {
            ?>
        <tfoot class='text text-center'>
          <tr>
            <td colspan="11">
              <h5>Nenhum dado encontrado</h5>
            </td>
          </tr>
        </tfoot>
      <?php } ?>
      </table>
    </div>
  </div>

  <div class="modal fade" id="apagar">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title custom_align" id="Heading">Lançar notas calculadas</h4>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
        </div>

        <div class="modal-body">
          <div class="alert alert-info">Deseja gravar os calculos definitivamente?</div>
        </div>

        <div class="modal-footer">
          <form action="relatorio.php" method="post">
            <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Sim</button>
          </form>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
        </div>
      </div>
    </div>
  </div>

  <?php require_once "../../footer2.php"; ?>
  <script src="routing.js"></script>
</body>
</html>