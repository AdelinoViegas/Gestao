<?php 
require_once "../connection.php";
require_once "../features/getData.php";
require_once "../features/signData.php";
session_start();
 
$management_id = $_SESSION['management_id']; 
$quarter = $_SESSION['quarter'];

$data = getData($connection, "SELECT a.nome_a,a.id_a FROM sg_aluno AS a JOIN sg_gerenciar AS g ON a.idTurma_a = g.idTurma WHERE id_g =? ORDER BY nome_a", [$management_id]);

if (isset($_POST['btn-search'])) {
  $search = $_POST['search'];
  $data = getData($connection, "SELECT a.nome_a,a.id_a FROM sg_aluno AS a JOIN sg_gerenciar AS g ON a.idTurma_a = g.idTurma WHERE nome_a LIKE '$search%' AND id_g = ?", [$management_id]);               
}

if(isset($_POST['btn-update'])){
 $_SESSION['student_id'] = $_POST['student_id'];
  header('Location: notas-editar.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Samiga</title>
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
       $query  = getData($connection, "SELECT * FROM sg_gerenciar AS g JOIN sg_disciplina AS d ON g.idDisciplina = d.id_d JOIN sg_turma AS t ON t.id_t = g.idTurma WHERE id_g =?", [$management_id])[0];
       echo "<h5 id='alinhar'>".$quarter."º Trimestre  </h5> <p id='fonte'> : ".$query['nome_d']."</p> <h5 id='alinhar'>".$query['nome_t']."</h5> ";
     ?>
    </div>
    <div class="d-flex">
      <h5 class="me-2">Usuário :</h5>
      <img class="me-1" src="../img/person.svg" id="IMG">
      <h5 class="me-3">Professor</h5>
    </div>
    </div>
  </div>
  
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

<div class="rounded-3" id="divm">
  <div class="divsuperior3">
    <?php 
       $querie = getData($connection, "SELECT * FROM sg_gerenciar AS g JOIN sg_disciplina AS d ON g.idDisciplina = d.id_d JOIN sg_turma AS t ON t.id_t = g.idTurma WHERE id_g =?", [$management_id]);
       echo "<h5 id='alinhar'>".$trimestre."º Trimestre </h5> <p id='fonte'>  ".$query['nome_d']."</p> <h5 id='alinhar'>".$query['nome_t']."</h5> ";
     ?>
  </div>

<div id="divflex">
    <button type="button" id="adicionar" class="btn btn-primary" data-bs-target="#apagar" data-bs-toggle="modal">Gravar</button>
    <!--<h5 id="adicionar">Nª de alunos : <span id='num'><?php /*
    $nomeT = $p['nome_t'];
     $result = mysqli_query($conexao,"SELECT nome_a FROM sg_aluno JOIN sg_turma ON sg_aluno.idTurma = sg_turma.id_t WHERE nome_t = '$nomeT'");
     $alunos = mysqli_num_rows($result);
    echo $alunos; */?></span></h5>-->

<form action="" method="post">
  <div class="d-flex align-items-center" id="btn-pesquisar">
    <input type="text" class="form-control me-2" name="txtpesquisar" placeholder="Pesquisa por nome"><button type="submit" class="btn btn-success" name="btn-pesquisa">Pesquisar</button>
  </div>
</form> 
</div>

<div class="table-responsive" id="tabdados">

<table class="table table-hover table-bordered" id="table">
  <thead class="table-secondary" id="theader">
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
  <tbody>
      <?php 

      if(count($data) > 0){

      foreach($data as $student) { 
         $student_id = $student['id_a'];
         $consult = getData($connection, "SELECT * FROM sg_notas WHERE id_aluno =? AND id_trimestre =? AND id_gerenciar =?", [$student_id, $quarter, $management_id]);
         
         if(!count($consult) > 0){
            signData(
              $connection,
              "INSERT INTO sg_notas (id_aluno,id_trimestre,id_gerenciar) VALUES (?,?,?)",
              [$student_id, $quarter, $management_id]
            );
         }

          $notes = getData($connection, "SELECT * FROM sg_notas WHERE id_aluno =? AND id_trimestre =? AND id_gerenciar =?", [$student_id, $quarter, $management_id])[0];
        ?>
     <tr> 
      <td>
        <form action="" method="post">
          <input id="editar1" type="hidden" value="<?= $student['id_a']; ?>" name="student_id">
        <button type="submit" class="btn btn-warning text-white" name="btn-update">Editar</button>
        </form>
      </td>   
      <td><?= $student['nome_a']; ?></td>
      <td><?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name = 'aval1' readonly value='".$notes['avaliacao1']."'>" ?></td>
      <td><?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='aval2' readonly value='".$notes['avaliacao2']."'>"  ?></td>
      <td><?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='aval3' readonly value='".$notes['avaliacao3']."'>"  ?></td>
      <td><?= "<input class='form-control ps-1' type='text' name='mediav' readonly value='".number_format($notes['mediaAv'],1)."'>"  ?></td>
      <td><?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='prova1' readonly value='".$notes['prova1']."'>"  ?></td>
      <td><?= "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='prova2' readonly value='".$notes['prova2']."'>"  ?></td>
      <td><?= "<input class='form-control ps-1' type='text' name='mediap' readonly value='".number_format($notes['mediaPv'],1)."'>"  ?></td>
      <td><?= "<input class='form-control ps-1' type='text' name='mediaf' readonly value='".number_format($notes['mediaF'],1)."'>"  ?>  
      </td>
      <td><?= $notes['classificacao'];  ?>
        
      </td>

    </tr>

 

  <?php } ?>

  </tbody>
</table>

<?php

 }else{

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

<!--Modal-->
<div class="modal fade" id="apagar">
  <div class="modal-dialog">
  <div class="modal-content">

    <div class="modal-header">
      <h4 class="modal-title custom_align" id="Heading">Lançar notas calculadas</h4>
      <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
    </div> 

    <div class="modal-body">
    <!--<input type="hidden" name="idUsuario" class="form-control" id="idUsuario">-->
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


<?php require_once "../footer2.php";  ?>
<script src="calc.js?v=4"></script>

</body>
</html>
