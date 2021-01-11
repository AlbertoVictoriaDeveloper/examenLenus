<?php
class conexion
{
    protected $conexion;

    public function __construct()
    {
        $this->server = $_SERVER['HTTP_HOST'];
    }

    public function connectionBD()
    {

        if ($this->server == "localhost") {
            $username   = 'root';
            $servername = 'localhost';
            $password   = '';
            $dbname     = 'test_exam';
        } else {
            /**Si existiera una conexion remota */
        }


        $this->conexion = mysqli_connect($servername, $username, $password, $dbname);
        if (!$this->conexion) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $this->conexion;
    }

    public function queryConsulta($queryConsultar)
    {
        $query = mysqli_query($this->connectionBD(), $queryConsultar);
        if (!$query) {
            return false;
        }
        return $query;
    }

    public function numeroFilas($result)
    {

        return mysqli_num_rows($result);
    }

    public function fetch_assoc($result)
    {

        return mysqli_fetch_assoc($result);
    }

    /*public function ultimoID($nameID,$table)
    {
    
      $query = mysqli_query($this->connectionBD(), $queryConsultar);
      if (!$query) {
          return false;
      }
      return $query;
    }*/
}
