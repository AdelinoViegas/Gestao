<?php

function setMessage($alert_name, $alert_type, $alert_message){
  $_SESSION[$alert_name] = "
    <div id='alerta-confirmar'>
    <div class='alerta-confirmar'>
    <div class='alert $alert_type alert-dimissible'>
    <button style='float:right;' class='btn-close' data-bs-dismiss='alert'></button>
    $alert_message
    </div>
    </div>
    </div>";
}
?>