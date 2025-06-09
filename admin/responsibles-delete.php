<?php
session_start();
require_once '../connection.php';
require_once "../features/getData.php";
require_once "../features/updateData.php";
require_once "../features/setMessage.php";

$responsible_id = mysqli_escape_string($connection, $_POST['responsible_id']);

$responsible_data = getData($connection, "SELECT * FROM tb_responsibles WHERE  id_r = ?", [$responsible_id]);
$user_id = $responsible_data['userID_r'];

$update_responsible = updateData($connection, "UPDATE tb_responsibles SET view_r = '0' WHERE id_r = ?", [$responsible_id]);
$update_user = updateData($connection, "UPDATE tb_users SET view_u = '0' WHERE id_u = ?", [$user_id]);

if ($update_responsible && $update_user) {
  setMessage("responsible-message", "alert-success", "Eliminado com sucesso!");
  header('Location: menu-responsibles.php');
} else {
  setMessage("responsible-message", "alert-success", "Erro ao apagar!");
}
?>