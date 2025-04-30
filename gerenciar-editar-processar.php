<?php
require_once "connection.php";
require_once "features/updateData.php";
require_once "features/setMessage.php";
session_start();

if (isset($_POST['btn-update'])) {
  $management_id = mysqli_real_escape_string($connection, trim($_SESSION['management_id']));
  $discipline_id = mysqli_real_escape_string($connection, trim($_POST['discipline']));
  $professor_id = mysqli_real_escape_string($connection, trim($_POST['professor']));
  $group_id = mysqli_real_escape_string($connection, trim($_POST['group']));
  $date = Date('Y');
  
  $update_management = updateData(
    $connection,
    "UPDATE sg_gerenciar SET idDisciplina=?, idProfessor =?, idTurma =?, ano =? WHERE id_g =?",
    [$discipline_id, $professor_id, $group_id, $date, $management_id]
  );

  if ($update_management) {
    setMessage("management-message", "alert-success", "Actualização feita com sucesso!");
    header('Location: menu-gerenciar.php');
  } else {
    setMessage("management-message", "alert-danger", "Erro a actualizar!");
  }
}
?>