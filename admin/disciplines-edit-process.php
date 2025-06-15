<?php
session_start();
require_once "../connection.php";
require_once "../features/updateData.php";
require_once "../features/setMessage.php";

if (isset($_POST['btn-update'])) {
  $discipline_id = $_SESSION['discipline_id'];
  $name = $_POST['name'];
}

$update_discipline = updateData(
  $connection,
  "UPDATE tb_disciplines SET name_d =? WHERE id_d =?",
  [$name, $discipline_id]
);

if ($update_discipline) {
  setMessage("discipline-message", "alert-success", "Dados actualizado com sucesso!");
  header('Location: menu-disciplines.php');
} else {
  setMessage("discipline-message", "alert-danger", "Erro ao actualizar!");
}
?>