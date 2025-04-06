<?php 
try{
  $nome_servidor = "localhost";
  $nome_usuario = "root";
  $palavra_passe = "";
  $nome_banco_dados = "sg";

  $conection = mysqli_connect($nome_servidor,
  $nome_usuario,$palavra_passe,$nome_banco_dados);

  if(!$conection)
   throw new Exception("Falha ao se conectar". mysqli_connect_error());
   
   mysqli_set_charset($conection,'utf8');
  }catch(Exception $error){
  echo "Erro: ". $error->getMessage();
}
?>