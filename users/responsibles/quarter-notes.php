<?php
require_once "../../connection.php";
require_once "../../features/getData.php";
session_start();

  $student_id = mysqli_real_escape_string($connection, trim($_SESSION['student_id']));
  $quarter = mysqli_real_escape_string($connection, trim($_SESSION['quarter']));

  $query = "SELECT * FROM sg_notas AS n JOIN sg_aluno AS a ON n.id_aluno = a.id_a JOIN sg_gerenciar AS g ON g.id_g = n.id_gerenciar JOIN sg_disciplina AS d ON d.id_d = g.idDisciplina WHERE id_aluno =? AND id_trimestre =?";
  $data = getData($connection, $query, [$student_id, $quarter]);

  if (isset($_POST['btn-search'])) {
    $search = mysqli_real_escape_string($connection, trim($_POST['search']));
    $data = getData($connection, "SELECT * FROM sg_notas AS n JOIN sg_aluno AS a ON n.id_aluno = a.id_a JOIN sg_gerenciar AS g ON g.id_g = n.id_gerenciar JOIN sg_disciplina AS d ON d.id_d = g.idDisciplina WHERE id_aluno =? AND id_trimestre =? AND nome_d LIKE '$search%'", [$student_id, $quarter]);
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Samiga</title>
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
        $group_data = getData($connection, "SELECT * FROM sg_aluno AS a JOIN sg_turma as t ON a.idTurma_a = t.id_t WHERE id_a =?", [$student_id])[0];
        echo "<h5 id='alinhar'>" . $quarter . "º Trimestre </h5> <h5 id='alinhar'></h5><p id='fonte'>Turma:</p> <h5 id='alinhar'>" . $group_data['nome_t'] . "</h5> ";
        ?>
      </div>
      <div class="d-flex">
        <h5 class="me-2">Usuário :</h5>
        <img class="me-1" src="../../img/person.svg" id="IMG">
        <h5 class="me-3">Encarregado</h5>
      </div>
    </div>
  </div>

  <div class="navegacao">
    <ul>
      <li class="list">
        <a href="home.php">
          <span class="icon"><img src="../../img/home_white_24dp.svg"></span>
          <span class="title">HOME</span>
        </a>
      </li>
      <li class="list active">
        <a href="notes.php">
          <span class="icon"><img src="../../img/perm_identity_white_24dp.svg"></span>
          <span class="title">Ver-notas</span>
        </a>
      </li>
      <li class="list">
        <a href="settings.php">
          <span class="icon"><img src="../../img/settings.png"></span>
          <span class="title">Alterar-senha</span>
        </a>
      </li>
      <li class="list">
        <a href="../../logoult.php">
          <span class="icon"><img src="../../img/logout_white_24dp.svg"></span>
          <span class="title">Sair</span>
        </a>
      </li>
    </ul>
  </div>

  <?php require_once "navMob-encarregado.php"; ?>

  <div class="rounded-3" id="divm">
    <div class="divsuperior3">
      <?php
      $group_data = getData($connection, "SELECT * FROM sg_turma AS t JOIN sg_aluno as a ON a.idTurma_a = t.id_t JOIN sg_classe as c ON  t.idClasse_t = c.id_c  WHERE id_a =?", [$student_id])[0];
      echo "<h5 id='alinhar'>" . $quarter . "º Trimestre </h5> <h5 id='alinhar'>      </h5><p id='fonte'>Turma:</p> <h5 id='alinhar'>" . $group_data['nome_t'] . "</h5> ";
      ?>
    </div>

    <div id="divflex">
      <button type="button" id="adicionar" class="btn btn-secondary"><strong id="fonte">
          <?= $group_data['nome_c']; ?>
        </strong></button>

      <form action="" method="post">
        <div id="btn-pesquisar">
          <input type="text" class="form-control me-2" name="search" placeholder="Pesquisa a disciplina"><button
            id="btn-p" type="submit" class="btn btn-success" name="btn-search">Pesquisar</button>
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
          if (count($data) > 0) {
            foreach ($data as $student) {
              ?>
              <tr>
                <td><?= $student['nome_d']; ?></td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name = 'aval1' readonly value='" . $student['avaliacao1'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='aval2' readonly value='" . $student['avaliacao2'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='aval3' readonly value='" . $student['avaliacao3'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' name='mediav' readonly value='" . number_format($student['mediaAv'], 2) . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='prova1' readonly value='" . $student['prova1'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='prova2' readonly value='" . $student['prova2'] . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' name='mediap' readonly value='" . number_format($student['mediaPv'], 2) . "'>" ?>
                </td>
                <td>
                  <?= "<input class='form-control ps-1' type='text' readonly value='" . number_format($student['mediaF'], 1) . "'>" ?>
                </td>
                <td><?= $student['classificacao']; ?>
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

  <?php require_once "../../footer2.php"; ?>
</body>
</html>