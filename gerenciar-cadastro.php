<?php 
require_once "conexao.php";

session_start();

if(isset($_POST['btn-salvar'])){
    $disciplina = mysqli_escape_string($conexao,$_POST['txtdisciplina']);
    $professor = mysqli_escape_string($conexao,$_POST['txtprofessor']);
    $turma = mysqli_escape_string($conexao,$_POST['txtturma']);
    $data = Date('Y');


       $disc = mysqli_query($conexao,"SELECT * FROM sg_gerenciar WHERE idDisciplina = '$disciplina' AND idProfessor = '$professor' AND idTurma = '$turma' AND ano = '$data'");
         

      if(!mysqli_num_rows($disc) > 0){
         $r_gerenciar = mysqli_query($conexao,"INSERT INTO sg_gerenciar(id_g,idDisciplina,idProfessor,idTurma,ano) VALUES (default,'$disciplina','$professor','$turma','$data')");

          $_SESSION['Gerenciar-cadastrado'] = "
          <div id='alerta-confirmar'>
      <div class='alerta-confirmar'>
      <div class='alert alert-success alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
         Actualizado com sucesso!
      </div>
      </div>
    </div>";
      }else{

     $_SESSION['Gerenciar-cadastrado'] = "
          <div id='alerta-confirmar'>
      <div class='alerta-confirmar'>
      <div class='alert alert-danger alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
          Actualização já feita!
      </div>
   </div>
   </div>";
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
     <h5>Gerenciar</h5>
    </div>
    <div class="d-flex">
      <h5 class="me-2">Usuário :</h5>
      <img class="me-1" src="img/person.svg" id="IMG">
      <h5 class="me-3">Administrador</h5>
    </div>
    </div>
  </div>

  <?php
  if(isset($_SESSION['Gerenciar-cadastrado'])){
      echo $_SESSION['Gerenciar-cadastrado'];
      unset($_SESSION['Gerenciar-cadastrado']);
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
  <li class="list">
    <a href="menu-classes.php">
      <span class="icon"><img src="img/edit.png"></span>
      <span class="title">Classes</span>
    </a>
  </li>
  <li class="list active">
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
    <h5>Gerenciar</h5>
  </div>
      <form action="gerenciar-cadastro.php" method="post">

        <div class="row margB">
         <div class="form-group col-md-4" id="margemB">
            <label for="textdisciplina">Disciplinas</label>
           <select id="textdisciplina" class="input form-control"
           name="txtdisciplina"  required>
              <option value="">Selecione aqui</option>

          <?php $query = mysqli_query($conexao,"SELECT id_d,nome_d FROM sg_disciplina ORDER BY nome_d"); 

          while ($registro = mysqli_fetch_array($query)) {
              echo"<option value = '".$registro['id_d']."'>".$registro['nome_d']."</option>";
          }
               
          ?>    
           </select>
         </div>
          <div class="form-group col-md-4" id="margemB">
            <label for="textprofessor">Professores</label>
           <select id="textprofessor" class="input form-control"
           name="txtprofessor" required>
              <option value="">Selecione aqui</option>
              
          <?php $query = mysqli_query($conexao,"SELECT id_p,nome_p FROM sg_professor ORDER BY nome_p"); 

          while ($registro = mysqli_fetch_assoc($query)) {
              echo"<option value = '".$registro['id_p']."'>".$registro['nome_p']."</option>";
          }

          ?>    

           </select>
         </div>
          <div class="form-group col-md-4" id="margemB">
          <label for="textturma">Turmas</label>
           <select id="textturma" class="input form-control"
           name="txtturma" required>
              <option value="">Selecione aqui</option>
              
          <?php $query = mysqli_query($conexao,"SELECT id_t,nome_t FROM sg_turma ORDER BY nome_t"); 

          while ($registro = mysqli_fetch_assoc($query)) {
              echo"<option value = '".$registro['id_t']."'>".$registro['nome_t']."</option>";
          }

          ?>    

           </select>
         </div>
       </div>
        

        <div class="row marg">
          <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" 
           name="btn-salvar" id="margemBotao">Salvar</button>

           <div class="col-md-8"  id="margemBotao"></div>

          <a href="menu-gerenciar.php" class="btn btn-outline-secondary btn-block col-md-2" 
           name="btn-voltar" id="margemBotao">Voltar</a>

        </div>

       </form>
</div>

<?php require_once "footer.php";  ?>
</body>
</html>