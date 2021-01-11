<?php
include         '../../aplication/operation.php';
include         '../operationController/loginOperation.php';

$operations =   new operation();
$operationController = new loginOperation();
$option           = $operations->getVarPost('option');

switch ($option) {
        //Login
    case 1:
        $user             = $operations->getVarPost('user');
        $pass             = $operations->getVarPost('pass');
        $sigInUser        = $operationController->signIn($user, $pass);
        echo  json_encode($sigInUser);
        break;


    case 2:
        $token    = $operations->getVarSession();
        $logut    = $operationController->logut($token);
        echo json_encode($logut);
        break;
    default:
        echo json_encode(array(
            "response"   => "error",
            "message"    => "Error en el servidor de sessiones"
        ));

        break;

    case 3:
        $token = $operations->getVarSession();
        $datosUsuario  = $operationController->getDatosUsuario($token);
        echo json_encode($datosUsuario);

        break;

    case 4:
        $email             = $operations->getVarPost('email_new');
        $nombre            =  $operations->getVarPost("nombre");
        $apellido_paterno  =  $operations->getVarPost("apellido_paterno");
        $apellido_materno  =  $operations->getVarPost("apellido_materno");
        $password_new      =  $operations->getVarPost("password_new");
        $registro          = $operationController->getRegistro($email, $nombre, $apellido_paterno, $apellido_materno, $password_new);
        echo json_encode($registro);

        break;
    case  5:
        $token    = $operations->getVarSession();
        $password_verification = $operations->getVarPost('password_verification');
        $password_new_change   = $operations->getVarPost('password_new_change');

        $changePassword        = $operationController->changeUpdate($token, md5($password_verification), md5($password_new_change));
        echo json_encode($changePassword);



        break;
}
