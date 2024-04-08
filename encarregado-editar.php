
<?php 
require_once "conexao.php";

session_start();
$id = $_POST['id_encarregado'];
$_SESSION['id_e'] = $id;

$sql_encarregado = "SELECT * FROM sg_encarregado WHERE id_e ='$id' ";
$res_encarregado = mysqli_query($conexao,$sql_encarregado);
$registro = mysqli_fetch_assoc($res_encarregado);

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
       <h5>Editar dados do encarregado</h5>
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
  <li class="list active">
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


<?php require_once "navbarMobile.php" ?>

<div class="fontes rounded-3" id="divm">

  <div class="divsuperior3">
    <h5>Editar dados do encarregado</h5>
  </div>

           <form action="encarregado-editar-processar.php" method="post">

        <div class="row">
         <div class="form-group col-md-6 mb-3">
            <label for="textnome">Nome</label>
           <input type="text" id="textnome" class="form-control"
           name="txtnome" maxlength="45" placeholder="Nome do aluno" value="<?php echo $registro['nome_e']; ?>" required>
         </div>
          <div class="form-group col-md-3 mb-3">
            <label for="textmun">Município</label>
           <select id="textmun" class="input form-control"
           name="txtmun" required>
             <?php $mun = $registro['municipio_e']; 
              if ($mun == 'Luanda') {
            ?>
              <option value="<?php echo $registro['municipio_e']; ?>">Luanda</option>
              <option value="Viana">Viana</option>
              <option value="Belas">Belas</option>
              <option value="Cazenga">Cazenga</option>
              <option value="Kissama">Kissama</option>
              <option value="Kilamba Kiaxi">Kilamba Kiaxi</option>
              <option value="Talatona">Talatona</option>
              <option value="Cacuaco">Cacuaco</option>
              <option value="Icolo e Bengo">Icolo e Bengo</option>
            <?php } else if ($mun == 'Viana') { ?>
              <option value="<?php echo $registro['municipio_e']; ?>">Viana</option>
              <option value="Luanda">Luanda</option>
              <option value="Belas">Belas</option>
              <option value="Cazenga">Cazenga</option>
              <option value="Kissama">Kissama</option>
              <option value="Kilamba Kiaxi">Kilamba Kiaxi</option>
              <option value="Talatona">Talatona</option>
              <option value="Cacuaco">Cacuaco</option>
              <option value="Icolo e Bengo">Icolo e Bengo</option>
               <?php } else if ($mun == 'Belas') { ?>
              <option value="<?php echo $registro['municipio_e']; ?>">Belas</option>
              <option value="Luanda">Luanda</option>
              <option value="Viana">Viana</option>
              <option value="Cazenga">Cazenga</option>
              <option value="Kissama">Kissama</option>
              <option value="Kilamba Kiaxi">Kilamba Kiaxi</option>
              <option value="Talatona">Talatona</option>
              <option value="Cacuaco">Cacuaco</option>
              <option value="Icolo e Bengo">Icolo e Bengo</option>
              <?php } else if ($mun == 'Cazenga') { ?>
              <option value="<?php echo $registro['municipio_e']; ?>">Cazenga</option>
              <option value="Luanda">Luanda</option>
              <option value="Viana">Viana</option>
              <option value="Belas">Belas</option>
              <option value="Kissama">Kissama</option>
              <option value="Kilamba Kiaxi">Kilamba Kiaxi</option>
              <option value="Talatona">Talatona</option>
              <option value="Cacuaco">Cacuaco</option>
              <option value="Icolo e Bengo">Icolo e Bengo</option>
              <?php } else if ($mun == 'Kissama') { ?>
              <option value="<?php echo $registro['municipio_e']; ?>">Kissama</option>
              <option value="Luanda">Luanda</option>
              <option value="Viana">Viana</option>
              <option value="Belas">Belas</option>
              <option value="Cazenga">Cazenga</option>
              <option value="Kilamba Kiaxi">Kilamba Kiaxi</option>
              <option value="Talatona">Talatona</option>
              <option value="Cacuaco">Cacuaco</option>
              <option value="Icolo e Bengo">Icolo e Bengo</option>
              <?php }else if ($mun == 'Kilamba Kiaxi') { ?>
              <option value="<?php echo $registro['municipio_e']; ?>">Kilamba Kiaxi</option>
              <option value="Luanda">Luanda</option>
              <option value="Viana">Viana</option>
              <option value="Belas">Belas</option>
              <option value="Cazenga">Cazenga</option>
              <option value="Kissama">Kissama</option>
              <option value="Talatona">Talatona</option>
              <option value="Cacuaco">Cacuaco</option>
              <option value="Icolo e Bengo">Icolo e Bengo</option>
              <?php } else if ($mun == 'Talatona') { ?>
              <option value="<?php echo $registro['municipio_e']; ?>">Talatona</option>
              <option value="Luanda">Luanda</option>
              <option value="Viana">Viana</option>
              <option value="Belas">Belas</option>
              <option value="Cazenga">Cazenga</option>
              <option value="Kissama">Kissama</option>
              <option value="Kilamba Kiaxi">Kilamba Kiaxi</option>
              <option value="Cacuaco">Cacuaco</option>
              <option value="Icolo e Bengo">Icolo e Bengo</option>
              <?php } else if ($mun == 'Cacuaco') { ?>
              <option value="<?php echo $registro['municipio_e']; ?>">Cacuaco</option>
              <option value="Luanda">Luanda</option>
              <option value="Viana">Viana</option>
              <option value="Belas">Belas</option>
              <option value="Cazenga">Cazenga</option>
              <option value="Kissama">Kissama</option>
              <option value="Kilamba Kiaxi">Kilamba Kiaxi</option>
              <option value="Talatona">Talatona</option>
              <option value="Icolo e Bengo">Icolo e Bengo</option>
            <?php } else if ($mun == 'Icolo e Bengo') { ?>
              <option value="<?php echo $registro['municipio_e']; ?>">Icolo e Bengo</option>
              <option value="Luanda">Luanda</option>
              <option value="Viana">Viana</option>
              <option value="Belas">Belas</option>
              <option value="Cazenga">Cazenga</option>
              <option value="Kissama">Kissama</option>
              <option value="Kilamba Kiaxi">Kilamba Kiaxi</option>
              <option value="Talatona">Talatona</option>
              <option value="Cacuaco">Cacuaco</option>
            <?php }?>
           </select>
         </div>
        <div class="form-group col-md-3 mb-3">
            <label for="textbairro">Bairro</label>
           <input type="text" id="textbairro" class="form-control"
           name="txtbairro" maxlength="20" placeholder="Seu bairro" value="<?php echo $registro['bairro_e']; ?>" required>
         </div>
        </div>
        
        <div class="row"> 
         <div class="form-group col-md-4 mb-3">
            <label for="textsexo">sexo</label>
           <select type="text" id="textsexo" class="input md form-control"
           name="txtsexo" value="<?php echo $registro['sexo_e']; ?>" required> 
           <?php $sexo = $registro['sexo_e']; 
              if ($sexo == 'Masculino') {
            ?>
            <option value="<?php echo $registro['sexo_e']; ?>">Masculino</option>
            <option>Femenino</option>
            <?php } else { ?>
            <option value="<?php echo $registro['sexo_e']; ?>">Femenino</option>
            <option value="Masculino">Masculino</option>
            <?php } ?>
           </select>
         </div>
         <div class="form-group col-md-4 mb-3">
            <label for="textcont">Contato</label>
           <input type="text" id="textcont" class="form-control"
           name="txtcont" maxlength="9" value="<?php echo $registro['contato_e']; ?>" placeholder="xxx-xx-xx-xx" required>
         </div>
          <div class="form-group col-md-4 mb-3">
            <label for="textnasc">Data de Nascimento</label>
           <input type="date" id="textnasc" class="form-control"
           name="txtnasc" value="<?php echo $registro['nascimento_e']; ?>" required>
         </div>
       </div>
           
       <div class="row">
        <div class="form-group col-md-3 mb-3">
            <label for="textbi">Número do BI</label>
           <input type="text" id="textbi" class="form-control"
           name="txtbi" value="<?php echo $registro['numeroBI_e']; ?>" placeholder="Nª do bilhete" maxlength="15" required>
         </div>
       </div>

        <div class="row" id="marg">
          <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" 
           name="btn-cadastrar" id="margemBotao">Gravar</button>

           <div class="col-md-8" id="margemBotao"></div>

          <a href="menu-encarregados.php" class="btn btn-outline-secondary btn-block col-md-2" 
           name="btn-voltar">Voltar</a>

        </div>

       </form>
</div>


<?php require_once "footer.php";  ?>
</body>
</html>

