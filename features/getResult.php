<?php
$count = 0;
$arr = [];

function getResult($conection, $sql){
  $query = mysqli_prepare($conection, $sql);
  mysqli_stmt_execute($query);
  $result = mysqli_stmt_get_result($query);

  while($data = mysqli_fetch_assoc($result)){
    $count++;
    $arr[$count]  = $data;
  }

  return $arr;
}
?>