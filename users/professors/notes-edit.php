<?php
session_start();
require_once "../../connection.php";
require_once "../../features/getData.php";
require_once "../../features/updateData.php";
require_once "../../features/setMessage.php";

$student_id = $_SESSION['student_id'];
$quarter = $_SESSION['quarter'];
$management_id = $_SESSION['management_id'];

if (isset($_POST['btn-calc'])) {
  $evaluation1 = mysqli_real_escape_string($connection, trim($_POST['evaluation1']));
  $evaluation2 = mysqli_real_escape_string($connection, trim($_POST['evaluation2']));
  $evaluation3 = mysqli_real_escape_string($connection, trim($_POST['evaluation3']));
  $test1 = mysqli_real_escape_string($connection, trim($_POST['test1']));
  $test2 = mysqli_real_escape_string($connection, trim($_POST['test2']));
  $mav = ($evaluation1 + $evaluation2 + $evaluation3) / 3;
  $mpv = ($test1 + $test2) / 2;
  $MF = ($mav + $test1 + $test2) / 3;
  
  $group_data = getData($connection, "SELECT * FROM tb_management AS m JOIN tb_groups AS g ON m.groupID_m = g.id_g WHERE id_m =?", [$management_id])[0];
  $group_name = $group_data['name_g'];

  $data = getData($connection, "SELECT name_g FROM tb_groups");
  foreach ($data as $group) {
    $vector[] = $group['name_g'];
  }

  foreach ($vector as $val) {
    if (!($val == '01-A') && !($val == '01-B') && !($val == '02-A') && !($val == '02-B') && !($val == '03-A') && !($val == '03-B') && !($val == '04-A') && !($val == '04-B') && !($val == '05-A') && !($val == '05-B') && !($val == '06-A') && !($val == '06-B')) {
      $group_second[] = $val;
    }

    if (!($val == '07-A') && !($val == '07-B') && !($val == '08-A') && !($val == '08-B') && !($val == '09-A') && !($val == '09-B')) {
      $group_first[] = $val;
    }
  }


  if (in_array($group_name, $group_first)) {
    if ($MF >= 5 && $MF <= 10) {
      $situation = "Aprovado";
    } elseif ($MF >= 1 && $MF < 5) {
      $situation = "reprovado";
    }
  } elseif (in_array($group_name, $group_second)) {
    if ($MF >= 10 && $MF <= 20) {
      $situation = "Aprovado";
    } elseif ($MF >= 1 && $MF < 10) {
      $situation = "reprovado";
    }
  }

  $actualizar_notas = updateData(
    $connection,
    "UPDATE tb_notes SET evaluation1_n=?, evaluation2_n=?, evaluation3_n=?, mediaAv_n=?, mediaPv_n=?, mediaF_n=?, test1_n=?, test2_n=?, classification_n=? WHERE studentID_n=? AND quarterID_n=? AND managementID_n=?",
    [$evaluation1, $evaluation2, $evaluation3, $mav, $mpv, $MF, $test1, $test2, $situation, $student_id, $quarter, $management_id]
  );

  if ($actualizar_notas == true) {
    setMessage("notes-message", "alert-success", "Calculo feito com sucesso!");
  } else {
    setMessage("notes-message", "alert-danger", "Falha ao calcular!");
    header('Location: student-notes.php');
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Aluno</title>
  <?php require_once "../../head2.php"; ?>
</head>
<body>
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>

  <div class="divsuperior2">
    <div class="divflex">
      <div>
        <h5>Editar dados do aluno</h5>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../../img/person.svg" id="IMG">
        <h5 class="me-3">Professor</h5>
      </div>
    </div>
  </div>

  <?php
  if (isset($_SESSION['notes-message'])) {
    echo $_SESSION['notes-message'];
    unset($_SESSION['notes-message']);
  }
  ?>

  <?php require_once "nav-professor.php" ?>
  <?php require_once "navMob-professor.php" ?>

  <div class="fontes rounded-3" id="divm">
    <div class="divsuperior3">
      <h5>Editar dados do aluno</h5>
    </div>

    <form action="" method="post">
      <div class="table-responsive" id="tabdados">
        <table class="table table-hover table-bordered" id="table">
          <thead class="table-secondary" id="theader">
            <tr>
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
          <tbody>
            <?php
            $notes_data = getData(
              $connection,
              "SELECT * FROM tb_notes AS n INNER JOIN tb_students AS s ON n.studentID_n = s.id_s WHERE studentID_n=? AND quarterID_n=? AND managementID_n=?",
              [$student_id, $quarter, $management_id]
            )[0];
            ?>
            <tr>
              <td><?php echo $notes_data['name_s']; ?></td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name = 'evaluation1' value='" . $notes_data['evaluation1_n'] . "'>" ?>
              </td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='evaluation2' value='" . $notes_data['evaluation2_n'] . "'>" ?>
              </td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='evaluation3' value='" . $notes_data['evaluation3_n'] . "'>" ?>
              </td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text'name='mediaAv' readonly value='" . number_format($notes_data['mediaAv_n'], 1) . "'>" ?>
              </td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='test1' value='" . $notes_data['test1_n'] . "'>" ?>
              </td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='test2' value='" . $notes_data['test2_n'] . "'>" ?>
              </td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text' name='mediaPv' readonly value='" . number_format($notes_data['mediaPv_n'], 1) . "'>" ?>
              </td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text' readonly value='" . number_format($notes_data['mediaF_n'], 1) . "'>" ?>
              </td>
              <td><?php echo $notes_data['classification_n']; ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <button type="submit" class="my-2 float-start btn btn-success col-md-2" name="btn-calc"> Calcular</button>

      <a href="student-notes.php">
        <button type="button" class="my-2 float-end btn btn-secondary col-md-2" name="btn-voltar">Voltar
        </button>
      </a>
    </form>
  </div>

  <?php require_once "../../footer2.php"; ?>
  <script src="routing.js"></script>
</body>
</html>