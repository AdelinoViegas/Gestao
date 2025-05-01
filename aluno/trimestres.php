<?php
require_once "../connection.php";
require_once "features/getData.php";
session_start();

$student_name = $_SESSION['student_name'];
$student_id = $_SESSION['student_id'];
$student_quarter = $_SESSION['quarter'];

$student_data = getData($connection, "SELECT * FROM sg_aluno WHERE nome_a = ?", [$student_name]);
$group_id = $student_data['idTurma_a'];

$sql = "SELECT * FROM sg_notas AS n JOIN sg_aluno AS a ON n.id_aluno = a.id_a JOIN sg_gerenciar AS g ON g.id_g = n.id_gerenciar JOIN sg_disciplina AS d ON d.id_d = g.idDisciplina WHERE id_aluno =? AND id_trimestre =? AND idTurma_a = ?";
$data2 = getData($connection, $sql, [$student_id, $student_quarter, $group_id]);

if (isset($_POST['btn-search'])) {
  $search = $_POST['txtpesquisar'];
  $data = mysqli_query($conection, "SELECT * FROM sg_notas AS n JOIN sg_aluno AS a ON n.id_aluno = a.id_a JOIN sg_gerenciar AS g ON g.id_g = n.id_gerenciar JOIN sg_disciplina AS d ON d.id_d = g.idDisciplina WHERE id_aluno = '$student_id' AND id_trimestre = '$student_quarter' AND idTurma_a = '$group_id' AND nome_d LIKE '$pesquisar%'");
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>principal</title>
  <?php require_once "../head2.php"; ?>
</head>

<body>
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>

  <div class="divsuperior2">
    <div class="divflex">
      <div>
        <?php
        $student_data = getData($connection, "SELECT * FROM sg_aluno AS a JOIN sg_turma as t ON a.idTurma_a = t.id_t WHERE id_a =?", [$student_id]);

        echo "<h5 id='alinhar'>" . $student_quarter . "º Trimestre  </h5> <p id='fonte'> Turma</p> <h5 id='alinhar'>" . $student_data['nome_t'] . "</h5> ";
        ?>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../img/person.svg" id="IMG">
        <h5 class="me-3">Aluno</h5>
      </div>
    </div>
  </div>

  <?php require_once "nav-aluno.php" ?>
  <?php require_once "navMob-aluno.php" ?>

  <div class="rounded-3" id="divm">
    <div class="divsuperior3">
      <?php
      $student_data = getData($conection, "SELECT * FROM sg_aluno AS a JOIN sg_turma as t ON a.idTurma_a = t.id_t JOIN sg_classe AS c ON c.id_c = a.idClasse WHERE id_a =?", [$student_id]);
      echo "<h5 id='alinhar'>" . $student_quarter . "º Trimestre  </h5> <p id='fonte'> Turma</p> <h5 id='alinhar'>" . $student_data['nome_t'] . "</h5> ";
      ?>
    </div>

    <div id="divflex">
      <button type="submit" id="adicionar" class="btn btn-secondary">
        <?php echo $student_data['nome_c']; ?>
      </button>

      <form action="" method="post">
        <div class="d-flex align-items-center" id="btn-pesquisar">
          <input type="text" class="form-control me-2" name="txtpesquisar" placeholder="Pesquisa por nome"><button
            type="submit" class="btn btn-success" name="btn-pesquisa">Pesquisar</button>
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
        <tbody>
          <?php
          if (count($data2) > 0) {
            foreach ($data2 as $student) {
              ?>
              <tr>
                <td><?php echo $student['nome_d']; ?></td>
                <td>
                  <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name = 'aval1' readonly value='" . $student['avaliacao1'] . "'>" ?>
                </td>
                <td>
                  <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='aval2' readonly value='" . $student['avaliacao2'] . "'>" ?>
                </td>
                <td>
                  <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='aval3' readonly value='" . $student['avaliacao3'] . "'>" ?>
                </td>
                <td>
                  <?php echo "<input class='form-control ps-1' type='text' name='mediav' readonly value='" . number_format($student['mediaAv'], 2) . "'>" ?>
                </td>
                <td>
                  <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='prova1' readonly value='" . $student['prova1'] . "'>" ?>
                </td>
                <td>
                  <?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='prova2' readonly value='" . $student['prova2'] . "'>" ?>
                </td>
                <td>
                  <?php echo "<input class='form-control ps-1' type='text' name='mediap' readonly value='" . number_format($student['mediaPv'], 2) . "'>" ?>
                </td>
                <td>
                  <?php echo "<input class='form-control ps-1' type='text' readonly value='" . number_format($student['mediaF'], 1) . "'>" ?>
                </td>
                <td><?php echo $student['classificacao']; ?>
                </td>
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

  <?php require_once "../footer2.php"; ?>
</body>
</html>