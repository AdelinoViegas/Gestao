<?php 
require_once "conexao.php";

session_start();

$id = $_SESSION['id'];
$nome = $_POST['txtnome'];


$sql_turma = "UPDATE sg_turma SET nome_t ='$nome' WHERE id_t ='$id'"; 

$actualizar_turma = mysqli_query($conexao,$sql_turma);

if($actualizar_turma == true){

 $_SESSION['Turma-actualizado'] = "
                 <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-success alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
         Dados actualizado com sucesso!
      </div>
   </div>
   </div>";

header('Location: menu-turmas.php');

}else{

      $_SESSION['Turma-actualizado'] = "
                 <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-danger alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
          Erro ao actualizar!
      </div>
   </div>";
}


 ?>
