<?php 
require_once "../conexao.php";

session_start();

if(isset($_POST['ver'])){
  $_SESSION['trim'] = $_POST['trimA'];
  header('Location: trimestres.php');

}

?>

<!DOCTYPE html>
<html>
<head>
  <title>principal</title>
    <?php require_once "../head2.php"; ?>
</head>
<body>

  <div class="divsuperior">
    <h1>Colégio Samiga</h1>
  </div>

  <div class="divsuperior2">
    <div class="divflex">
    <div>
      <h5>Notas-Trimestrais</h5>
    </div>
    <div class="d-flex">
      <h5 class="me-2">Usuário :</h5>
      <img class="me-1" src="../img/person.svg" id="IMG">
      <h5 class="me-3">Aluno</h5>
    </div>
    </div>
  </div>
  
<!--Navebar-->
<div class="navegacao">
<ul>
  <li class="list">
    <a href="homealuno.php">
      <span class="icon"><img src="../img/home_white_24dp.svg"></span>
      <span class="title">HOME</span>
    </a>
  </li>
  <li class="list active">
    <a href="ver-notas.php">
      <span class="icon"><img src="../img/perm_identity_white_24dp.svg"></span>
      <span class="title">Notas-Trimestrais</span>
    </a>
    </li>
  <li class="list">
    <a href="#">
      <span class="icon"><img src="../img/format_list_numbered_white_24dp.svg"></span>
      <span class="title">Exame</span>
    </a>
  </li>
  <li class="list">
    <a href="Mediaf.php">
      <span class="icon"><img src="../img/format_list_numbered_white_24dp.svg"></span>
      <span class="title">Resultado-final</span>
    </a>
  </li>
  <li class="list">
    <a href="conf-aluno.php">
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
                    

<?php require_once "navMob-aluno.php" ?>

<div class="fontes rounded-3" id="divm">

  <div class="divsuperior3">
   <h5>Notas-Trimestrais</h5>
  </div>

      <form action="" method="post">

        <div class="row margB">

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

       <div class="form-group col-md-2" id="margemB">
        <label></label>
          <button type="submit" id="inserir" class="btn btn-success col-md-12" 
           name="ver">Buscar</button>
        </div>
         


        </div>

      </form>
</div>

<?php require_once "../footer2.php";  ?>

</body>

</html>

