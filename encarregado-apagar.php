<?php 
/*abrir a sessçao*/
session_start();

require_once 'conexao.php';

$id_encarregado = mysqli_escape_string($conexao,$_POST['id_encarregado']);
$sql = "UPDATE sg_encarregado SET view = '0' WHERE id_e = '$id_encarregado'";

/*Buscar id_usuario na tabela sg_aluno*/
$cm = "SELECT * FROM sg_encarregado WHERE  id_e = '$id_encarregado'";
$res = mysqli_query($conexao,$cm);
$vt = mysqli_fetch_assoc($res);
$id_usuario = $vt['idUsuario'];

$sql2 = "UPDATE sg_usuarios SET view = '0' WHERE id_u = '$id_usuario'";


if(( mysqli_query($conexao,$sql) ) && ( mysqli_query($conexao,$sql2) ) ){

 $_SESSION['Encarregado-actualizado'] = "
          <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-success alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
         Eliminado com sucesso!
      </div>
   </div>
   </div>";	
 
 header('Location:menu-encarregados.php');

}else{

 
  $_SESSION['Encarregado-actualizado'] = "
          <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-danger alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
          Erro ao apagar!
      </div>
   </div>";
}

header('Location:menu-encarregados.php');
 ?>