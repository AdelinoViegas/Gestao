<?php 
require_once "conexao.php";

session_start();

$id = $_SESSION['id'];
$nome = $_POST['txtnome'];


$sql_classe = "UPDATE sg_classe SET nome_c ='$nome' WHERE id_c ='$id'"; 

$actualizar_classe = mysqli_query($conexao,$sql_classe);

if($actualizar_classe == true){

 $_SESSION['Classe-actualizado'] = "
                 <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-success alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
         Dados actualizado com sucesso!
      </div>
   </div>
   </div>";

header('Location: menu-classes.php');

}else{

      $_SESSION['Classe-actualizado'] = "
                 <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-danger alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
          Erro ao actualizar!
      </div>
   </div>";
}


 ?>

