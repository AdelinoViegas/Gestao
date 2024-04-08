<?php 
require_once "conexao.php";

session_start();

$id = $_POST['id_gerenciar'];
$_SESSION['id_gerenciar'] = $id;

$sql_gerenciar = "SELECT * FROM sg_gerenciar AS g JOIN sg_disciplina AS d ON g.idDisciplina = d.id_d JOIN sg_professor AS p ON g.idProfessor = p.id_p JOIN sg_turma AS t ON g.idTurma = t.id_t WHERE id_g = '$id' ";
$res_gerenciar = mysqli_query($conexao,$sql_gerenciar);
$registro = mysqli_fetch_assoc($res_gerenciar);

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
      <form action="gerenciar-editar-processar.php" method="post">

        <div class="row margB">
         
         <div class="form-group col-md-4" id="margemB">
            <label for="textdisciplina">Disciplinas</label>  
           <select id="textdisciplina" class="input form-control"
           name="txtdisciplina"  required> 
          <option value="<?php echo $registro['id_d']; ?>"><?php echo $registro['nome_d']; ?></option>
          <?php   
             $d = mysqli_query($conexao,"SELECT id_d,nome_d FROM sg_disciplina ORDER BY nome_d");
          while ($disciplina = mysqli_fetch_array($d)) {
              echo"<option value = '".$disciplina['id_d']."'>".$disciplina['nome_d']."</option>";
          }
               
          ?>    
           </select>
         </div>

          <div class="form-group col-md-4" id="margemB">
            <label for="textprofessor">Professores</label>
            <select id="textprofessor" class="input form-control"
           name="txtprofessor" required>
          <option value="<?php echo $registro['id_p'] ?>"><?php echo $registro['nome_p']; ?></option>
              
          <?php $p = mysqli_query($conexao,"SELECT id_p,nome_p FROM sg_professor ORDER BY nome_p"); 

          while ($professor = mysqli_fetch_assoc($p)) {
              echo"<option value = '".$professor['id_p']."'>".$professor['nome_p']."</option>";
          }

          ?>    

           </select>
         </div>

          <div class="form-group col-md-4" id="margemB">
          <label for="textturma">Turmas</label>
          <select id="textturma" class="input form-control"
           name="txtturma" required> 
          <option value="<?php echo $registro['id_t'] ?>"><?php echo $registro['nome_t']; ?></option>

          <?php
            $t = mysqli_query($conexao,"SELECT id_t,nome_t FROM sg_turma ORDER BY nome_t");
            while ($turma = mysqli_fetch_assoc($t)) {
              echo"<option value = '".$turma['id_t']."'>".$turma['nome_t']."</option>";

          }

          ?>    
           </select>
         </div>

       </div>
        

        <div class="row marg">
          <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" 
           name="btn-cadastrar" id="margemBotao">Salvar</button>

           <div class="col-md-8"  id="margemBotao"></div>

          <a href="menu-gerenciar.php" class="btn btn-outline-secondary btn-block col-md-2" 
           name="btn-voltar" id="margemBotao">Voltar</a>

        </div>

       </form>
</div>

<?php require_once "footer.php";  ?>
</body>
</html>