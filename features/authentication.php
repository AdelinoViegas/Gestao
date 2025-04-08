<?php

function authentication($conection, $sql, $route, $idUser, $user_painel){
  $consult = mysqli_prepare($conection,$sql);
  mysqli_stmt_bind_param($consult,"s",$idUser);
  mysqli_stmt_execute($consult);
  $user = mysqli_fetch_assoc(mysqli_stmt_get_result($consult)); 
  $_SESSION['logado'] = true;
  if($user_painel === "professor"){
    $_SESSION['teacher_id'] = $user['id_p'];
    $_SESSION['teacher_name'] = $user['nome_p'];
  }elseif($user_painel === "encarregado"){
    $_SESSION['responsible_id'] = $user['id_e'];
    $_SESSION['responsible_name'] = $user['nome_e'];
  }elseif($user_painel === "aluno"){
    $_SESSION['student_id'] = $user['id_a'];
    $_SESSION['student_name'] = $user['nome_a'];
  }

  header($route);
}
?>