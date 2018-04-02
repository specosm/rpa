<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29/08/2017
 * Time: 12:58
 */

require_once 'datos.php';
class conexion extends mysqli
{


// constructor
    public function __construct()
    {
        parent::__construct(DB_HOST,DB_USER,DB_PASS,DB_NAME);

        $this->query("SET NAMES 'utf8';");
        $this->connect_errno == true ?  die('Error con la conexion, fallo servidor'): $a="Conectado";
//echo $a;
        unset($a);
    }

    public function mostrar($recor){
        return mysqli_fetch_array($recor);

    }

    public function row_num($acceso){
        return mysqli_num_rows($acceso);

    }


}