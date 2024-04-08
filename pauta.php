<?php 
require_once "conexao.php";
?>


<!DOCTYPE html>
<html>
<head>
	<title>Pauta</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="bootstrap5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
<link rel="stylesheet" type="text/css" href="css/media.css">
</head>
<body>
	<div class="divsuperior">
	  <h1>Colégio Samiga</h1>
    </div>


<!--Navebar-->
<div class="navegacao">
<ul>
	<li class="list ">
		<a href="home.php">
			<span class="icon"><img src="img/home_white_24dp.svg"></span>
			<span class="title">HOME</span>
		</a>
	</li>
		<li class="list">
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
		<li class="list">
		<a href="encarregados.php">
			<span class="icon"><img src="img/escalator_warning_white_24dp.svg"></span>
			<span class="title">Encarregados</span>
		</a>
	</li>
	</li>
		<li class="list active">
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
	



<div class="container">
<form method="post">
	
	<table class="table table-hover table-bordered">
	
  <thead class="table-secondary">
    <tr>
      <th scope="col">codigo</th>
      <th scope="col">Nome</th>
      <th scope="col">E-mail</th>
      <th scope="col">Bairro</th>
      <th scope="col">Municipio</th>
      <th scope="col">Idade</th>
      <th scope="col">Contato</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark zukerberg</td>
      <td>mark@gmail.com</td>
      <td>scongolense</td>
      <td>Luanda</td>
      <td>95</td>
      <td>900224411</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Hamara Itachi Shio</td>
      <td>shio@gmail.com</td>
      <td>china</td>
      <td>Viana</td>
      <td>25</td>
      <td>900007771</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Oliveira Panio</td>
      <td></td>
      <td></td>
      <td>Luanda</td>
      <td>86</td>
      <td>907663411</td>
     <tr>

  </tbody>
</table>

</form>	

</div>


<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="mover.js">
</script>
</body>
</html>