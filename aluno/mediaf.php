<?php
require_once "../connection.php";
require_once "../features/getData.php";;
session_start();

$estudante = $_SESSION['student_name'];
$id_estudante = $_SESSION['student_id'];

$valor = mysqli_query($conection, "SELECT * FROM sg_notas AS n JOIN sg_aluno AS a ON n.id_aluno = a.id_a JOIN sg_gerenciar AS g ON g.id_g = n.id_gerenciar JOIN sg_disciplina AS d ON d.id_d = g.idDisciplina WHERE id_aluno = '$id_estudante' AND id_trimestre = '1' ");

while ($area = mysqli_fetch_assoc($valor)) {
  $v[] = $area['mediaF'];
}

$valor1 = mysqli_query($conection, "SELECT * FROM sg_notas AS n JOIN sg_aluno AS a ON n.id_aluno = a.id_a JOIN sg_gerenciar AS g ON g.id_g = n.id_gerenciar JOIN sg_disciplina AS d ON d.id_d = g.idDisciplina WHERE id_aluno = '$id_estudante' AND id_trimestre = '2' ");

while ($area1 = mysqli_fetch_assoc($valor1)) {
  $v1[] = $area1['mediaF'];
}

$valor2 = mysqli_query($conection, "SELECT * FROM sg_notas AS n JOIN sg_aluno AS a ON n.id_aluno = a.id_a JOIN sg_gerenciar AS g ON g.id_g = n.id_gerenciar JOIN sg_disciplina AS d ON d.id_d = g.idDisciplina WHERE id_aluno = '$id_estudante' AND id_trimestre = '3' ");

while ($area2 = mysqli_fetch_assoc($valor2)) {
  $v2[] = $area2['mediaF'];
  $disc[] = $area2['nome_d'];

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
        <h5>Resultado Final</h5>
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
      <h5>Resultado Final</h5>
    </div>

    <div id="divflex">
      <button type="submit" id="adicionar" class="btn btn-secondary">
        <?php
        $sum = mysqli_query($conection, "SELECT * FROM sg_aluno AS a JOIN sg_turma as t ON a.idTurma_a = t.id_t JOIN sg_classe AS c ON c.id_c = a.idClasse WHERE id_a = '$id_estudante'");
        $trm = mysqli_fetch_assoc($sum);
        echo $trm['nome_c']; ?>
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
            <th scope="col">Media-1ºtrimestre</th>
            <th scope="col">Media-2ºtrimestre</th>
            <th scope="col">Media-3ºtrimestre</th>
            <th scope="col">Resultado-Final</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $res = mysqli_query($conection, "SELECT * FROM sg_notas WHERE id_aluno = '$id_estudante'");
          if (mysqli_num_rows($res) > 0) {
            for ($c = 0; $c < count($v); $c++) {
              ?>
              <tr>
                <td><?php echo $disc[$c]; ?></td>
                <td>
                  <?php echo "<input class='form-control ps-1' type='text' readonly value='" . number_format($v[$c], 2) . "'>" ?>
                </td>
                <td>
                  <?php echo "<input class='form-control ps-1' type='text' readonly value='" . number_format($v1[$c], 2) . "'>" ?>
                </td>
                <td>
                  <?php echo "<input class='form-control ps-1' type='text' readonly value='" . number_format($v2[$c], 2) . "'>" ?>
                </td>
                <?php $M_Final[] = number_format(($v[$c] + $v1[$c] + $v2[$c]) / 3) ?>
                <td><?php echo "<input class='form-control ps-1' type='text' readonly value='" . $M_Final[$c] . "'>" ?>
                </td>

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
    <button type="submit" id="adicionar" class="btn btn-info my-2">Condição Final
  </div>

  <?php require_once "../footer2.php"; ?>
</body>
</html>