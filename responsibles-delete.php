<?php
session_start();
require_once 'connection.php';
require_once "features/getData.php";
require_once "features/updateData.php";
require_once "features/setMessage.php";

$responsible_id = mysqli_escape_string($connection, $_POST['responsible_id']);

$responsible_data = getData($connection, "SELECT * FROM sg_encarregado WHERE  id_e = ?", [$responsible_id]);
$user_id = $responsible_data['idUsuario'];

$update_responsible = updateData($connection, "UPDATE sg_encarregado SET view = '0' WHERE id_e = ?", [$responsible_id]);
$update_user = updateData($connection, "UPDATE sg_usuarios SET view = '0' WHERE id_u = ?", [$user_id]);

if ($update_responsible && $update_user) {
  setMessage("responsible-message", "alert-success", "Eliminado com sucesso!");
  header('Location: menu-reponsibles.php');
} else {
  setMessage("responsible-message", "alert-success", "Erro ao apagar!");
}
?>