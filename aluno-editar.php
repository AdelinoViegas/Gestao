<?php 
require_once "conexao.php";
session_start();

$id = $_POST['id_estudante'];
$_SESSION['id_a'] = $id;

$sql_aluno = "SELECT * FROM sg_aluno AS a join sg_classe AS c ON c.id_c = a.idClasse join sg_turma AS t ON a.idTurma_a = t.id_t WHERE id_a ='$id' ";
$res_aluno = mysqli_query($conexao,$sql_aluno);
$registro = mysqli_fetch_assoc($res_aluno);
$city_array = ["Luanda", "Viana", "Belas", "Cazenga", "Kissama", "Kilamba Kiaxi", "Talatona", "Cacuaco", "Icolo e Bengo"];

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
      <h5>Editar dados do aluno</h5>
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
  <li class="list active">
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

<?php require_once "navbarMobile.php" ?>

<div class="fontes rounded-3" id="divm">

  <div class="divsuperior3">
    <h5>Editar dados do aluno</h5>
  </div>
      <form action="aluno-editar-processar.php" method="post">
        <div class="row">
         <div class="form-group col-md-6 mb-3">
            <label for="textnome">Nome</label>
           <input type="text" id="textnome" class="form-control"
           name="txtnome" value="<?php echo $registro['nome_a']; ?>">
         </div>
         <div class="form-group col-md-3 mb-3">
            <label for="textclasse">Classe</label>
          <select id="textclasse" class="input form-control"
           name="txtclasse" required>

            <option value="<?php echo $registro['idClasse'] ?>"><?php echo $registro['nome_c']; ?></option>
            
          <?php
            $query2 = mysqli_query($conexao,"SELECT id_c,nome_c FROM sg_classe");
          while ($dados = mysqli_fetch_assoc($query2)) {
              echo"<option value = '".$dados['id_c']."'>".$dados['nome_c']."</option>";

          }
          ?>    

           </select>
         </div>
         <div class="form-group col-md-3 mb-3">
            <label for="textturma">Turma</label>
          <select id="textturma" class="input form-control"
           name="txtturma" required>
            <option value="<?php echo $registro['idTurma_a'] ?>"><?php echo $registro['nome_t']; ?></option>
          <?php

            $query2 = mysqli_query($conexao,"SELECT id_t,nome_t FROM sg_turma");
          while ($dados = mysqli_fetch_assoc($query2)) {
              echo"<option value = '".$dados['id_t']."'>".$dados['nome_t']."</option>";

          }
          ?>    
           </select>
         </div>
       </div>
        
        <div class="row"> 
         <div class="form-group col-md-4 mb-3">
            <label for="textmun">Município</label>
            <select id="textmun" class="input form-control"
           name="txtmun" placeholder="Seu município" required>
           <option value="<?= $data['municipio_p'] ?>"><?= $data['municipio_p'] ?></option>
           <?php   
             foreach($city_array as $city){
              if($city !== $data['municipio_p']){?>
                  <option value="<?= $city ?>"><?= $city ?></option>
           <?php }}?>
           </select>
         </div>
         <div class="form-group col-md-4 mb-3">
            <label for="textbairro">Bairro</label>
           <input type="text" id="textbairro" class="form-control"
           name="txtbairro" value="<?php echo $registro['bairro_a']; ?>">
         </div>
         <div class="form-group col-md-4 mb-3">
            <label for="textsexo">sexo</label>
           <select type="text" id="textsexo" class="input md form-control"
           name="txtsexo" value="<?php echo $registro['sexo_a']; ?>" required>  
           <?php $sexo = $registro['sexo_a']; 
              if ($sexo == 'Masculino') {
            ?>
            <option value="<?php echo $registro['sexo_a']; ?>">Masculino</option>
            <option>Femenino</option>
            <?php } else { ?>
            <option value="<?php echo $registro['sexo_a']; ?>">Femenino</option>
            <option value="Masculino">Masculino</option>
            <?php } ?>
           </select>
         </div>
       </div>

       <div class="row">
         <div class="form-group col-md-4 mb-3">
            <label for="textcont">Contato</label>
           <input type="text" id="textcont" class="form-control"
           name="txtcont" value="<?php echo $registro['contato_a']; ?>" >
         </div>
          <div class="form-group col-md-4"  id="margemB">
            <label for="textnasc">Data de Nascimento</label>
           <input type="date" id="textnasc" class="form-control"
           name="txtnasc" value="<?php echo $registro['nascimento_a']; ?>">
         </div>
         <div class="form-group col-md-4 mb-3">
            <label for="textbi">Número do BI</label>
           <input type="text" id="textbi" class="form-control"
           name="txtbi" value="<?php echo $registro['numeroBI_a']; ?>">
         </div>
       </div>

        <div class="row">

          <?php 
            $query =mysqli_query($conexao,"SELECT * FROM sg_encarregado AS e INNER JOIN sg_aluno AS a ON e.id_e = a.idEncarregado WHERE id_a = '$id' ");
            $enc = mysqli_fetch_assoc($query);
           ?>
            <div class="form-group col-md-6 mb-3">
            <label for="textencarregado">Encarregado</label>
           <input type="text" readonly id="textencarregado" class="form-control"
           name="txtencarregado" maxlength="45" value="<?php echo $enc['nome_e']; ?>" required>
           </div>
        </div>

        <div class="row" id="marg">
          <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" 
           name="cadastramento" id="margemBotao">Gravar</button>

           <div class="col-md-8" id="margemBotao"></div>

          <a href="menu-alunos.php" class="btn btn-outline-secondary btn-block col-md-2" 
           name="cadastramento">Voltar</a>

        </div>
       </form>
</div>

<?php require_once "footer.php";  ?>
</body>
</html>

