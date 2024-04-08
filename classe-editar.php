<?php 
require_once "conexao.php";

session_start();
$id = $_POST['id_classe'];
$_SESSION['id'] = $id;

$sql = "SELECT * FROM sg_classe WHERE id_c ='$id' ";
$res = mysqli_query($conexao,$sql);
$registro = mysqli_fetch_assoc($res);

?>



<!DOCTYPE html>
<html>
<head>
  <title>Samiga</title>
  <?php require_once "head.php"; ?>
</head>
<body>
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
    </div>

   <div class="divsuperior2">
    <div class="divflex">
    <div>
     <h5>Editar dados da classe</h5>
    </div>
    <div class="d-flex">
      <h5 class="me-2">Usuário :</h5>
      <img class="me-1" src="img/person.svg" id="IMG">
      <h5 class="me-3">Administrador</h5>
    </div>
    </div>
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
    <a href="menu-Encarregados.php">
      <span class="icon"><img src="img/escalator_warning_white_24dp.svg"></span>
      <span class="title">Encarregados</span>
    </a>
  </li>
  <li class="list">
    <a href="menu-alunos.php">
      <span class="icon"><img src="img/school_white_24dp.svg"></span>
      <span class="title">Alunos</span>
    </a>
  </li>
  <li class="list">
    <a href="menu-usuarios.php">
      <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
      <span class="title">Usuarios</span>
    </a>
  </li>
  <li class="list">
    <a href="menu-disciplinas.php">
      <span class="icon"><img src="img/livro.png"></span>
      <span class="title">Disciplinas</span>
    </a>
  </li>
  <li class="list">
    <a href="menu-turmas.php">
      <span class="icon"><img src="img/edit.png"></span>
      <span class="title">Turmas</span>
    </a>
  </li>
  <li class="list active">
    <a href="menu-classes.php">
      <span class="icon"><img src="img/edit.png"></span>
      <span class="title">Classes</span>
    </a>
  </li>
  <li class="list">
     <a href="menu-gerenciar.php">
      <span class="icon"><img src="img/gerenciar.png"></span>
      <span class="title">Gerenciamento</span>
    </a>
  </li>
  <li class="list">
     <a href="menu-configurar.php">
      <span class="icon"><img src="img/settings.png"></span>
      <span class="title">Alterar-senha</span>
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

<div class="fontes rounded-3" id="divm">

  <div class="divsuperior3">
    <h5>Editar dados da classe</h5>
  </div>
   
      <form action="classe-editar-processar.php" method="post">

        <div class="row margB">
         <div class="form-group col-md-4" id="margemB">
            <label for="textnome">Nome</label>
           <input type="text" id="textnome" class="form-control"
           name="txtnome" maxlength="30" value="<?php echo $registro['nome_c']; ?>" placeholder="Nome da disciplina" required>
         </div>
        </div>

        <div class="row marg">
          <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" 
           name="btn-cadastrar" id="margemBotao">Gravar</button>

           <div class="col-md-8"  id="margemBotao"></div>

          <a href="menu-classes.php" class="btn btn-outline-secondary btn-block col-md-2" 
           name="btn-voltar">Voltar</a>

        </div>

       </form>
</div>


<?php require_once "footer.php";  ?>
</body>
</html>