<?php
session_start();
require_once 'connection.php';
require_once "features/getData.php";
require_once "features/updateData.php";
require_once "features/setMessage.php";

$professor_id = mysqli_real_escape_string($connection, trim($_POST['professor_id']));

$professor_data = getData($connection, "SELECT * FROM sg_professor WHERE  id_p = ?", [$professor_id]);
$user_id = $professor_data['idUsuario'];

$update_professor = updateData($connection, "UPDATE sg_professor SET view = '0' WHERE id_p = ?", [$professor_id]);
$update_user = updateData($connection, "UPDATE sg_usuarios SET view = '0' WHERE id_u = ?", [$user_id]);

if ($update_professor && $update_user){
  setMessage("professor-message", "alert-success", "Eliminado com sucesso!");
  header('Location:menu-professores.php');
} else {
  setMessage("professor-message", "alert-danger", "Erro ao apagar!");
}
?>