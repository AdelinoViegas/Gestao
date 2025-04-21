<?php
session_start();
require_once "connection.php";
require_once "features/getCurrentDate.php";
require_once "features/getData.php";
require_once "features/setMessage.php";
require_once "features/updateData.php";

$responsible_id = $_SESSION['responsible_id'];
$nome = $_POST['name'];
$municipio = $_POST['city'];
$bairro = $_POST['neighborhood'];
$sexo = $_POST['gender'];
$contato = $_POST['contact'];
$date = getCurrentDate();

$update_responsible = updateData(
  $connection,
  "UPDATE sg_encarregado SET nome_e=?, municipio_e=?, bairro_e=?, sexo_e=?, contato_e=?, dataModificacao_e=? WHERE id_e=?",
  [$name, $city, $neighborhood, $gender, $contact, $date, $responsible_id]
);

$user_data = getData($connection, "SELECT idUsuario FROM sg_encarregado WHERE id_e = ?", [$responsible_id]);
$user_id = $user_data['idUsuario'];

$update_user = updateData(
  $connection,
  "UPDATE sg_usuarios SET nome_u =?, dataModificacao_u =? WHERE id_u =?",
  [$name, $date, $user_id]
);

if ($update_responsible && $update_user) {
  setMessage("responsible-message", "alert-success", "Dados actualizado com sucesso!");
  header('Location: menu-encarregados.php');

} else {
  setMessage("responsible-message", "alert-danger", "Erro ao actualizar!");
}
?>