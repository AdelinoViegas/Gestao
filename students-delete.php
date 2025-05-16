<?php 
require_once 'connection.php';
require_once "features/updateData.php";
require_once "features/getData.php";
require_once "features/setMessage.php";
session_start();

$student_id = mysqli_real_escape_string($connection, trim($_POST['student_id']));

$student_data = getData($connection, "SELECT * FROM sg_aluno WHERE  id_a =?", [$student_id]);
$user_id = $student_data['idUsuario'];

$update_student = updateData($connection, "UPDATE sg_aluno SET view = '0' WHERE id_a =?", [$student_id]);
$update_user = updateData($connection, "UPDATE sg_usuarios SET view = '0' WHERE id_u =?", [$user_id]);

if($update_student && $update_user){
   setMessage("student-message", "alert-success", "Eliminado com sucesso!");
   header('Location: menu-students.php');
 } else {
   setMessage("student-message", "alert-danger", "Erro ao apagar!");
 }
 ?>

