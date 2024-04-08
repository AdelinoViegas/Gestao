<?php 
require_once "conexao.php";

session_start();

//verficar se está logado
if(!isset($_SESSION['logado'])){
  header("Location: index.php");
}

$sql = "SELECT * FROM teste";
$result = mysqli_query($conexao,$sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Grade</title>
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
    <a href="menu-home.php">
      <span class="icon"><img src="img/home_white_24dp.svg"></span>
      <span class="title">HOME</span>
    </a>
  </li>
    <li class="list">
    <a href="menu-professores.php">
      <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
      <span class="title">Professores</span>
    </a>
  </li>
    <li class="list">
    <a href="menu-alunos.php">
      <span class="icon"><img src="img/school_white_24dp.svg"></span>
      <span class="title">Alunos</span>
    </a>
  </li>
    <li class="list ">
    <a href="menu-Encarregados.php">
      <span class="icon"><img src="img/escalator_warning_white_24dp.svg"></span>
      <span class="title">Encarregados</span>
    </a>
  </li>
  <li class="list ">
    <a href="menu-usuarios.php">
      <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
      <span class="title">Usuarios</span>
    </a>
    <li class="list ">
    <a href="menu-disciplinas.php">
      <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
      <span class="title">Disciplinas</span>
    </a>
    <li class="list ">
    <a href="menu-turmas.php">
      <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
      <span class="title">Turmas</span>
    </a>
    <li class="list ">
    <a href="menu-classes.php">
      <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
      <span class="title">Classes</span>
    </a>
    <li class="list active">
     <a href="menu-grades.php">
      <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
      <span class="title">Grades</span>
    </a>
    </li>
    <li class="list">
    <a href="menu-pautas.php">
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
  <div class="divsuperior3">
    <h5>Cadastros de alunos</h5>
  </div>


<div id="divflex">
    <a href="cadastro-aluno.php" type="button" id="adicionar" class="btn btn-secondary">Adicionar</a>

  <div id="btn-pesquisar">
    <label>Pesquisar</label><input type="text" name="txtpesquisar">
  </div>  
</div>

<div class="table-responsive" id="tabdados">

<table class="table table-hover table-bordered" id="table">

  <thead class="table-secondary">
    <tr>
      <th scope="col">Ações</th>
      <th scope="col">Nome</th>
      <th scope="col">E-mail</th>
      <th scope="col">Município</th>
      <th scope="col">Bairro</th>
      <th scope="col">Sexo</th>
      <th scope="col">Contato</th>
      <th scope="col">Nascimento</th>
      <th scope="col">Número-BI</th>
    </tr>
  </thead>
  <tbody>
      <?php while($lista = mysqli_fetch_assoc($result)) { ?>
     <tr id="tr">
      <td>
        <a href="editar.php?id=<?php echo $lista['id']; ?>">
          <button id="editar" type="button" class="btn btn-info text-white">Editar</button>
        </a>
      </td>   
      <td><?php echo $lista['nome']; ?></td>
      <td><?php echo $lista['email']; ?></td>
      <td><?php echo $lista['municipio']; ?></td>
      <td><?php echo $lista['bairro']; ?></td>
      <td><?php echo $lista['sexo']; ?></td>
      <td><?php echo $lista['contato']; ?></td>
      <td><?php echo $lista['dataNascimento']; ?></td>
      <td><?php echo $lista['numeroBI']; ?></td>
    </tr>

  <?php } ?>
  </tbody>
</table>



</div>
</div>

<?php require_once "footer.php";  ?>
</body>
</html>