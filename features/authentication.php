<?php

function authentication($conection, $sql, $route, $idUser, $user_painel){
  $consult = mysqli_prepare($conection,$sql);
  mysqli_stmt_bind_param($consult,"s",$idUser);
  mysqli_stmt_execute($consult);
  $user = mysqli_fetch_assoc(mysqli_stmt_get_result($consult)); 
  $_SESSION['logged'] = true;

  if($user_painel === "professor")
    $_SESSION['professor_id'] = $user['id_p'];
  elseif($user_painel === "encarregado")
    $_SESSION['responsible_id'] = $user['id_r'];
  elseif($user_painel === "aluno")
    $_SESSION['student_id'] = $user['id_s'];

  header($route);
}
?>