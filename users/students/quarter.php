<?php
session_start();
require_once "../../connection.php";
require_once "../../features/getData.php";

$student_id = $_SESSION['student_id'];
$student_quarter = $_SESSION['quarter'];

$student_data = getData($connection, "SELECT * FROM tb_students WHERE id_s = ?", [$student_id])[0];
$group_id = $student_data['groupID_s'];

$sql = "SELECT * FROM tb_notes AS n JOIN tb_students AS s ON n.studentID_n = s.id_s JOIN tb_management AS m ON n.managementID_n = m.id_m JOIN tb_disciplines AS d ON m.disciplineID_m = d.id_d WHERE studentID_n =? AND quarterID_n =? AND groupID_s = ?";
$data = getData($connection, $sql, [$student_id, $student_quarter, $group_id]);

if (isset($_POST['btn-search'])) {
  $search = mysqli_real_escape_string($connection, trim($_POST['search']));
  $data = getData(
    $connection, 
    "SELECT * FROM tb_notes AS n JOIN tb_students AS s ON n.studentID_n = s.id_s JOIN tb_management AS m ON n.managementID_n  = m.id_m JOIN tb_disciplines AS d ON m.disciplineID_m = d.id_d WHERE studentID_n =? AND quarterID_n =? AND groupID_s =? AND name_d LIKE '$search%'", 
    [$student_id, $student_quarter, $group_id]
  );
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>principal</title>
  <?php require_once "../../head2.php"; ?>
</head>
<body>
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>

  <div class="divsuperior2">
    <div class="divflex">
      <div>
        <?php
        $student_data = getData($connection, "SELECT * FROM tb_students AS s JOIN tb_groups as g ON s.groupID_s = g.id_g WHERE id_s =?", [$student_id])[0];
        echo "<h5 id='alinhar'>" . $student_quarter . "º Trimestre  </h5> <p id='fonte'> Turma</p> <h5 id='alinhar'>" . $student_data['name_g'] . "</h5> ";
        ?>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../../img/person.svg" id="IMG">
        <h5 class="me-3">Aluno</h5>
      </div>
    </div>
  </div>

  <?php require_once "nav-student.php" ?>
  <?php require_once "navMob-student.php" ?>

  <div class="rounded-3" id="divm">
    <div class="divsuperior3">
      <?php
      $student_data = getData($connection, "SELECT * FROM tb_students AS s JOIN tb_groups as g ON s.groupID_s = g.id_g JOIN tb_class AS c ON s.classID_s = c.id_c WHERE id_s =?", [$student_id])[0];
      echo "<h5 id='alinhar'>" . $student_quarter . "º Trimestre  </h5> <p id='fonte'> Turma</p> <h5 id='alinhar'>" . $student_data['name_g'] . "</h5> ";
      ?>
    </div>

    <div id="divflex">
      <button type="submit" id="adicionar" class="btn btn-secondary">
      <?= $student_data['name_c']; ?>
      </button>

      <form action="" method="post">
        <div class="d-flex align-items-center" id="btn-pesquisar">
          <input type="text" class="form-control me-2" name="search" placeholder="Pesquisa por nome"><button
            type="submit" class="btn btn-success" name="btn-search">Pesquisar</button>
        </div>
      </form>
    </div>

    <div class="table-responsive" id="tabdados">
      <table class="table table-hover table-bordered" id="table">
        <thead class="table-secondary" id="theader">
          <tr>
            <th scope="col">Disciplina</th>
            <th scope="col">Aval1</th>
            <th scope="col">Aval2</th>
            <th scope="col">Aval3</th>
            <th scope="col">Media-Aval</th>
            <th scope="col">Prova1</th>
            <th scope="col">Prova2</th>
            <th scope="col">Media-Prova</th>
            <th scope="col">Media-Final</th>
            <th scope="col">Classificação</th>
          </tr>
        </thead>
          <?php if (count($data) > 0) { ?>
          <tbody>
          <?php foreach ($data as $student) { ?>
              ?>
              <tr>
                <td><?= $student['name_d']; ?></td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name = 'aval1' readonly value='" . $student['evaluation1_n'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='aval2' readonly value='" . $student['evaluation2_n'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='aval3' readonly value='" . $student['evaluation3_n'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' name='mediav' readonly value='" . number_format($student['mediaAv_n'], 2) . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='prova1' readonly value='" . $student['test1_n'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='prova2' readonly value='" . $student['test2_n'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' name='mediap' readonly value='" . number_format($student['mediaPv_n'], 2) . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' readonly value='" . number_format($student['mediaF_n'], 1) . "'>" ?>
                </td>
                <td><?= $student['classification_n']; ?>
                </td>
              </tr>
            <?php } ?>
            </tbody>
           <?php } else { ?>
        </tbody>
        <tfoot class='text text-center'>
          <tr>
            <td colspan="10">
              <h5>
                Nenhum dado encontrado
              </h5>
            </td>
          </tr>
        </tfoot>
        <?php
          }
          ?>
      </table>
    </div>
  </div>

  <?php require_once "../../footer2.php"; ?>
  <script src="routing.js"></script>
</body>
</html>