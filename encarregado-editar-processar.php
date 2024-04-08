<?php 
require_once "conexao.php";

session_start();

$id = $_SESSION['id_e'];
$nome = $_POST['txtnome'];
$municipio = $_POST['txtmun'];
$bairro = $_POST['txtbairro'];
$sexo = $_POST['txtsexo'];
$contato = $_POST['txtcont'];
date_default_timezone_set('Africa/Luanda');
$dt = date('Y/m/d H:i:s');

$sql_encarregado = "UPDATE sg_encarregado SET nome_e='$nome',municipio_e='$municipio',bairro_e='$bairro',sexo_e='$sexo',contato_e='$contato',dataModificacao_e='$dt' WHERE id_e='$id'"; 

$actualizar_encarregado = mysqli_query($conexao,$sql_encarregado);

//Actualizar na tabela usuarios
$c=mysqli_query($conexao,"SELECT idUsuario FROM sg_encarregado WHERE nome_e = '$nome'");
$cat = mysqli_fetch_assoc($c);
$idger = $cat['idUsuario'];

$actualizar_usuario = mysqli_query($conexao,"UPDATE sg_usuarios SET nome_u ='$nome',dataModificacao_u = '$dt' WHERE id_u ='$idger'"); 

if($actualizar_encarregado == true && $actualizar_usuario == true){

 $_SESSION['Encarregado-actualizado'] = "
                 <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-success alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
         Dados actualizado com sucesso!
      </div>
   </div>
   </div>";

header('Location: menu-encarregados.php');

}else{

      $_SESSION['Encarregado-actualizado'] = "
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
