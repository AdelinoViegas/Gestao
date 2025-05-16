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
    "UPDATE sg_aluno SET nome_a=?, idTurma_a=?, idClasse=?, municipio_a=?, bairro_a=?, sexo_a=?, contato_a=?, nascimento_a=?, numeroBI_a=?, dataModificacao_a=? WHERE id_a=?",
    [$name, $student_group, $student_class, $city, $neighborhood, $gender, $contact, $birthday, $BI, $date, $student_id]
  );

  $student_data = getData($connection, "SELECT idUsuario FROM sg_aluno WHERE id_a = ?", [$student_id]);
  $user_id = $student_data['idUsuario'];

  $update_user = updateData(
    $connection,
    "UPDATE sg_usuarios SET nome_u =?, dataModificacao_u = ? WHERE id_u =?",
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