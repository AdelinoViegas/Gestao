<?php 
require_once "connection.php";
require_once "features/getData.php";
session_start();

if(!isset($_SESSION['logged'])){
  header("Location: index.php");
}

$res_classe = getData($connection,"SELECT * FROM sg_classe order by nome_c");

  if (isset($_POST['btn-search'])) {
      $pesquisar = $_POST['search'];
      $res_classe = mysqli_query($connection,"SELECT * FROM sg_classe WHERE nome_c LIKE '$pesquisar%' ");                    
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Samiga</title>
<?php require_once "head.php";  ?>
</head>
<body>
  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
    </div>
  <div class="divsuperior2">
    <div class="divflex">
    <div>
      <h5>Classes cadastradas</h5>
    </div>
    <div class="d-flex">
      <h5 class="me-2">Usuário :</h5>
      <img class="me-1" src="img/person.svg" id="IMG">
      <h5 class="me-3">Administrador</h5>
    </div>
    </div>
  </div>

  <?php
  if(isset($_SESSION['Classe-actualizado'])){
      echo $_SESSION['Classe-actualizado'];
      unset($_SESSION['Classe-actualizado']);
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


<div class="rounded-3" id="divm">
  <div class="divsuperior3">
    <h5>Classes cadastradas</h5>
  </div>


<div id="divflex">
    <a href="classe-cadastro.php" type="button" id="adicionar" class="btn btn-secondary">Adicionar</a>

<form action="" method="post">
  <div id="btn-pesquisar">
    <input type="text" class="form-control me-2" name="txtpesquisar" placeholder="Pesquisa por nome"><button id="btn-p" type="submit" class="btn btn-success" name="btn-pesquisa">Pesquisar</button>
  </div>
</form> 

</div>

<div class="table-responsive" id="tabdados">

<table class="table table-hover table-bordered" id="table">

  <thead class="table-secondary" id="theader">
    <tr>
      <th scope="col">Ações</th>
      <th scope="col">Nome</th>
    </tr>
  </thead>
  <tbody>
      <?php 
         if(mysqli_num_rows($res_classe) > 0){

           while($l_classe = mysqli_fetch_assoc($res_classe)) { ?>
     <tr id="tr">
      <td id="editar">
        <form action="classe-editar.php" method="post">
          <input id="editar1" type="hidden" class="btn btn-warning" value="<?php echo $l_classe['id_c']; ?>" name="id_classe">
          <button id="editar1" type="submit" class="btn btn-warning">Editar</button>
        </form>
      </td>     
      <td class="w-50"><?php echo $l_classe['nome_c']; ?></td>
    </tr>

  <?php } ?>

  </tbody>
</table>

<?php

 }else{

 ?> 
   </tbody>
</table> 
  <tfooter class='text text-center'>    
      <h5>Nenhum dado encontrado</h5>
   </tfooter>
<?php   
 }
?>



</div>
</div>

<?php require_once "footer.php";  ?>
</body>
</html>