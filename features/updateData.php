<?php
function updateData($connection, $sql, $params){
  try{
    $types = "";
    $query = mysqli_prepare($connection, $sql);
    
    foreach($params as $value){
      if(is_int($value)){
        $types .= "i";
      }elseif(is_float($value)){
        $types .= "f";
      }elseif(is_bool($value)){
        $types .= "b";
      }else{
        $types .= "s";
      }
    }

    $bind_names = [];
    $bind_names[] = $types; 
    foreach ($params as $key => $value) {
        $bind_names[] = &$params[$key]; 
    }

    call_user_func_array("mysqli_stmt_bind_param", array_merge([$query], $bind_names));

    mysqli_stmt_execute($query);
    mysqli_stmt_close($query);
    
    return true;
  }catch(Exception $e){
    echo "<script>console.log('Erro ao cadastrar!!')</script>";
    return false;
  }
}
?>