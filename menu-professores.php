<?php 
require_once "conection.php";
require_once "features/getData.php";
session_start();

//verficar se está logado
if(!isset($_SESSION['logado']))
  header("Location: index.php");

$data = getData($conection, "SELECT * FROM sg_professor WHERE view = '1' ORDER BY nome_p");

/* codido que faz a pesquisa do nome do professor */
if (isset($_POST['btn-pesquisa'])) {
    $pesquisar = $_POST['search'];
    $data = getData($conection, "SELECT * FROM sg_professor WHERE nome_p LIKE '$pesquisar%' AND view = '1'");              
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
      <h5>Professores cadastrados</h5>
    </div>
    <div class="d-flex">
      <h5 class="me-2">Usuário :</h5>
      <img class="me-1" src="img/person.svg" id="IMG">
      <h5 class="me-3">Administrador</h5>
    </div>
    </div>
  </div>
  <?php

  if(isset($_SESSION['Professor-actualizado'])){
      echo $_SESSION['Professor-actualizado'];
      unset($_SESSION['Professor-actualizado']);
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
  <li class="list active">
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
  <li class="list">
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

<?php require_once "navbarMobile.php"; ?>

<div class="rounded-3" id="divm">
  <div class="divsuperior3">
    <h5>Professores cadastrados</h5>
  </div>


<div id="divflex">
    <a href="professor-cadastro.php" type="button" id="adicionar" class="btn btn-secondary">Adicionar</a>

<form action="" method="post">
  <div id="btn-pesquisar">
    <input 
      type="text" 
      class="form-control me-2" 
      name="search" 
      placeholder="Pesquisa por nome"
    >

    <button 
      id="btn-p" 
      type="submit" 
      class="btn btn-success" 
      name="btn-pesquisa"
    >
      Pesquisar
    </button>
  </div>
</form> 

</div>

<div class="table-responsive" id="tabdados">

<table class="table table-hover table-bordered" id="table">

  <thead class="table-secondary" id="theader">
    <tr>
      <th scope="col">Ações</th>
      <th scope="col">Nome</th>
      <th scope="col">E-mail</th>
      <th scope="col">Município</th>
      <th scope="col">Bairro</th>
      <th scope="col">Sexo</th>
      <th scope="col">Contato</th>
    </tr>
  </thead>
  <tbody>
      <?php 

       if(count($data) > 0){

      foreach($data as $data_professor) { 

        ?>
     <tr id="tr">
      <td id="editar">
         <form action="professor-editar.php" method="post">
          <input id="editar1" type="hidden" class="btn btn-warning" value="<?= $data_professor['id_p']; ?>" name="id_professor">
          <button id="editar1" type="submit" class="btn btn-warning">Editar</button>
        </form>

          <button id="editar2" type="button" 
          data-bs-target="#apagar<?= $data_professor['id_p']; ?>" 
          data-bs-toggle="modal" class="btn btn-danger">Apagar</button>
     
     <!--Modal-->
<div class="modal fade" id="apagar<?= $data_professor['id_p']; ?>">
  <div class="modal-dialog">
  <div class="modal-content">
     <!--Cabeçalho-->
    <div class="modal-header">
        <h4 class="modal-title custom_align text-dark" 
        id="Heading">Eliminar Registro</h4>

        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
    </div> 
   
   <!--Corpo do modal-->
    <div class="modal-body">
        <div class="alert alert-danger">
          Deseja excluir
           <strong><?= $data_professor['nome_p'];  ?></strong> ?
         </div>
    </div>
    
    <!--Rodapé-->
    <div class="modal-footer">
        <form action="professor-apagar.php" method="post">
            <input type="hidden" 
            name="id_professor" value="<?= $data_professor['id_p']; ?>">
            <button type="submit" class="btn btn-success" 
            data-bs-dismiss="modal">Sim</button>
        </form>

        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
    </div>
  </div>  
 </div>
</div>
      </td>   
      <td><?= $data_professor['nome_p']; ?></td>
      <td><?= $data_professor['email_p']; ?></td>
      <td><?= $data_professor['municipio_p']; ?></td>
      <td><?= $data_professor['bairro_p']; ?></td>
      <td><?= $data_professor['sexo_p']; ?></td>
      <td><?= $data_professor['contato_p']; ?></td>
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

 <!--Modal-->
<div class="modal fade" id="apagar">
  <div class="modal-dialog">
  <div class="modal-content">

    <div class="modal-header">
      <h4 class="modal-title custom_align" id="Heading">Eliminar dados</h4>
      <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
    </div> 

    <div class="modal-body">
    <!--<input type="hidden" name="idUsuario" class="form-control" id="idUsuario">-->
      <div class="alert alert-danger">Deseja apagar?</div>
    </div>

    <div class="modal-footer">
      <form action="" method="post">
         <input type="hidden" name="valor" value="confirmado">
          <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Sim</button>
      </form>
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
    </div>

  </div>  
 </div>
</div>

<?php require_once "footer.php";  ?>
</body>
</html>