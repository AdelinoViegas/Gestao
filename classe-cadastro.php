<?php 
require_once "conexao.php";

session_start();

if(isset($_POST['btn-cadastrar'])){
    $nome = mysqli_escape_string($conexao,$_POST['txtnome']);
    $verificar_nome = mysqli_query($conexao,"SELECT * FROM sg_classe WHERE nome_c ='$nome'");
  

  if(mysqli_num_rows($verificar_nome) > 0){
     $_SESSION['Classe-cadastrado'] = "
      <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-danger alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
          A classe já foi cadastrada!
      </div>
   </div>
   </div>";

}else{ 

  $sql_classe = "INSERT INTO sg_classe VALUES (default,'$nome')";

  $r_classe = mysqli_query($conexao,$sql_classe);

   if($r_classe == true){

   $_SESSION['Classe-cadastrado'] = "
                 <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-success alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
         Classe cadastrado com sucesso!
      </div>
   </div>
   </div>";


}else{

     $_SESSION['Classe-cadastrado'] = "
                 <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-danger alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
          Erro ao cadastrar!
      </div>
   </div>
   </div>";
}

}

}
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
      <h5>Formulário de cadastramento de classes</h5>
    </div>
    <div class="d-flex">
      <h5 class="me-2">Usuário :</h5>
      <img class="me-1" src="img/person.svg" id="IMG">
      <h5 class="me-3">Administrador</h5>
    </div>
    </div>
  </div>

  <?php
  if(isset($_SESSION['Classe-cadastrado'])){
      echo $_SESSION['Classe-cadastrado'];
      unset($_SESSION['Classe-cadastrado']);
    }  

   ?> 

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
    <h5>Formulário de cadastramento de classes</h5>
  </div>
      <form action="classe-cadastro.php" method="post">

        <div class="row margB">
         <div class="form-group col-md-4" id="margemB">
            <label for="textnome">Nome</label>
           <input type="text" id="textnome" class="form-control"
           name="txtnome" maxlength="30" placeholder="Nome da classe" required>
         </div>
        </div>

        <div class="row marg">
          <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" 
           name="btn-cadastrar" id="margemBotao">Cadastrar</button>

           <div class="col-md-8"  id="margemBotao"></div>

          <a href="menu-classes.php" class="btn btn-outline-secondary btn-block col-md-2" 
           name="btn-voltar">Voltar</a>

        </div>

       </form>
</div>

<?php require_once "footer.php";  ?>
</body>
</html>