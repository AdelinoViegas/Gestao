<?php 
require_once "conexao.php";

session_start();

$id = $_SESSION['id_d'];
$nome = $_POST['txtnome'];


$sql_disciplina = "UPDATE sg_disciplina SET nome_d ='$nome' WHERE id_d ='$id'"; 

$actualizar_disciplina = mysqli_query($conexao,$sql_disciplina);

if($actualizar_disciplina == true){

 $_SESSION['Disciplina-actualizado'] = "
                 <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-success alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
         Dados actualizado com sucesso!
      </div>
   </div>
   </div>";

header('Location: menu-disciplinas.php');

}else{

      $_SESSION['Disciplina-actualizado'] = "
                 <div id='alerta-confirmar'>
   <div class='alerta-confirmar'>
      <div class='alert alert-danger alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
          Erro ao actualizar!
      </div>
   </div>";
}


 ?>

