<?php 
try{
  $connection = mysqli_connect("localhost", "root", "", "sg");

  if(!$connection)
   throw new Exception("Falha ao se conectar". mysqli_connect_error());
   
   mysqli_set_charset($connection,'utf8');
  }catch(Exception $error){
  echo "Erro: ". $error->getMessage();
}
?>