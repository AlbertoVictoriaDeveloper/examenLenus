<?php
session_start();


class operation
{

    public function getVarPost($name)
    {
        if (isset($_POST[$name])) {
            $string  =  $_POST[$name];
            $string  =   preg_replace("[^A-Za-z0-9]", "", $string);
            return $string;
        } else {
            $variable = "";
            return $variable;
        }
    }



    public function isConnected()
    {
        if (isset($_SESSION['token'])) {

            return true;
        } else {
            return false;
        }
    }


    public function viewTemplate($template)
    {

        if ($template == 'changePassword') {
            return   $templateDinamico = 'template/cambioContrasena.html';
        }
    }




    public function getVarSession()
    {
        if (!empty($_SESSION['token'])) {
            return $_SESSION['token'];
        } else {
            return "";
        }
    }
}
