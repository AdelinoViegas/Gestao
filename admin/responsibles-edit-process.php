<?php
session_start();
require_once "../connection.php";
require_once "../features/getCurrentDate.php";
require_once "../features/getData.php";
require_once "../features/setMessage.php";
require_once "../features/updateData.php";

if (isset($_POST['btn-update'])) {
  $responsible_id = $_SESSION['responsible_id'];
  $name = mysqli_real_escape_string($connection, trim($_POST['name']));
  $city = mysqli_real_escape_string($connection, trim($_POST['city']));
  $neighborhood = mysqli_real_escape_string($connection, trim($_POST['neighborhood']));
  $gender = mysqli_real_escape_string($connection, trim($_POST['gender']));
  $contact = mysqli_real_escape_string($connection, trim($_POST['contact']));
  $birthday = mysqli_real_escape_string($connection, trim($_POST['birthday']));
  $BI = mysqli_real_escape_string($connection, trim($_POST['BI']));
  $date = getCurrentDate();

  $update_responsible = updateData(
    $connection,
    "UPDATE tb_responsibles SET name_r=?, city_r=?, neighborhood_r=?, birthday_r=?, gender_r=?, contact_r=?, dateModification_r=? WHERE id_r=?",
    [$name, $city, $neighborhood, $birthday, $gender, $contact, $date, $_SESSION['responsible_id']]
  );

  $user_data = getData($connection, "SELECT userID_r FROM tb_responsibles WHERE id_r = ?", [$_SESSION['responsible_id']])[0];
  $user_id = $user_data['userID_r'];

  $update_user = updateData(
    $connection,
    "UPDATE tb_users SET name_u =?, dateModification_u =? WHERE id_u =?",
    [$name, $date, $user_id]
  );

  if ($update_responsible && $update_user) {
    setMessage("responsible-message", "alert-success", "Dados actualizado com sucesso!");
    header('Location: menu-responsibles.php');
  } else {
    setMessage("responsible-message", "alert-danger", "Erro ao actualizar!");
  }
}
?>