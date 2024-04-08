<?php 

/*Utilizando o mysqli para conectar ao banco de dados*/

$nome_servidor = "localhost";
$nome_usuario = "root";
$palavra_passe = "";
$nome_banco_dados = "sg";

$conexao = mysqli_connect($nome_servidor,
$nome_usuario,$palavra_passe,$nome_banco_dados);
mysqli_set_charset($conexao,'utf8');


/*Utilizando o PDO para conectar ao banco de dados*/

$data_mysql = "mysql:host=127.0.0.1;dbname=sg;charset=utf8";
$user = "root";
$password = "";

$ligation = new PDO($data_mysql,$user,$password);

 ?>