<?php
require_once "connection.php";
require_once "features/updateData.php";
require_once "features/setMessage.php";
session_start();

if (isset($_POST['btn-update'])) {
  $discipline_id = $_SESSION['discipline_id'];
  $name = $_POST['name'];
}

$update_discipline = updateData(
  $connection,
  "UPDATE sg_disciplina SET nome_d =? WHERE id_d =?",
  [$name, $discipline_id]
);

if ($update_discipline) {
  setMessage("discipline-message", "alert-success", "Dados actualizado com sucesso!");
  header('Location: menu-disciplinas.php');

} else {
  setMessage("discipline-message", "alert-danger", "Erro ao actualizar!");
}
?>