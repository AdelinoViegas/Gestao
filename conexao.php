<?php 

/*Utilizando o mysqli para conectar ao banco de dados*/

$nome_servidor = "localhost";
$nome_usuario = "root";
$palavra_passe = "";
$nome_banco_dados = "sg";

$conection = mysqli_connect($nome_servidor,
$nome_usuario,$palavra_passe,$nome_banco_dados);
mysqli_set_charset($conection,'utf8');
?>