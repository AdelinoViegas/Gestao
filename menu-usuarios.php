<?php 
require_once "conexao.php";

session_start();

//verficar se está logado
if(!isset($_SESSION['logado'])){
  header("Location: index.php");
}

/* codido que faz a pesquiasa */
            $sql_usuario = "SELECT * FROM sg_usuarios WHERE view = '1' ORDER BY nome_u";
            $res_usuario = mysqli_query($conexao,$sql_usuario);
            $num = mysqli_num_rows($res_usuario);

        if (isset($_POST['btn-pesquisa'])) {
            $pesquisar = $_POST['txtpesquisar'];
            $res_usuario = mysqli_query($conexao,"SELECT * FROM sg_usuarios WHERE nome_u LIKE '$pesquisar%' AND view = '1' ");               
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
    
  </div>
    <div class="divsuperior2">
    <div class="divflex">
    <div>
      <h5>Usuários cadastrados</h5>
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
  <li class="list active">
    <a href="menu-usuarios.php">
      <span class="icon"><img src="img/perm_identity_white_24dp.svg"></span>
      <span class="title">Usuarios</span>
    </a>
    <li class="list">
    <a href="menu-disciplinas.php">
      <span class="icon"><img src="img/livro.png"></span>
      <span class="title">Disciplinas</span>
    </a>
    <li class="list">
    <a href="menu-turmas.php">
      <span class="icon"><img src="img/edit.png"></span>
      <span class="title">Turmas</span>
    </a>
    <li class="list">
    <a href="menu-classes.php">
      <span class="icon"><img src="img/edit.png"></span>
      <span class="title">Classes</span>
    </a>
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
    <h5>Usuários cadastrados</h5>
  </div>


<div id="divflex">
    <h5 id="adicionar">Nª de Usuários : <span id='num'><?php echo $num; ?></span></h5>

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
      <th scope="col">Estado</th>
      <th scope="col">Nome</th>
      <th scope="col">Painel</th>
    </tr>
  </thead>
  <tbody>
      <?php

      if(mysqli_num_rows($res_usuario) > 0){

      while($l_usuario = mysqli_fetch_assoc($res_usuario)) { 

        ?>
     <tr>
      <td id="estado">   
        <?php

           if($l_usuario['estado_u'] === 'activo'){
         ?>
          <form action="usuario-mudar.php"  method="post">
          <input type="hidden" name="estadoU" value="<?php echo $l_usuario['estado_u']; ?>" >
          <input type="hidden" name="idUsuario" value="<?php echo $l_usuario['id_u']; ?>" >
          <input type="hidden" name="chamada1" value="1">
          <button id="btn2"  type="submit" class="btn btn-md btn-success"> <?php echo $l_usuario['estado_u']; ?></button>
        </form>
        <?php }else{
         ?>
        <form action="usuario-mudar.php"  method="post">
          <input type="hidden" name="estadoU" value="<?php echo $l_usuario['estado_u']; ?>" >
          <input type="hidden" name="idUsuario" value="<?php echo $l_usuario['id_u']; ?>">
          <input type="hidden" name="chamada1" value="1">
          <button id="btn2"  type="submit" class="btn btn-md btn-danger"> <?php echo $l_usuario['estado_u']; ?></button>
        </form>        
       <?php } ?>
      </td>
      <td id="nome"><?php echo $l_usuario['nome_u']; ?></td>
      <td id="painel"><?php echo $l_usuario['painel_u']; ?></td>
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