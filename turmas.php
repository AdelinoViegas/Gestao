<?php 
require_once "conexao.php";

session_start();

$sql = "SELECT * FROM teste";
$result = mysqli_query($conexao,$sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Turma</title>
<?php require_once "head.php";  ?>
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
    <li class="list ">
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
  <li class="list ">
    <a href="usuarios.php">
      <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
      <span class="title">Usuarios</span>
    </a>
    <li class="list ">
    <a href="disciplinas.php">
      <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
      <span class="title">Disciplinas</span>
    </a>
    <li class="list active">
    <a href="turmas.php">
      <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
      <span class="title">Turmas</span>
    </a>
    <li class="list ">
    <a href="classes.php">
      <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
      <span class="title">Classes</span>
    </a>
    <li class="list ">
     <a href="grades.php">
      <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
      <span class="title">Grades</span>
    </a>
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


<!--Menu mobile-->    
<nav class="navbar navbar-dark" id="navMenu">
    <div class="container-fluid">

    <button class="navbar-toggler" type="button"  data-bs-toggle="collapse" data-bs-target="#menu-mobile" aria-expanded="true" id="menuMobile">
        <span class="navbar-toggler-icon" ></span>
    </button>

    <div class="navbar-collapse collapse" id="menu-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" id="opcMobile" href="home.php">
                 <span class="icon"><img src="img/home_white_24dp.svg"></span>
           <span class="title">HOME</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="opcMobile" href="professor.php">
      <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
      <span class="title">Professores</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="opcMobile" href="aluno.php">
               <span class="icon"><img src="img/school_white_24dp.svg"></span>
           <span class="title">Alunos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="opcMobile" href="encarregados.php">
            <span class="icon"><img src="img/escalator_warning_white_24dp.svg"></span>
            <span class="title">Encarregados</span>
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link" id="opcMobile" href="usuarios.php">
                  <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
                  <span class="title">Usuarios</span>
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link" id="opcMobile" href="disciplinas.php">
                 <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
                 <span class="title">Disciplinas</span>
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link" id="opcMobile" href="turmas.php">
             <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
                 <span class="title">Turmas</span>
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link" id="opcMobile" href="classes.php">
                  <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
                  <span class="title">Classes</span>
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link" id="opcMobile" href="grades.php">
                 <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
                 <span class="title">Grades</span>
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link" id="opcMobile" href="pautas.php">
               <span class="icon"><img src="img/format_list_numbered_white_24dp.svg"></span>
            <span class="title">Pautas</span>
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link" id="opcMobile" href="logoult.php">
            <span class="icon"><img src="img/logout_white_24dp.svg"></span>
            <span class="title">Sair</span>
                </a>
            </li>


        </ul>
    </div>

    </div>
 </nav>


<div id="divm">

<div id="divflex">
    <a href="professor-cadastro.php" type="button" id="adicionar" class="btn btn-primary">Adicionar</a>

  <div id="btn-pesquisar">
    <label>Pesquisar</label><input type="text" name="txtpesquisar">
  </div>  
</div>

<div class="table-responsive " >

<table class="table table-hover table-bordered" id="tabdados">

  <thead class="table-secondary">
    <tr>
      <th scope="col">Ações</th>
      <th scope="col">codigo</th>
      <th scope="col">Nome</th>
      <th scope="col">E-mail</th>
      <th scope="col">Município</th>
      <th scope="col">Bairro</th>
      <th scope="col">Contato</th>
      <th scope="col">Cadastro</th>
      <th scope="col">Modificação</th>
    </tr>
  </thead>
  <tbody>
      <?php while($lista = mysqli_fetch_assoc($result)){?>
     <tr>
      <td>vazio</td>   
      <th scope="row"><?php echo $lista['id']; ?></th>
      <td><?php echo $lista['nome']; ?></td>
      <td><?php echo $lista['email']; ?></td>
      <td><?php echo $lista['municipio']; ?></td>
      <td><?php echo $lista['bairro']; ?></td>
      <td><?php echo $lista['contato']; ?></td>
      <td><?php echo $lista['dataCadastro']; ?></td>
      <td><?php echo $lista['dataModificacao']; ?></td>
    </tr>
  <?php }?>
  </tbody>
</table>

</div>
</div>


<?php require_once "footer.php";  ?>
</body>
</html>