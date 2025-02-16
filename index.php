<?php

//conexão
require_once "conexao.php";
//Sessão
session_start();

   if(isset($_POST['enviar-dados']) ){

      $erros = array();
      //Filtrando os valores do login e senha para as variaveis $login e $senha

      $login = mysqli_escape_string($conexao,
        $_POST['txtnome']);
      $senha = mysqli_escape_string($conexao,
        $_POST['txtsenha']);
      $painel = mysqli_escape_string($conexao,
        $_POST['selecao']);

       $conection = $ligation->prepare("SELECT * FROM sg_usuarios WHERE nome_u = '$login'");
       $conection->execute();
       $array_usuario = $conection->fetchall(PDO::FETCH_ASSOC);
       $array_usuario = $array_usuario[0];


      if (count($array_usuario)  > 0){
          //$v = mysqli_fetch_assoc($valo); 
            $estado = $array_usuario['senha_u'];  

      if(password_verify($senha,$estado)){
          $senha = $estado;
      }
    }

      $sql = "SELECT * FROM sg_usuarios WHERE nome_u = '$login' AND senha_u = '$senha' AND estado_u ='activo' AND painel_u = '$painel'";
      $res = $ligation->prepare($sql);
      $res->execute();     
      $dados =  $res->fetchall(PDO::FETCH_ASSOC);
      $dados = $dados[0];
      if(empty($login) || empty($senha)){
        $erros[] = "<span>O campo login e senha preecisa ser preenchido</span>";
      }else{
       if (empty($dados)) {
            $erros[] = "<span>Usuário enexistente</span>";
        }else {
               if($painel === 'admin'){           
                if($dados['senha_u'] === $senha && $dados['nome_u'] === $login){                       
                        $_SESSION['logado'] = true;
                        $_SESSION['id_adm'] = $dados['id_u'];
                        $_SESSION['nome'] = $dados['painel_u'];  
                  header('Location: menu-home.php');
                }
              }elseif($painel === 'professor'){           
                if($dados['senha_u'] === $senha && $dados['nome_u'] === $login){
                  $id = $dados['id_u'];
                  $v1 = $ligation->prepare("SELECT id_p FROM sg_professor WHERE idUsuario = '$id'");
                  $v1->execute();
                  $vect = $v1->fetchAll(PDO::FETCH_ASSOC);
                  $vect = $vect[0];             
                    $_SESSION['logado'] = true;
                     $_SESSION['idp'] = $vect['id_p'];
                     $_SESSION['iduser_p'] = $dados['id_u'];
                    $_SESSION['nome_professor'] = $dados['nome_u'];  
                  header('Location: professor/homeprof.php');
                }
              }elseif($painel === 'encarregado'){           
                if($dados['senha_u'] === $senha && $dados['nome_u'] === $login){
                  $id = $dados['id_u'];
                  $v1 = $ligation->prepare("SELECT id_e FROM sg_encarregado WHERE idUsuario = '$id'");
                   $v1->execute();
                   $vect = $v1->fetchAll(PDO::FETCH_ASSOC);
                   $vect = $vect[0];
        
                    $_SESSION['logado'] = true;
                     $_SESSION['ide'] = $vect['id_e'];
                     $_SESSION['iduser_e'] = $dados['id_u'];
                    $_SESSION['nome_encarregado'] = $dados['nome_u'];  
                  header('Location: encarregado/homepais.php');
                }
              }elseif($painel === 'aluno'){           
                if($dados['senha_u'] === $senha && $dados['nome_u'] === $login){
                  $id = $dados['id_u'];
                  $v1 = $ligation->prepare("SELECT * FROM sg_aluno WHERE idUsuario = '$id'");
                   $v1->execute();
                   $vect = $v1->fetchAll(PDO::FETCH_ASSOC);
                    $_SESSION['logado'] = true;
                    $_SESSION['ida'] = $vect['id_a'];
                    $_SESSION['iduser_a'] = $dados['id_u'];
                    $_SESSION['nome_aluno'] = $dados['nome_u'];  
                  header('Location: aluno/homealuno.php');
                }
              }
        }
      }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="bootstrap5/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/login.css?v=2">
  <link rel="stylesheet" type="text/css" href="css/media.css?v=5">
</head>
<body>
<div class="card" id="formlog">
    <div id="txtlogin">Login</div>
   <div class="card-body">
    <div id="img">
    <img src="img/logo/logo3.jpg">
     </div>
      <?php
        if(!empty($erros)){
          foreach($erros as $value){
            echo $value."<br>";
          }
        } 
        ?>
      <form id="formulario" action="index.php" method="post">
         <div class="form-group">
           <input type="texy" id="textnome" class="form-control"
        name="txtnome" placeholder="Nome do usuário">
         </div>
         <div class="form-group">
           <input type="password" id="textsenha" class="form-control"
        name="txtsenha" placeholder="Senha do usuário">
         </div>
         <div class="form-group">
          <label for="textusuario">Painel</label>
         <select id="textusuario" class="input form-control"
           name="selecao" required>
              <option value="">Selecione o painel</option>
              <option value="aluno">Aluno</option>
              <option value="admin">Administrador</option>
              <option value="professor">Professor</option>
              <option value="encarregado">Encarregado</option>
           </select>
         </div>
         <button type="submit" class="btn btn-outline-primary btn-block" 
         name="enviar-dados">Entrar</button>
      </form>
   </div>
</div>

<script src="bootstrap5/js/bootstrap.bundle.min.js"></script>

</body>
</html>