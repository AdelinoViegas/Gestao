<?php
session_start();
require_once "../connection.php";
require_once "../features/getCurrentDate.php";
require_once "../features/getData.php";
require_once "../features/setMessage.php";
require_once "../features/updateData.php";

if (isset($_POST['btn-update'])) {
  $student_id = $_SESSION['student_id'];
  $student_group = mysqli_real_escape_string($connection, trim($_POST['group']));
  $student_class = mysqli_real_escape_string($connection, trim($_POST['class']));
  $name = mysqli_real_escape_string($connection, trim($_POST['name']));
  $city = mysqli_real_escape_string($connection, trim($_POST['city']));
  $neighborhood = mysqli_real_escape_string($connection, trim($_POST['neighborhood']));
  $gender = mysqli_real_escape_string($connection, trim($_POST['gender']));
  $contact = mysqli_real_escape_string($connection, trim($_POST['contact']));
  $birthday = mysqli_real_escape_string($connection, trim($_POST['birthday']));
  $BI = mysqli_real_escape_string($connection, trim($_POST['BI']));
  $date = getCurrentDate();

  $update_student = updateData(
    $connection,
    "UPDATE tb_students SET name_s=?, groupID_s=?, classID_s=?, city_s=?, neighborhood_s=?, gender_s=?, contact_s=?, birthday_s=?, BI_s=?, dateModification_s=? WHERE id_s=?",
    [$name, $student_group, $student_class, $city, $neighborhood, $gender, $contact, $birthday, $BI, $date, $student_id]
  );

  $student_data = getData($connection, "SELECT userID_s FROM tb_students WHERE id_s = ?", [$student_id])[0];
  $user_id = $student_data['idUsuario'];

  $update_user = updateData(
    $connection,
    "UPDATE tb_users SET name_u =?, dateModification_u = ? WHERE id_u =?",
    [$name, $date, $student_id]
  );

  if ($update_student && $update_user) {
    setMessage("student-message", "alert-success", "Dados actualizado com sucesso!");
    header('Location: menu-students.php');
  } else {
    setMessage("student-message", "alert-danger", "Erro ao actualizar!");
  }
}
?>