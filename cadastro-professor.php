<?php 
require_once "conexao.php";

session_start();

if(isset($_POST['cadastramento'])){
    $nome = mysqli_escape_string($conexao,$_POST['txtnome']);
    $email = mysqli_escape_string($conexao,$_POST['txtemail']);
    $mun = mysqli_escape_string($conexao,$_POST['txtmun']);
    $bairro = mysqli_escape_string($conexao,$_POST['txtbairro']);
    $sexo = mysqli_escape_string($conexao,$_POST['txtsexo']);
    $contato = mysqli_escape_string($conexao,$_POST['txtcont']);
    $datNasc = mysqli_escape_string($conexao,$_POST['txtnasc']);
    $numeroBI = mysqli_escape_string($conexao,$_POST['txtbi']);

    $sql = "INSERT INTO teste(id,nome,email,sexo,dataNascimento,municipio,bairro,contato,numeroBI) VALUES (default,'$nome','$email','$sexo','$datNasc','$mun','$bairro','$contato','$numeroBI')";

   mysqli_query($conexao,$sql);

}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Professor</title>
  <?php require_once "head.php"; ?>
</head>
<body>
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
    </div>

  <div class="divsuperior2">
    <h5>Formulário de cadastramento de professores</h5>
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
    <li class="list active">
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
    <li class="list ">
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



<div class="container fontes" id="divm">
      <form action="professor-cadastro.php" method="post">

        <div class="row margB">
         <div class="form-group col-md-6">
            <label for="textnome">Nome</label>
           <input type="text" id="textnome" class="form-control"
           name="txtnome" placeholder="Nome do professor">
         </div>
         <div class="form-group col-md-6">
            <label for="textemail">E-mail</label>
           <input type="email" id="textemail" class="form-control"
        name="txtemail" placeholder="E-mail do professor">
         </div>
       </div>
        
        <div class="row margB"> 
         <div class="form-group col-md-4">
            <label for="textmun">Município</label>
           <input type="text" id="textmun" class="form-control"
           name="txtmun" placeholder="Seu município">
         </div>
         <div class="form-group col-md-4">
            <label for="textbairro">Bairro</label>
           <input type="text" id="textbairro" class="form-control"
           name="txtbairro" placeholder="Seu bairro">
         </div>
         <div class="form-group col-md-4">
            <label for="textsexo">sexo</label>
           <select type="text" id="textsexo" class="input md form-control"
           name="txtsexo">
             <option>Masculino</option>
             <option>Femenino</option>
           </select>
         </div>
       </div>

       <div class="row margB">
         <div class="form-group col-md-4">
            <label for="textcont">Contato</label>
           <input type="text" id="textcont" class="form-control"
           name="txtcont" placeholder="xxx-xx-xx-xx" >
         </div>
          <div class="form-group col-md-4">
            <label for="textnasc">Data de Nascimento</label>
           <input type="date" id="textnasc" class="form-control"
           name="txtnasc" >
         </div>
         <div class="form-group col-md-4">
            <label for="textbi">Número do BI</label>
           <input type="text" id="textbi" class="form-control"
           name="txtbi" >
         </div>
       </div>

        <div class="row marg">
          <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" 
           name="cadastramento">Cadastrar</button>

           <div class="col-md-8"></div>

          <a href="menu-professores.php" class="btn btn-outline-secondary btn-block col-md-2" 
           name="cadastramento">Voltar</a>

        </div>

       </form>
</div>

<?php require_once "footer.php";  ?>
</body>
</html>