<?php 
require_once "connection.php";
require_once "features/getData.php";
require_once "features/signData.php";
require_once "features/setMessage.php";
session_start();

if(isset($_POST['btn-cadastrar'])){
    $nome = mysqli_escape_string($connection,trim($_POST['txtnome']));
    $mun = mysqli_escape_string($connection,trim($_POST['txtmun']));
    $bairro = mysqli_escape_string($connection,trim($_POST['txtbairro']));
    $sexo = mysqli_escape_string($connection,trim($_POST['txtsexo']));
    $contato = mysqli_escape_string($connection,trim($_POST['txtcont']));
    $dataNasc = mysqli_escape_string($connection,trim($_POST['txtnasc']));
    $numeroBI = mysqli_escape_string($connection,trim($_POST['txtbi']));


  $sql_nome = "SELECT nome_e FROM sg_encarregado WHERE nome_e = '$nome' ";
  $sql_bi = "SELECT numeroBI_e FROM sg_encarregado WHERE numeroBI_e = '$numeroBI' ";
  $verificacao_nome = getData($connection,$sql_nome);
  $verificacao_bi = getData($connection,$sql_bi);


if(mysqli_num_rows($verificacao_bi) > 0){

  $_SESSION['Encarregado-cadastrado'] = "
   <div id='alerta-confirmar'>
     <div class='alerta-confirmar'>
        <div class='alert alert-danger alert-dimissible'>
         <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
           Codigo de BI já existente!
        </div>
     </div>
   </div>";


}elseif(mysqli_num_rows($verificacao_nome) > 0){
  $_SESSION['Encarregado-cadastrado'] = "
   <div id='alerta-confirmar'>
     <div class='alerta-confirmar'>
        <div class='alert alert-danger alert-dimissible'>
         <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
           Encarregado já existente!
        </div>
     </div>
   </div>";

}else{
          $dt = date('Y/m/d');
    
          if(mysqli_num_rows($verificacao_bi) > 0){

          $_SESSION['Encarregado-cadastrado'] = "
           <div id='alerta-confirmar'>
             <div class='alerta-confirmar'>
                <div class='alert alert-danger alert-dimissible'>
                 <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
                   Encarregado já existente!
                </div>
             </div>
           </div>";


          }else{
             date_default_timezone_set('Africa/Luanda');
             $dt = date('Y/m/d H:i:s');
              $senha = password_hash('encarregado', PASSWORD_DEFAULT);

          $r_usuario = mysqli_query($connection,"INSERT INTO sg_usuarios(nome_u,senha_u,estado_u,painel_u,dataCadastro_u,dataModificacao_u) VALUES ('$nome','$senha','activo','encarregado','$dt','$dt')");    

          //Capturar o id do dado cadastrado
          $sql_id = mysqli_query($connection,"SELECT id_u FROM sg_usuarios WHERE nome_u = '$nome'");
          $arr = mysqli_fetch_assoc($sql_id);
          $iduser = $arr['id_u']; 

          $r_encarregado = mysqli_query($connection,"INSERT INTO sg_encarregado(idUsuario,nome_e,sexo_e,municipio_e,bairro_e,nascimento_e,contato_e,numeroBI_e,dataCadastro_e,dataModificacao_e) VALUES ('$iduser','$nome','$sexo','$mun','$bairro','$dataNasc','$contato','$numeroBI','$dt','$dt')");

                     

        if($r_encarregado == true && $r_usuario == true){

         $_SESSION['Encarregado-cadastrado'] = "
                         <div id='alerta-confirmar'>
           <div class='alerta-confirmar'>
              <div class='alert alert-success alert-dimissible'>
               <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
                 Encarregado cadastrado com sucesso!
              </div>
           </div>
           </div>";


        }else{

              $_SESSION['Encarregado-cadastrado'] = "
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
      <h5>Formulário de cadastramento de encarregados</h5>
    </div>
    <div class="d-flex">
      <h5 class="me-2">Usuário :</h5>
      <img class="me-1" src="img/person.svg" id="IMG">
      <h5 class="me-3">Administrador</h5>
    </div>
    </div>
  </div>

  <?php
  if(isset($_SESSION['Encarregado-cadastrado'])){
      echo $_SESSION['Encarregado-cadastrado'];
      unset($_SESSION['Encarregado-cadastrado']);
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
    <h5>Formulário de cadastramento de encarregados</h5>
  </div>

      <form action="encarregado-cadastro.php" method="post">

        <div class="row">
         <div class="form-group col-md-6 mb-3" >
            <label for="textnome">Nome</label>
           <input type="text" id="textnome" class="form-control"
           name="txtnome" maxlength="45" placeholder="Nome completo do encarregado/a" required>
         </div>
          <div class="form-group col-md-3 mb-3">
            <label for="textmun">Município</label>
           <select id="textmun" class="input form-control"
           name="txtmun" placeholder="Seu município" required>
              <option value="">Selecione aqui</option>
              <option value="Luanda">Luanda</option>
              <option value="Viana">Viana</option>
              <option value="Belas">Belas</option>
              <option value="Cazenga">Cazenga</option>
              <option value="kissama">Kissama</option>
              <option value="Kilamba Kiaxi">Kilamba Kiaxi</option>
              <option value="Talatona">Talatona</option>
              <option value="Cacuaco">Cacuaco</option>
              <option value="Icolo e Bengo">Icolo e Bengo</option>
           </select>
         </div>
        <div class="form-group col-md-3 mb-3">
            <label for="textbairro">Bairro</label>
           <input type="text" id="textbairro" class="form-control"
           name="txtbairro" maxlength="20" placeholder="Seu bairro" required>
         </div>
        </div>
        
        <div class="row"> 
         <div class="form-group col-md-3 mb-3">
            <label for="textsexo">sexo</label>
           <select id="textsexo" class="input form-control"
           name="txtsexo" required>
              <option value="">Selecione aqui</option>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
           </select>
         </div>

         <div class="form-group col-md-3 mb-3">
            <label for="textcont">Contato</label>
           <input type="text" id="textcont" class="form-control"
           name="txtcont" placeholder="xxx-xx-xx-xx" maxlength="9" required>
         </div>

        <div class="form-group col-md-3 mb-3">
            <label for="textnasc">Data de Nascimento</label>
           <input type="date" id="textnasc" class="form-control"
           name="txtnasc" required>
         </div>
         <div class="form-group col-md-3 mb-3">
            <label for="textbi">Número do BI</label>
           <input type="text" id="textbi" class="form-control"
           name="txtbi"placeholder="Nª do bilhete" maxlength="15" required>
         </div>
       </div>


        <div class="row" id="marg">
          <button type="submit" id="inserir" class="btn btn-outline-primary btn-block col-md-2" 
           name="btn-cadastrar" id="margemBotao">Cadastrar</button>

           <div class="col-md-8"  id="margemBotao"></div>

          <a href="menu-encarregados.php" class="btn btn-outline-secondary btn-block col-md-2" 
           name="btn-voltar">Voltar</a>

        </div>

       </form>
</div>

<?php require_once "footer.php";  ?>
</body>
</html>