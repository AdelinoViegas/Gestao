<?php 
require_once "conexao.php";

session_start();

$id = $_SESSION['id_p'];
$nome = $_POST['txtnome'];
$email = $_POST['txtemail'];
$municipio = $_POST['txtmun'];
$bairro = $_POST['txtbairro'];
$sexo = $_POST['txtsexo'];
$contato = $_POST['txtcont'];
$datanasc = $_POST['txtnasc'];
$numeroBI = $_POST['txtbi'];
date_default_timezone_set('Africa/Luanda');
$dt = date('Y/m/d H:i:s');


$sql_professor = "UPDATE sg_professor SET nome_p='$nome',email_p='$email',municipio_p='$municipio',bairro_p='$bairro',sexo_p='$sexo',contato_p='$contato',nascimento_p='$datanasc',numeroBI_p='$numeroBI',dataModificacao_p='$dt' WHERE id_p='$id'"; 

$actualizar_professor = mysqli_query($conexao,$sql_professor);

//Actualizar na tabela usuarios
$c=mysqli_query($conexao,"SELECT idUsuario FROM sg_professor WHERE nome_p = '$nome'");
$cat = mysqli_fetch_assoc($c);
$idger = $cat['idUsuario'];

$actualizar_usuario = mysqli_query($conexao,"UPDATE sg_usuarios SET nome_u ='$nome',dataModificacao_u = '$dt' WHERE id_u ='$idger'"); 

if($actualizar_professor == true && $actualizar_usuario == true){

 $_SESSION['Professor-actualizado'] = "
                 <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-success alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
         Dados actualizado com sucesso!
      </div>
   </div>
   </div>";

header('Location: menu-professores.php');

}else{

      $_SESSION['Professor-actualizado'] = "
                 <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-danger alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
          Erro ao actualizar!
      </div>
   </div>
   </div>";
}



 ?>
