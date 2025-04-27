<?php
function getData($connection, $sql, $params = []){
  $count = 0;
  $array_data = [];
  $types = "";

  if(count($params)){
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
    $result = mysqli_stmt_get_result($query);
  }else{
    $query = mysqli_prepare($connection, $sql);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
  }

  while($data = mysqli_fetch_assoc($result)){
    $array_data[$count]  = $data;
    $count++;
  }

  return $array_data;
}
?>