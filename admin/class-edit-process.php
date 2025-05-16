<?php
require_once "../connection.php";
require_once "../features/setMessage.php";
require_once "../features/updateData.php";
session_start();

if (isset($_POST['btn-update'])) {
  $class_id = $_SESSION['class_id'];
  $name = mysqli_real_escape_string($connection, trim($_POST['name']));

  $update_class = updateData(
    $connection,
    "UPDATE sg_classe SET nome_c =? WHERE id_c =?",
    [$name, $class_id]
  );

  if ($update_class) {
    setMessage("class-message", "alert-success", "Dados actualizado com sucesso!");
    header('Location: menu-class.php');
  } else {
    setMessage("class-message", "alert-danger", "Erro ao actualizar!");
  }
}
?>