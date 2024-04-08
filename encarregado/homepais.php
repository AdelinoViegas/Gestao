<?php 
//conexão
require_once "../conexao.php";
session_start();

//verficar se está logado
if(!isset($_SESSION['logado'])){
  header("Location: ../index.php");
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
      <h5>Pailnel-principal</h5>
    </div>
    <div class="d-flex">
      <h5 class="me-2">Usuário :</h5>
      <img class="me-1" src="../img/person.svg" id="IMG">
      <h5 class="me-3">Encarregado</h5>
    </div>
    </div>
  </div>

<!--Navebar-->
<div class="navegacao">
<ul>
	<li class="list active">
		<a href="homepais.php">
			<span class="icon"><img src="../img/home_white_24dp.svg"></span>
			<span class="title">HOME</span>
		</a>
	</li>
	<li class="list">
		<a href="ver-notas.php">
			<span class="icon"><img src="../img/perm_identity_white_24dp.svg"></span>
			<span class="title">Ver-notas</span>
		</a>
    </li>
	<li class="list">
		<a href="conf-encarregado.php">
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
                    
<?php require_once "navMob-encarregado.php" ?>

   <div id="imagem">
     <img src="../img/enc-escola.png">
   </div>     



<?php require_once "../footer2.php";  ?>

</body>
</html>