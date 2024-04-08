<?php 
require_once "../conexao.php";

session_start();

$id_e = $_SESSION['ide'];
$nome = $_SESSION['nome_encarregado'];

/*if(isset($_POST['ok'])){
  
 $_SESSION['periodo'] = $_POST['trimestre'];
 $_SESSION['gerir'] = $_POST['gerenciamento'];
  header('Location: notasAlunos.php');
}*/


?>

<!DOCTYPE html>
<html>
<head>
  <title>Samiga</title>
    <?php require_once "../head2.php"; ?>
</head>
<body>

  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>

  <div class="divsuperior2">
    <div class="divflex">
    <div>
      <h5>Ver-notas</h5>
    </div>
    <div class="d-flex">
      <h5 class="me-2">Usuário :</h5>
      <img class="me-1" src="../img/person.svg" id="IMG">
      <h5 class="me-3">Encarregado</h5>
    </div>
    </div>
  </div>

<!--Navebar-->
<div class="navegacao">
<ul>
  <li class="list">
    <a href="homepais.php">
      <span class="icon"><img src="../img/home_white_24dp.svg"></span>
      <span class="title">HOME</span>
    </a>
  </li>
  <li class="list active">
    <a href="ver-notas.php">
      <span class="icon"><img src="../img/perm_identity_white_24dp.svg"></span>
      <span class="title">Ver-notas</span>
    </a>
    </li>
  <li class="list">
    <a href="conf-encarregado.php">
      <span class="icon"><img src="../img/settings.png"></span>
      <span class="title">Alterar-senha</span>
    </a>
  </li>
  <li class="list">
    <a href="../logoult.php">
      <span class="icon"><img src="../img/logout_white_24dp.svg"></span>
      <span class="title">Sair</span>
    </a>
  </li>
</ul> 
</div>
                    

<?php require_once "navMob-encarregado.php" ?>

<div class="fontes rounded-3" id="divm">

  <div class="divsuperior3">
    <h5>Gerenciar</h5>
  </div>

      <form action="notas-trimestrais.php" method="post">

        <div class="row">
         <div class="form-group col-md-4" id="margemB">
            <label for="textdisciplina">Aluno</label>
           <select id="textdisciplina" class="input form-control"
           name="ID_aluno"  required>
              <option value="">Selecione aqui</option>

          <?php $query = mysqli_query($conexao,"SELECT a.nome_a,a.id_a,e.id_e FROM sg_aluno AS a INNER JOIN sg_encarregado AS e ON e.id_e = a.idEncarregado WHERE idEncarregado = '$id_e' "); 

          while ($registro = mysqli_fetch_assoc($query)) {
              echo"<option value = '".$registro['id_a']."'>".$registro['nome_a']."</option>";
  
          }
               
          ?>    
           </select>
         </div>

        <div class="form-group col-md-4" id="margemB">
            <label for="ttrimAluno">Trimestres</label>
           <select id="ttrimAluno" class="input form-control"
           name="trimA"  required>
              <option value="">Selecione aqui</option>
              <option value="1">1ª Trimestre</option>
              <option value="2">2ª Trimestre</option>
              <option value="3">3ª Trimestre</option>
           </select>
         </div>


       <div class="col-md-2" id="margemB">
        <label></label>
          <button type="submit"  class="btn btn-success col-md-12" 
           name="ok">Ver-notas</button>
        </div>
        
        </div>
      </form>
</div>

<?php require_once "../footer2.php";  ?>

</body>

</html>