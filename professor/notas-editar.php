<?php 
require_once "../connection.php";
session_start();

var_dump($_SESSION);
die();
$id_a = $_SESSION['student_id'];
$trim = $_SESSION['quarter'];
$gerenciar = $_SESSION['management_id'];

if (isset($_POST['calc'])) {


$v1 = $_POST['aval1'];
$v2 = $_POST['aval2'];
$v3 = $_POST['aval3'];
$mav = ($v1+$v2+$v3)/3;
$p1 = $_POST['prova1'];
$p2 = $_POST['prova2'];
$mpv = ($p1+$p2)/2;
$MF= ($mav+$p1+$p2)/3;



 /*SElecionar a turma  onde será calculada a media*/
  $Turm = mysqli_query($conexao,"SELECT * FROM sg_gerenciar AS g JOIN sg_turma AS t ON t.id_t=g.idTurma WHERE id_g ='$gerenciar' ");
  $vet=mysqli_fetch_assoc($Turm);
  $nomeTurma = $vet['nome_t'];

  $res = mysqli_query($conexao,"SELECT nome_t FROM sg_turma");
  while($arr = mysqli_fetch_assoc($res)){
       $vector[] = $arr['nome_t'];
  } 

foreach ($vector as $val) {
if( !($val == '01-A') && !($val == '01-B') && !($val == '02-A') && !($val == '02-B') && !($val == '03-A') && !($val == '03-B') && !($val == '04-A') && !($val == '04-B') && !($val == '05-A') && !($val == '05-B') && !($val == '06-A') && !($val == '06-B')){
    $turma_secundario[] = $val;
   }

  if( !($val == '07-A') && !($val == '07-B') && !($val == '08-A') && !($val == '08-B') && !($val == '09-A') && !($val == '09-B')){
   $turma_primario[] = $val;
   }   
}


  /*Ensino primario*/
      if(in_array($nomeTurma,$turma_primario )){
      if ($MF >= 5 && $MF <= 10) {
          $situacao = "Aprovado"; 
      }elseif($MF >= 1 && $MF < 5){
          $situacao = "reprovado";   
      }
     //Ensino secundário
    }elseif(in_array($nomeTurma,$turma_secundario )){
        if ($MF >= 10 && $MF <= 20) {
         $situacao = "Aprovado"; 
      }elseif($MF >= 1 && $MF < 10){
         $situacao = "reprovado";   
      }
    }


$sql_notas = "UPDATE sg_notas SET avaliacao1='$v1',avaliacao2='$v2',avaliacao3='$v3',mediaAv='$mav',mediaPv='$mpv',mediaF = '$MF',prova1='$p1',prova2='$p2',classificacao = '$situacao' WHERE id_aluno ='$id_a' AND id_trimestre = '$trim' AND id_gerenciar = '$gerenciar'"; 

$actualizar_notas = mysqli_query($conexao,$sql_notas);

if($actualizar_notas == true){

 $_SESSION['Notas-actualizado'] = "
				<div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-success alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
        Calculo feito com sucesso!
      </div>
   </div>
   </div>";

}else{
   $_SESSION['Notas-actualizado'] = "
				<div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-danger alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
        Falha ao calcular!
      </div>
   </div>
   </div>";

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
  if(isset($_SESSION['Notas-actualizado'])){
      echo $_SESSION['Notas-actualizado'];
      unset($_SESSION['Notas-actualizado']);
    }  
   ?>

<!--Navebar-->
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

		
		$qli = "SELECT * FROM sg_notas AS n INNER JOIN sg_aluno AS a ON a.id_a = n.id_aluno WHERE id_aluno = '$id_a' AND id_trimestre = '$trim' AND id_gerenciar = '$gerenciar' ";
		$up = mysqli_query($conexao,$qli);
		$nota = mysqli_fetch_assoc($up) 

       ?>
     <tr>    
      <td><?php echo $nota['nome_a']; ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name = 'aval1'value='".$nota['avaliacao1']."'>" ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='aval2'value='".$nota['avaliacao2']."'>"  ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='aval3'value='".$nota['avaliacao3']."'>"  ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text'name='mediaAv' readonly value='".number_format($nota['mediaAv'],1)."'>"  ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='prova1'value='".$nota['prova1']."'>"  ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' maxlength='4' size='2' name='prova2'value='".$nota['prova2']."'>"  ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' name='mediaPv' readonly value='".number_format($nota['mediaPv'],1)."'>"  ?></td>
      <td><?php echo "<input class='form-control ps-1' type='text' readonly value='".number_format($nota['mediaF'],1)."'>"  ?>
      </td>
      <td><?php echo $nota['classificacao']; ?>
  
      </td>
    </tr>


  </tbody>
</table>
</div>   

       
           	<button type="submit" class="my-2 float-start btn btn-success col-md-2" name="calc"> Calcular</button> 

          <a href="notasAlunos.php">
          	<button type="button" class="my-2 float-end btn btn-secondary col-md-2" 
           name="btn-voltar">Voltar
          </button>
         </a>

 
  </form>

</div>


<?php require_once "../footer2.php";  ?>
</body>
</html>

<?php 


 ?>