<?php
require_once "../connection.php";
require_once "../features/updateData.php";
require_once "../features/setMessage.php";
session_start();

if (isset($_POST['btn-update'])) {
  $management_id = mysqli_real_escape_string($connection, trim($_SESSION['management_id']));
  $discipline_id = mysqli_real_escape_string($connection, trim($_POST['discipline']));
  $professor_id = mysqli_real_escape_string($connection, trim($_POST['professor']));
  $group_id = mysqli_real_escape_string($connection, trim($_POST['group']));
  $date = Date('Y');
  
  $update_management = updateData(
    $connection,
    "UPDATE tb_management SET disciplineID_m=?, ProfessorID_m=?, groupID_m=?, year_m=? WHERE id_m=?",
    [$discipline_id, $professor_id, $group_id, $date, $management_id]
  );

  if ($update_management) {
    setMessage("management-message", "alert-success", "Actualização feita com sucesso!");
    header('Location: menu-management.php');
  } else {
    setMessage("management-message", "alert-danger", "Erro a actualizar!");
  }
}
?>