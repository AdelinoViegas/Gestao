<?php
function getData($conection, $sql){
  $count = 0;
  $array_data = [];
  $query = mysqli_prepare($conection, $sql);
  mysqli_stmt_execute($query);
  $result = mysqli_stmt_get_result($query);

  while($data = mysqli_fetch_assoc($result)){
    $array_data[$count]  = $data;
    $count++;
  }

  return count($array_data) > 1 ? $array_data : $array_data[0];
}
?>