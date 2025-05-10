<?php
require_once "../connection.php";
require_once "../features/getData.php";
require_once "../features/updateData.php";
require_once "../features/setMessage.php"; 
session_start();

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

  $group_data = getData($connection, "SELECT * FROM sg_gerenciar AS g JOIN sg_turma AS t ON t.id_t=g.idTurma WHERE id_g =?", [$management_id])[0];
  $group_name = $group_data['nome_t'];

  $data = getData($connection, "SELECT nome_t FROM sg_turma");
  foreach ($data as $group) {
    $vector[] = $group['nome_t'];
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
    "UPDATE sg_notas SET avaliacao1=?, avaliacao2=?, avaliacao3=?, mediaAv=?, mediaPv=?, mediaF=?, prova1=?, prova2=?, classificacao=? WHERE id_aluno=? AND id_trimestre=? AND id_gerenciar=?", 
    [$evaluation1, $evaluation2, $evaluation3, $mav, $mpv, $MF, $test1, $test2, $situation, $student_id, $quarter, $management_id]
  );

  if ($actualizar_notas == true) {
    setMessage("notes-message", "alert-success", "Calculo feito com sucesso!");
  } else {
    setMessage("notes-message", "alert-danger", "Falha ao calcular!");
    header('Location: notasAlunos.php');
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Aluno</title>
  <?php require_once "../head2.php"; ?>
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
        <img class="me-1" src="../img/person.svg" id="IMG">
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

  <div class="navegacao">
    <ul>
      <li class="list">
        <a href="homeprof.php">
          <span class="icon"><img src="../img/home_white_24dp.svg"></span>
          <span class="title">HOME</span>
        </a>
      </li>
      <li class="list active">
        <a href="lancar-notas.php">
          <span class="icon"><img src="../img/perm_identity_white_24dp.svg"></span>
          <span class="title">Lancar-notas</span>
        </a>
      </li>
      <li class="list">
        <a href="exames.php">
          <span class="icon"><img src="../img/format_list_numbered_white_24dp.svg"></span>
          <span class="title">Exame</span>
        </a>
      </li>
      <li class="list">
        <a href="conf-professor.php">
          <span class="icon"><img src="../img/settings.png"></span>
          <span class="title">Alterar-senha</span>
        </a>
      </li>
      <li class="list">
        <a href="../logoult.php">
          <span class="icon"><img src="../img/logout_white_24dp.svg"></span>
          <span class="title">Sair</span>
        </a>
      </li>
    </ul>
  </div>

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
              "SELECT * FROM sg_notas AS n INNER JOIN sg_aluno AS a ON a.id_a = n.id_aluno WHERE id_aluno =? AND id_trimestre =? AND id_gerenciar =?",
              [$student_id, $quarter, $management_id])[0];
              ?>
            <tr>
              <td><?php echo $notes_data['nome_a']; ?></td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name = 'evaluation1' value='" . $notes_data['avaliacao1'] . "'>" ?>
              </td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='evaluation2' value='" . $notes_data['avaliacao2'] . "'>" ?>
              </td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='evaluation3' value='" . $notes_data['avaliacao3'] . "'>" ?>
              </td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text'name='mediaAv' readonly value='" . number_format($notes_data['mediaAv'], 1) . "'>" ?>
              </td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='test1' value='" . $notes_data['prova1'] . "'>" ?>
              </td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='test2' value='" . $notes_data['prova2'] . "'>" ?>
              </td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text' name='mediaPv' readonly value='" . number_format($notes_data['mediaPv'], 1) . "'>" ?>
              </td>
              <td>
                <?php echo "<input class='form-control ps-1' type='text' readonly value='" . number_format($notes_data['mediaF'], 1) . "'>" ?>
              </td>
              <td><?php echo $notes_data['classificacao']; ?>

              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <button type="submit" class="my-2 float-start btn btn-success col-md-2" name="btn-calc"> Calcular</button>

      <a href="notasAlunos.php">
        <button type="button" class="my-2 float-end btn btn-secondary col-md-2" name="btn-voltar">Voltar
        </button>
      </a>
    </form>
  </div>

  <?php require_once "../footer2.php"; ?>
</body>
</html>