<?php
require_once "conexao.php";
session_start();

$id = $_POST['idUsuario'];
$estado = $_POST['estadoU'];

if (isset($_POST['chamada1'])) {
	if ($estado === 'activo') {
		$sql = "UPDATE sg_usuarios SET estado_u = 'inactivo' WHERE id_u = '$id'";
		$consulta = mysqli_query($conexao, $sql);
		header('Location: menu-usuarios.php');

	} else {
		$sql = "UPDATE sg_usuarios SET estado_u = 'activo' WHERE id_u = '$id'";
		$consulta = mysqli_query($conexao, $sql);
		header('Location: menu-usuarios.php');
	}

} else {
	if ($estado === 'activo') {

		$sql = "UPDATE sg_usuarios SET estado_u = 'inactivo' WHERE id_u = '$id'";
		$consulta = mysqli_query($conexao, $sql);
		header('Location: usuario-pesquisar.php');

	} else {
		$sql = "UPDATE sg_usuarios SET estado_u = 'activo' WHERE id_u = '$id'";
		$consulta = mysqli_query($conexao, $sql);
		header('Location: usuario-pesquisar.php');
	}
}

?>