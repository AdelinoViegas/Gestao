<?php 
try{
  $nome_servidor = "localhost";
  $nome_usuario = "root";
  $palavra_passe = "";
  $nome_banco_dados = "sg";

  $connection = mysqli_connect($nome_servidor,
  $nome_usuario,$palavra_passe,$nome_banco_dados);

  if(!$connection)
   throw new Exception("Falha ao se conectar". mysqli_connect_error());
   
   mysqli_set_charset($connection,'utf8');
  }catch(Exception $error){
  echo "Erro: ". $error->getMessage();
}
?>