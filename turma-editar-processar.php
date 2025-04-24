<?php
require_once "connection.php";
require_once "features/updateData.php";
require_once "features/setMessage.php";
session_start();

if (isset($_SESSION['btn-update'])) {
   $group_id = $_SESSION['group_id'];
   $name = mysqli_real_escape_string($connection, trim($_POST['txtnome']));

   $update_group = updateData(
      $connection,
      "UPDATE sg_turma SET nome_t ='$nome' WHERE id_t =?",
      [$group_id]
   );

   if ($update_group) {
      setMessage("group-message", "alert-success", "Dados actualizado com sucesso!");
      header('Location: menu-turmas.php');
   } else {
      setMessage("group-message", "alert-danger", "Erro ao actualizar!");
   }
}
?>