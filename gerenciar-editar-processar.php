<?php 
require_once "conexao.php";

session_start();

$id = $_SESSION['id_gerenciar'];
$id_disciplina = $_POST['txtdisciplina'];
$id_professor = $_POST['txtprofessor'];
$id_turma = $_POST['txtturma'];
$data = Date('Y');

$sql_gerenciar = "UPDATE sg_gerenciar SET idDisciplina ='$id_disciplina',idProfessor = '$id_professor',idTurma = '$id_turma',ano = '$data' WHERE id_g ='$id'"; 
$actualizar_gerenciar = mysqli_query($conexao,$sql_gerenciar);

if($actualizar_gerenciar == true){

    $_SESSION['Gerenciar-actualizar'] = "
          <div id='alerta-confirmar'>
      <div class='alerta-confirmar'>
      <div class='alert alert-success alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
         Actualização feita com sucesso!
      </div>
      </div>
    </div>";

header('Location: menu-gerenciar.php');

}else{

          $_SESSION['Gerenciar-actualizar'] = "
          <div id='alerta-confirmar'>
      <div class='alerta-confirmar'>
      <div class='alert alert-danger alert-dimissible'>
       <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
         Erro a actualizar!
      </div>
      </div>
    </div>";
}


 ?>
