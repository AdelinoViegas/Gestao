<?php
function signData($connection, $sql, $params){
  try{
    $query = mysqli_prepare($connection, $sql);
    $types = str_repeat("s", count($params)); 

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
  }
}
?>