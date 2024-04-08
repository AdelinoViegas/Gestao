<?php 
require_once "conexao.php";

session_start();
$id = $_GET['id'];
$_SESSION['id'] = $id;

$sql = "SELECT * FROM teste WHERE id ='$id' ";
$res = mysqli_query($conexao,$sql);
$registro = mysqli_fetch_assoc($res);

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
    <h5>editar dados do professor</h5>
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
    <li class="list ">
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

<?php require_once "navbarMobile.php" ?>

<div class="container fontes" id="divm">
      <form action="" method="post">

        <div class="row margB">
         <div class="form-group col-md-6">
            <label for="textnome">Nome</label>
           <input type="text" id="textnome" class="form-control"
           name="txtnome" value="<?php echo $registro['nome']; ?>">
         </div>
         <div class="form-group col-md-6">
            <label for="textemail">E-mail</label>
           <input type="email" id="textemail" class="form-control"
        name="txtemail" value="<?php echo $registro['email']; ?>">
         </div>
       </div>
        
        <div class="row margB"> 
         <div class="form-group col-md-4">
            <label for="textmun">Município</label>
           <input type="text" id="textmun" class="form-control"
           name="txtmun" value="<?php echo $registro['municipio']; ?>">
         </div>
         <div class="form-group col-md-4">
            <label for="textbairro">Bairro</label>
           <input type="text" id="textbairro" class="form-control"
           name="txtbairro" value="<?php echo $registro['bairro']; ?>">
         </div>
         <div class="form-group col-md-4">
            <label for="textsexo">sexo</label>
           <select type="text" id="textsexo" class="input md form-control"
           name="txtsexo" value="<?php echo $registro['sexo']; ?>" required>
             <option>Masculino</option>
             <option>Femenino</option>
           </select>
         </div>
       </div>

       <div class="row margB">
         <div class="form-group col-md-4">
            <label for="textcont">Contato</label>
           <input type="text" id="textcont" class="form-control"
           name="txtcont" value="<?php echo $registro['contato']; ?>" >
         </div>
          <div class="form-group col-md-4">
            <label for="textnasc">Data de Nascimento</label>
           <input type="date" id="textnasc" class="form-control"
           name="txtnasc" value="<?php echo $registro['dataNascimento']; ?>">
         </div>
         <div class="form-group col-md-4">
            <label for="textbi">Número do BI</label>
           <input type="text" id="textbi" class="form-control"
           name="txtbi" value="<?php echo $registro['numeroBI']; ?>">
         </div>
       </div>

        <div class="row marg">
          <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" 
           name="cadastramento">Cadastrar</button>

           <div class="col-md-8"></div>

          <a href="professor.php" class="btn btn-outline-secondary btn-block col-md-2" 
           name="cadastramento">Voltar</a>

        </div>

       </form>
</div>


<?php require_once "footer.php";  ?>
</body>
</html>

