<?php 
require_once "conexao.php";

session_start();

$id = $_SESSION['id_a'];


 echo $id;
$nome = $_POST['txtnome'];
$turma = $_POST['txtturma'];
$classe = $_POST['txtclasse'];
$municipio = $_POST['txtmun'];
$bairro = $_POST['txtbairro'];
$sexo = $_POST['txtsexo'];
$contato = $_POST['txtcont'];
$datanasc = $_POST['txtnasc'];
$numeroBI = $_POST['txtbi'];
date_default_timezone_set('Africa/Luanda');
$dt = date('Y/m/d H:i:s');


$sql_aluno = "UPDATE sg_aluno SET nome_a='$nome',idTurma_a='$turma',idClasse='$classe',municipio_a='$municipio',bairro_a='$bairro',sexo_a='$sexo',contato_a='$contato',nascimento_a='$datanasc',numeroBI_a='$numeroBI',dataModificacao_a='$dt' WHERE id_a='$id'"; 
$actualizar_aluno = mysqli_query($conexao,$sql_aluno);


//Actualizar na tabela usuarios
$c=mysqli_query($conexao,"SELECT idUsuario FROM sg_aluno WHERE nome_a = '$nome'");
$cat = mysqli_fetch_assoc($c);
$idger = $cat['idUsuario'];

$actualizar_usuario = mysqli_query($conexao,"UPDATE sg_usuarios SET nome_u ='$nome',dataModificacao_u = '$dt' WHERE id_u ='$idger'"); 


if($actualizar_aluno == true && $actualizar_usuario == true){

 $_SESSION['Aluno-actualizado'] = "
                 <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-success alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
         Dados actualizado com sucesso!
      </div>
   </div>
   </div>";

header('Location: menu-alunos.php');

}else{

      $_SESSION['Aluno-actualizado'] = "
                 <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-danger alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
          Erro ao actualizar!
      </div>
   </div>";

}

 
?>

