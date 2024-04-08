<?php 
require_once "../conexao.php";

session_start();

$estudante = $_SESSION['nome_aluno'];// id = 5;
$id_estudante = $_SESSION['ida'];
$trim_estudante =  $_SESSION['trim'];
//$_SESSION['tri'] = $trim_estudante;
$sqll = mysqli_query($conexao,"SELECT * FROM sg_aluno WHERE nome_a = 'Carla Miguel Bastos Mora'");
$t = mysqli_fetch_assoc($sqll);
$turma_A = $t['idTurma_a'];

$def = "SELECT * FROM sg_notas AS n JOIN sg_aluno AS a ON n.id_aluno = a.id_a JOIN sg_gerenciar AS g ON g.id_g = n.id_gerenciar JOIN sg_disciplina AS d ON d.id_d = g.idDisciplina WHERE id_aluno = '$id_estudante' AND id_trimestre = '$trim_estudante' AND idTurma_a = '$turma_A'";
$vet = mysqli_query($conexao,$def);

  if (isset($_POST['btn-pesquisa'])) {  
      $pesquisar = $_POST['txtpesquisar'];
      $vet = mysqli_query($conexao,"SELECT * FROM sg_notas AS n JOIN sg_aluno AS a ON n.id_aluno = a.id_a JOIN sg_gerenciar AS g ON g.id_g = n.id_gerenciar JOIN sg_disciplina AS d ON d.id_d = g.idDisciplina WHERE id_aluno = '$id_estudante' AND id_trimestre = '$trim_estudante' AND idTurma_a = '$turma_A' AND nome_d LIKE '$pesquisar%'");
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
       $sum = mysqli_query($conexao,"SELECT * FROM sg_aluno AS a JOIN sg_turma as t ON a.idTurma_a = t.id_t WHERE id_a = '$id_estudante'");
       $trm = mysqli_fetch_assoc($sum);

        echo "<h5 id='alinhar'>".$trim_estudante."º Trimestre  </h5> <p id='fonte'> Turma</p> <h5 id='alinhar'>".$trm['nome_t']."</h5> ";
     ?>
    </div>
    <div class="d-flex">
      <h5 class="me-2">Usuário :</h5>
      <img class="me-1" src="../img/person.svg" id="IMG">
      <h5 class="me-3">Aluno</h5>
    </div>
    </div>
  </div>

<!--Navebar-->
<div class="navegacao">
<ul>
  <li class="list">
    <a href="homealuno.php">
      <span class="icon"><img src="../img/home_white_24dp.svg"></span>
      <span class="title">HOME</span>
    </a>
  </li>
  <li class="list active">
    <a href="ver-notas.php">
      <span class="icon"><img src="../img/perm_identity_white_24dp.svg"></span>
      <span class="title">Notas-Trimestrais</span>
    </a>
    </li>
  <li class="list">
    <a href="#">
      <span class="icon"><img src="../img/format_list_numbered_white_24dp.svg"></span>
      <span class="title">Exame</span>
    </a>
  </li>
  <li class="list">
    <a href="Mediaf.php">
      <span class="icon"><img src="../img/format_list_numbered_white_24dp.svg"></span>
      <span class="title">Resultado-final</span>
    </a>
  </li>
  <li class="list">
    <a href="conf-aluno.php">
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
                    

<?php require_once "navMob-aluno.php" ?>

<div class="rounded-3" id="divm">
  <div class="divsuperior3"> 
    <?php
       $sum = mysqli_query($conexao,"SELECT * FROM sg_aluno AS a JOIN sg_turma as t ON a.idTurma_a = t.id_t JOIN sg_classe AS c ON c.id_c = a.idClasse WHERE id_a = '$id_estudante'");
       $trm = mysqli_fetch_assoc($sum);

        echo "<h5 id='alinhar'>".$trim_estudante."º Trimestre  </h5> <p id='fonte'> Turma</p> <h5 id='alinhar'>".$trm['nome_t']."</h5> ";
     ?>
  </div>

<!--<form action="teste.php" method="post">-->

<div id="divflex">
    <button type="submit" id="adicionar" class="btn btn-secondary">
      <?php echo $trm['nome_c']; ?>
        
      </button>

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
     
      if(mysqli_num_rows($vet) > 0){
      
      while($estudante = mysqli_fetch_assoc($vet)) { 

        ?>

     <tr>    
      <td><?php echo $estudante['nome_d']; ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name = 'aval1' readonly value='".$estudante['avaliacao1']."'>" ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='aval2' readonly value='".$estudante['avaliacao2']."'>"  ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='aval3' readonly value='".$estudante['avaliacao3']."'>"  ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' name='mediav' readonly value='".number_format($estudante['mediaAv'],2)."'>"  ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='prova1' readonly value='".$estudante['prova1']."'>"  ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='prova2' readonly value='".$estudante['prova2']."'>"  ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' name='mediap' readonly value='".number_format($estudante['mediaPv'],2)."'>"  ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' readonly value='".number_format($estudante['mediaF'],1)."'>"  ?>
      </td>
      <td><?php echo $estudante['classificacao']; ?>
  
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
<!--</form>-->


</div>


<?php require_once "../footer2.php";  ?>

</body>
</html>