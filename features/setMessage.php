<?php

function setMessage($type, $message){
  $_SESSION['Configured-Message'] = "
    <div id='alerta-confirmar'>
    <div class='alerta-confirmar'>
    <div class='alert $type alert-dimissible'>
    <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
    $message
    </div>
    </div>
    </div>";
}
?>