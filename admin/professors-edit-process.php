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
      "UPDATE sg_professor SET nome_p=? , email_p=?, municipio_p=?, bairro_p=?, sexo_p=?, contato_p=?, nascimento_p=?, numeroBI_p=?, dataModificacao_p=? WHERE id_p=?",
      [$name, $email, $city, $neighborhood, $gender, $contact, $birthday, $BI, $date, $_SESSION['professor_id']]
   ); 

   $user_data = getData($connection, "SELECT idUsuario FROM sg_professor WHERE id_p = ?", [$_SESSION['professor_id']]);
   $user_id = $user_data['idUsuario'];

   $update_user = updateData(
      $connection, 
      "UPDATE sg_usuarios SET nome_u =?, dataModificacao_u =? WHERE id_u =?",
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