<?php

require_once "../../model/modelBD.php";
/**
 *Operaciones para generar una jornada virtual
 */

class loginOperation
{
    public $modelGenerate;
    public function __construct()
    {
        $this->modelGenerate = new modelBD();
    }

    public function signIn($user, $pass)
    {

        $userValidate = $this->getVatlidationUser($user, md5($pass));

        if (isset($userValidate[0]['id'])) {
            if ($userValidate[0]['activo'] == 1) {
                $token = $this->createToken();
                $tokenInsert =  $this->insertToken($token, $userValidate[0]['id']);
                $responseInsertToken = $tokenInsert['response'];
                if ($responseInsertToken == 'ok') {
                    $_SESSION['token'] = $token;
                    return $response = array(
                        'response' => "ok",
                        'message' => "Acceso Correcto"
                    );
                } else {
                    return $tokenInsert;
                }
            } else {
                return $response = array(
                    'response' => "error",
                    'message'  => "El usuario no se encuentra activo"
                );
            }
        } else {
            return $response = array(
                'response' => "error",
                'message'  => "El usuario o contraseña es incorrecto"
            );
        }
    }

    public function logut($token)
    {
        $idUsuario = $this->modelGenerate->getIDUser($token);
        return $this->updateStatusToken($token, $idUsuario);
    }


    public function updateStatusToken($token, $userID)
    {
        $campos = 'status,fecha_cierre_session';
        $valor  = array(0, date('Y-m-d H:i:s'));
        $condicion = 'token = "' . $token . '" AND  id_usuarios= ' . $userID . '';
        $updateDatos =   $this->modelGenerate->updateDate('token', $campos, $valor, $condicion);
        if ($updateDatos) {
            session_destroy();
            return array(
                "response"   => "ok",
                "message"    => "Se cerro correctamente la session"
            );
        } else {
            return array(
                "response"   => "error",
                "message"    => "La session no se cerro correctamente"
            );
        }
    }

    public function createToken()
    {
        $token = md5(rand(0, 9) . rand(0, 9) . date("YmdHis"));
        return $token;
    }

    public function getVatlidationUser($user, $pass)
    {

        $query = "SELECT id,activo FROM usuarios WHERE email = '" . $user . "' and  password = '" . $pass . "'";
        $datosSession =     $this->modelGenerate->viewData($query);
        return $datosSession;
    }

    public function  getRegistro($email, $nombre, $apellido_paterno, $apellido_materno, $password_new)
    {
        $query = "SELECT  email FROM `usuarios` WHERE email = '" . $email . "'";
        $datosSession =     $this->modelGenerate->viewData($query);
        if (!empty($datosSession)) {
            return array(
                "response"       => "error",
                "message"        => "El correo electronico ya se encuentra registrado",
            );
        } else {
            $campos               = 'email,nombre,apellido_paterno,apellido_materno,password';
            $tabla                = 'usuarios';
            $datosNuevos         =  array($email, $nombre, $apellido_paterno, $apellido_materno, md5($password_new));
            $saveDatos =  $this->modelGenerate->insertDate($tabla, $campos, $datosNuevos);
            if ($saveDatos) {
                return array(
                    "response"       => "ok",
                    "message"        => "El Usuario se Registro Correctamente",
                );
            } else {
                return array(
                    "response"       => "error",
                    "message"        => "El Usuario No Se Registro Correctamente",
                );
            }
        }
    }


    public function changeUpdate($token, $password_verification, $password_new_change)
    {
        $datosUsuarios = $this->getDatosUsuarioGeneral($token);
        $password      = $datosUsuarios[0]['password'];
        $idUsuario     = $datosUsuarios[0]['idUsuario'];
        if ($password == $password_verification) {
            $condcionVal = 'id = ' . $idUsuario . '';
            $camposUpdateVal     = 'password,update_register';
            $valoresUpdateVal     = array($password_new_change, date('Y-m-d H:i:s'));
            $updateSession = $this->modelGenerate->updateDate('usuarios', $camposUpdateVal, $valoresUpdateVal, $condcionVal);
            if ($updateSession) {
                $this->updateStatusToken($token, $idUsuario);
                return array(
                    "response"       => "ok",
                    "message"        => "La Contraseña se actualizo correctamente",
                );
            } else {
                return array(
                    "response"       => "error",
                    "message"        => "La Contraseña no se actualizo correctamente",
                );
            }
        } else {
            return array(
                "response"       => "error",
                "message"        => "La Contraseña no coincide con la actual",
            );
        }
    }

    public function getDatosUsuario($token)
    {
        $query = "SELECT usuarios.nombre as nombrecompleto,usuarios.id as idUsuario,usuarios.password FROM `usuarios` INNER JOIN token ON usuarios.id = token.id_usuarios WHERE token = '" . $token . "' LIMIT 1 ";
        $datosSession =     $this->modelGenerate->viewData($query);
        if (!empty($datosSession)) {
            return array(
                "response"       => "ok",
                "message"        => "La informacion se muestra correctamente",
                "nombreUsuario"  => $datosSession[0]['nombrecompleto']
            );
        } else {
            return  array(
                "response"       => "error",
                "message"        => "La informacion no se muestra correctamente",
                "nombreUsuario"  => ""
            );
        }
    }


    public function getDatosUsuarioGeneral($token)
    {
        $query = "SELECT usuarios.nombre as nombrecompleto,usuarios.id as idUsuario,usuarios.password FROM `usuarios` INNER JOIN token ON usuarios.id = token.id_usuarios WHERE token = '" . $token . "' LIMIT 1 ";
        return  $datosSession =     $this->modelGenerate->viewData($query);
    }


    public function insertToken($token, $userID)
    {
        $campos = 'token,id_usuarios,fecha_inicio_conexion,status';
        $datos  =  array($token, $userID, date('Y-m-d H:i:s'), 1);
        $tabla  = 'token';
        $saveDatos =  $this->modelGenerate->insertDate($tabla, $campos, $datos);
        if ($saveDatos) {
            return array(
                "response"   => "ok",
                "message"    => "El token se inserto correctamente"
            );
        } else {
            return array(
                "response"  => "error",
                "message"   => "El inicio de session no pudo completarse"
            );
        }
    }
}
