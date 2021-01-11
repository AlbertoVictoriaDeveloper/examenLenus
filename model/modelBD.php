<?php
require_once 'conexion.php';

class modelBD extends conexion
{

    public function viewData($query)
    {
        $result = $this->queryConsulta($query);

        if ($this->numeroFilas($result) > 0) {
            // output data of each row
            while ($row = $this->fetch_assoc($result)) {
                $dataRow[] = $row;
                // $dataRow[] = array_map('utf8_encode', $row);
            }
            return $dataRow;
        } else {
            return false;
        }
        mysqli_close($conn);
    }

    public function executeConsulta($query)
    {
        if ($result = $this->queryConsulta($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function ultimateID($idSession, $table)
    {
        // $queryConsultar =   "SELECT MAX(".$idSession.") AS id FROM ".$table.""; 
        $queryConsultar =   "select id_sesion as id from " . $table . " order by id desc LIMIT 1";
        $idUltimate = $this->viewData($queryConsultar);
        if (!empty($idUltimate[0]['id'])) {
            return $idUltimate[0]['id'];
        } else {
            return 1;
        }
    }



    public function insertDate($tabla, $cadCampos, $valor)
    {
        $tableValores = count($valor);
        $arrayCampos = explode(",", $cadCampos);
        if (count($arrayCampos) != $tableValores) {
            return  "imposible continuar el numero de columnas no coincide";
        } else {
            $valores = "";
            for ($i = 0; $i < $tableValores; $i++) {
                $valores .= "'" . addslashes($valor[$i]) . "',";
            }
            $valores = substr($valores, 0, strlen($valores) - 1);
            $query   = "INSERT INTO " . $tabla . " (" . $cadCampos . ") VALUES (" . $valores . ")";

            if ($this->executeConsulta($query)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function updateDate($tabla, $campos, $valor, $condicion)
    {
        $arrCampos = explode(",", $campos);
        $talValores = count($valor);
        $valores = "";
        for ($i = 0; $i < $talValores; $i++) {
            $valores .= $arrCampos[$i] . " = '" . addslashes($valor[$i]) . "', ";
        }
        $valores = substr($valores, 0, strlen($valores) - 1);
        $valores = substr($valores, 0, strlen($valores) - 1);
        $query = "UPDATE " . $tabla . " SET " . $valores . " Where " . $condicion;
        if ($this->executeConsulta($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function getIDUser($token)
    {
        $query = "SELECT token.id_usuarios as 'idUsuario' FROM token  WHERE  token = '" . $token . "'";
        $idUsuario  = $this->viewData($query);
        return $idUsuario[0]['idUsuario'];
    }
}
