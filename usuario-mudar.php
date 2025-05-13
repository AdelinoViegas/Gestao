<?php
require_once "connection.php";
require_once "features/updateData.php";
session_start();

$userId = $_POST['userId'];
$userState = $_POST['userState'];

if (isset($_POST['btn-state'])) {
  $state = $userState === "activo"?"inactivo":"activo";
  $sql = "UPDATE sg_usuarios SET estado_u =? WHERE id_u =?";
  $update_data = updateData(
    $connection,
    $sql,
    [$state, $userId]
  );
  
  if($update_data)
    header('Location: menu-usuarios.php'); 
}
?>