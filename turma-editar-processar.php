<?php
require_once "connection.php";
require_once "features/updateData.php";
require_once "features/setMessage.php";
session_start();

if (isset($_POST['btn-update'])) {
   $group_id = $_SESSION['group_id'];
   $name = mysqli_real_escape_string($connection, trim($_POST['name']));

   $update_group = updateData(
      $connection,
      "UPDATE sg_turma SET nome_t =? WHERE id_t =?",
      [$name, $group_id]
   );
   
   if ($update_group) {
      setMessage("group-message", "alert-success", "Dados actualizado com sucesso!");
      header('Location: menu-turmas.php');
   } else {
      setMessage("group-message", "alert-danger", "Erro ao actualizar!");
   }
}
?>