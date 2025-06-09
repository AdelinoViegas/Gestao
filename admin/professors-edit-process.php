<?php 
session_start();
require_once "../connection.php";
require_once "../features/getCurrentDate.php";
require_once "../features/getData.php";
require_once "../features/setMessage.php";
require_once "../features/updateData.php";

if(isset($_POST['btn-update'])){
  $name = mysqli_real_escape_string($connection, trim($_POST['name']));
  $email = mysqli_real_escape_string($connection, trim($_POST['email']));
  $city = mysqli_real_escape_string($connection, trim($_POST['city']));
  $neighborhood = mysqli_real_escape_string($connection, trim($_POST['neighborhood']));
  $gender = mysqli_real_escape_string($connection, trim($_POST['gender']));
  $contact = mysqli_real_escape_string($connection, trim($_POST['contact']));
  $birthday = mysqli_real_escape_string($connection, trim($_POST['birthday']));
  $BI = mysqli_real_escape_string($connection, trim($_POST['BI']));
  $date = getCurrentDate();

  $update_professor = updateData(
    $connection, 
    "UPDATE tb_professors SET name_p=? , email_p=?, city_p=?, neighborhood_p=?, gender_p=?, contact_p=?, birthday_p=?, BI_p=?, dateModification_p=? WHERE id_p=?",
    [$name, $email, $city, $neighborhood, $gender, $contact, $birthday, $BI, $date, $_SESSION['professor_id']]
  ); 

  $user_data = getData($connection, "SELECT userID_p FROM tb_professors WHERE id_p = ?", [$_SESSION['professor_id']])[0];
  $user_id = $user_data['userID_p'];

  $update_user = updateData(
    $connection, 
    "UPDATE tb_users SET name_u =?, dateModification_u =? WHERE id_u =?",
    [$name, $date, $user_id]
  );   
   
  if($update_professor && $update_user){
    setMessage("professor-message", "alert-success", "Dados actualizado com sucesso!");
    header('Location: menu-professors.php');
  }else{
    setMessage("professor-message", "alert-danger", "Erro ao actualizar!");
  }
}
?>