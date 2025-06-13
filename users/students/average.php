<?php
require_once "../../connection.php";
require_once "../../features/getData.php";
session_start();

$some = 0;
$discipline = [];
$list = [];
$student_id = $_SESSION['student_id'];

$data1 = getData(
  $connection,
  "SELECT * FROM tb_notes AS n JOIN tb_students AS s ON n.studentID_n = s.id_s JOIN tb_management AS m ON n.managementID_n = m.id_m JOIN tb_disciplines AS d ON d.id_d = m.disciplineID_m WHERE studentID_n =? AND quarterID_n =? ORDER BY name_d",
  [$student_id, '1']
);

foreach ($data1 as $value) {
  $result1[] = $value['mediaF_n'];
}

$data2 = getData(
  $connection,
  "SELECT * FROM tb_notes AS n JOIN tb_students AS s ON n.studentID_n = s.id_s JOIN tb_management AS m ON n.managementID_n = m.id_m JOIN tb_disciplines AS d ON d.id_d = m.disciplineID_m WHERE studentID_n =? AND quarterID_n =? ORDER BY name_d",
  [$student_id, '2']
);

foreach ($data2 as $value) {
  $result2[] = $value['mediaF_n'];
}

$data3 = getData(
  $connection,
  "SELECT * FROM tb_notes AS n JOIN tb_students AS s ON n.studentID_n = s.id_s JOIN tb_management AS m ON n.managementID_n = m.id_m JOIN tb_disciplines AS d ON d.id_d = m.disciplineID_m WHERE studentID_n =? AND quarterID_n =? ORDER BY name_d",
  [$student_id, '3']
);

foreach ($data3 as $value) {
  $result3[] = $value['mediaF_n'];
  $discipline[] = $value['name_d'];
}

if (isset($_POST['btn-search'])) {
  global $search;
  $search = mysqli_real_escape_string($connection, trim($_POST['search']));
  $search_discipline = getData(
    $connection,
    "SELECT mediaF_n, quarterID_n, name_d FROM tb_notes AS n JOIN tb_students AS s ON n.studentID_n = s.id_s JOIN tb_management AS m ON n.managementID_n = m.id_m JOIN tb_disciplines AS d ON d.id_d = m.disciplineID_m WHERE studentID_n =? AND name_d LIKE '$search%' ORDER BY quarterID_n",
    [$student_id]
  );
  
  if(count($search_discipline)){
    foreach($search_discipline as $value){
      $some += (number_format($value['mediaF_n'], 2));
      if(!in_array($value['name_d'], $list)){
        array_push($list, $value['name_d']);
      }
      
      if(!in_array($value['mediaF_n'], $list)){
        array_push($list, number_format($value['mediaF_n'], 2));
      }
    }
  }
   
  if(count($list))
      array_push($list, round($some / 3));
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
        <h5>Resultado Final</h5>
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
      <h5>Resultado Final</h5>
    </div>

    <div id="divflex">
      <button type="submit" id="adicionar" class="btn btn-secondary">
        <?php
        $class_data = getData(
          $connection,
          "SELECT * FROM tb_students AS s JOIN tb_groups as g ON s.groupID_s = g.id_g JOIN tb_class AS c ON s.classID_s = c.id_c WHERE id_s =?",
          [$student_id]
        )[0];

        echo $class_data['name_c']; ?>
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
            <th scope="col">Media-1ºtrimestre</th>
            <th scope="col">Media-2ºtrimestre</th>
            <th scope="col">Media-3ºtrimestre</th>
            <th scope="col">Resultado-Final</th>
          </tr>
        </thead>
        <tbody>

          <?php
           if(count($list) && strlen($search)){                 
          ?>
            <tr>
            <td><?=  $list[0]; ?></td>
            <?php for($i = 1; $i < count($list); $i++){?>
            <td>
              <?php echo "<input class='form-control ps-1' type='text' readonly value='" . $list[$i] . "'>" ?>
            </td>
            <?php }?>
          </tr>
          <?php
          }else if (count($discipline) || strlen($search)) {
            var_dump("entra aqui jovem"); die(); for ($c = 0; $c < count($discipline); $c++) {
              ?>
              <tr>
                <td><?= $discipline[$c]; ?></td>
                <td>
                  <?php echo "<input class='form-control ps-1' type='text' readonly value='" . number_format($result1[$c], 2) . "'>" ?>
                </td>
                <td>
                  <?php echo "<input class='form-control ps-1' type='text' readonly value='" . number_format($result2[$c], 2) . "'>" ?>
                </td>
                <td>
                  <?php echo "<input class='form-control ps-1' type='text' readonly value='" . number_format($result3[$c], 2) . "'>" ?>
                </td>
                <?php $M_Final[] = round(($result1[$c] + $result2[$c] + $result3[$c]) / 3); ?>
                <td><?php echo "<input class='form-control ps-1' type='text' readonly value='" . $M_Final[$c] . "'>" ?>
                </td>
              </tr>
          <?php } 
        }else{ ?>
        <tfooter class='text text-center'>
          <h5>Nenhum dado encontrado</h5>
        </tfooter>
        <?php } ?>
      </table>
    </div>
    <button type="submit" id="adicionar" class="btn btn-info my-2">Condição Final
  </div>

  <?php require_once "../../footer2.php"; ?>
  <script src="routing.js"></script>
</body>
</html>