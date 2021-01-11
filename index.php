<?php

include         'aplication/operation.php';
$operations      =   new operation();
$connect        = $operations->isConnected();
if ($connect) {
   $template       =  !isset($_GET['tpl']) ? 'template/datos/informationDatos.html' : $operations->viewTemplate($_GET['tpl']);
   require_once './template/index.html';
} else {
   require_once './template/login.html';
}
