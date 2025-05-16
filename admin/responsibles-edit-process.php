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
    "UPDATE sg_encarregado SET nome_e=?, municipio_e=?, bairro_e=?, nascimento_e=?, sexo_e=?, contato_e=?, dataModificacao_e=? WHERE id_e=?",
    [$name, $city, $neighborhood, $birthday, $gender, $contact, $date, $_SESSION['responsible_id']]
  );

  $user_data = getData($connection, "SELECT idUsuario FROM sg_encarregado WHERE id_e = ?", [$_SESSION['responsible_id']]);
  $user_id = $user_data['idUsuario'];

  $update_user = updateData(
    $connection,
    "UPDATE sg_usuarios SET nome_u =?, dataModificacao_u =? WHERE id_u =?",
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