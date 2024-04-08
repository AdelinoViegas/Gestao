<?php 
require_once "../conexao.php";

session_start();
 
$id_gerenciar = $_SESSION['gerir']; 
$trimestre = $_SESSION['periodo'];


$sql = "SELECT a.nome_a,a.id_a FROM sg_aluno AS a JOIN sg_gerenciar AS g ON a.idTurma = g.idTurma WHERE id_g = '$id_gerenciar' JOIN sg_exame AS e ON a.id_a=e.idEstudante ";
$res = mysqli_query($conexao,$sql);

if (isset($_POST['btn-pesquisa'])) {
          $pesquisar = $_POST['txtpesquisar'];
          $res = mysqli_query($conexao,"SELECT a.nome_a,a.id_a FROM sg_aluno AS a JOIN sg_gerenciar AS g ON a.idTurma = g.idTurma WHERE nome_a LIKE '$pesquisar%' AND id_g = '$id_gerenciar'");               
}

if(isset($_POST['idest'])){

 $_SESSION['ID_A'] = $_POST['idestudante'];
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
     <h5>Exame</h5>
    </div>
    <div class="d-flex">
      <h5 class="me-2">Usuário :</h5>
      <img class="me-1" src="../img/person.svg" id="IMG">
      <h5 class="me-3">Professor</h5>
    </div>
    </div>
  </div>
  
<!--Navebar-->
<div class="navegacao">
<ul>
  <li class="list">
    <a href="homeprof.php">
      <span class="icon"><img src="../img/home_white_24dp.svg"></span>
      <span class="title">HOME</span>
    </a>
  </li>
  <li class="list">
    <a href="lancar-notas.php">
      <span class="icon"><img src="../img/perm_identity_white_24dp.svg"></span>
      <span class="title">Lancar-notas</span>
    </a>
  </li>
  <li class="list active">
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
    <h5>Exame</h5>
  </div>

      <form action="" method="post">

        <div class="row">

          <div class="form-group col-md-4" id="margemB">
            <label for="texttrimestre">Exame</label>
           <select id="texttrimestre" class="input form-control"
           name="trimestre"  required>
              <option value="">Selecione aqui</option>
              <option value="1">Exame Final</option>
              <option value="2">Exame Recurso</option>
           </select>
         </div>

       <div class="form-group col-md-2" id="margemB">
        <label></label>
          <button type="submit" id="inserir" class="btn btn-success col-md-12" 
           name="ok">Buscar</button>
        </div>
         


        </div>
      </form>
</div>


<?php require_once "../footer2.php";  ?>
<script src="calc.js?v=4"></script>

</body>
</html>