<?php
function getData($connection, $sql, $params = []){
  if(count($params) === 1){
    $query = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($query, "s",$params[0]);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    return mysqli_fetch_assoc($result) ?? [];
  }

  $count = 0;
  $array_data = [];
  $query = mysqli_prepare($connection, $sql);
  mysqli_stmt_execute($query);
  $result = mysqli_stmt_get_result($query);

  while($data = mysqli_fetch_assoc($result)){
    $array_data[$count]  = $data;
    $count++;
  }

  return $array_data;
}
?>