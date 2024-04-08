<?php 
require_once "conexao.php";

session_start();

if(isset($_POST['cadastramento'])){
    $nome = mysqli_escape_string($conexao,$_POST['txtnome']);
    $email = mysqli_escape_string($conexao,$_POST['txtemail']);
    $mun = mysqli_escape_string($conexao,$_POST['txtmun']);
    $bairro = mysqli_escape_string($conexao,$_POST['txtbairro']);
    $contato = mysqli_escape_string($conexao,$_POST['txtcont']);
    $datcad = mysqli_escape_string($conexao,$_POST['txtcad']);
    $datmod = mysqli_escape_string($conexao,$_POST['txtmod']);

    $sql = "INSERT INTO teste VALUES (default,'$nome','$email','$mun','$bairro','$contato','$datcad','$datmod')";

   mysqli_query($conexao,$sql);

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>cadastros</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css?v=1">
	<link rel="stylesheet" type="text/css" href="css/media.css?v=1">
</head>
<body>
	<div class="divsuperior">
	  <h1>Colégio Samiga</h1>
    </div>

<!--Navebar-->
<div class="navegacao">
<ul>
	<li class="list">
		<a href="home.php">
			<span class="icon"><img src="img/home_white_24dp.svg"></span>
			<span class="title">HOME</span>
		</a>
	</li>
		<li class="list active">
		<a href="professor.php">
			<span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
			<span class="title">Professores</span>
		</a>
	</li>
		<li class="list ">
		<a href="aluno.php">
			<span class="icon"><img src="img/school_white_24dp.svg"></span>
			<span class="title">Alunos</span>
		</a>
	</li>
		<li class="list ">
		<a href="Encarregados.php">
			<span class="icon"><img src="img/escalator_warning_white_24dp.svg"></span>
			<span class="title">Encarregados</span>
		</a>
	</li>
	</li>
		<li class="list">
		<a href="pauta.php">
			<span class="icon"><img src="img/format_list_numbered_white_24dp.svg"></span>
			<span class="title">Pautas</span>
		</a>
	</li>
		<li class="list">
		<a href="logoult.php">
			<span class="icon"><img src="img/logout_white_24dp.svg"></span>
			<span class="title">Sair</span>
		</a>
	</li>
</ul>	
</div>



<div class="container" id="divm">
      <form action="" method="post">
         <div class="form-group">
            <label for="textnome">Nome</label>
           <input type="text" id="textnome" class="form-control"
           name="txtnome" >
         </div>
         <div class="form-group">
            <label for="textemail">E-mail</label>
           <input type="email" id="textemail" class="form-control"
        name="txtemail" >
         </div>
         <div class="form-group">
            <label for="textmun">Município</label>
           <input type="text" id="textmun" class="form-control"
           name="txtmun" >
         </div>
         <div class="form-group">
            <label for="textbairro">Bairro</label>
           <input type="text" id="textbairro" class="form-control"
           name="txtbairro" >
         </div>
         <div class="form-group">
            <label for="textcont">Contatos</label>
           <input type="text" id="textcont" class="form-control"
           name="txtcont" placeholder="xxx-xx-xx-xx" >
         </div>
                  <div class="form-group">
            <label for="textcad">Data de cadastro</label>
           <input type="date" id="textcad" class="form-control"
           name="txtcad" >
         </div>
         <div class="form-group">
            <label for="textmod">Data de modificação</label>
           <input type="date" id="textmod" class="form-control"
           name="txtmod" >
         </div>

        <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-6" 
         name="cadastramento">Cadastrar</button>
      </form>
               <button href="professor.php" class="btn btn-outline-waming btn-block col-6" 
         name="cadastramento">Voltar</button>
</div>


<script src="bootstrap/jquery-3.6.0.min.js"></script>
<script src="bootstrap/js/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="js/mover.js?v=1">
</script>
</body>
</html>