<?php

require_once "../../bbdd/conexion.php";
$modo=isset($_GET['modo']) ? $_GET['modo']  : 'default';
switch($modo){
    case 'login':
    {
        if(isset($_POST['login']) )
        {

            if(!empty($_POST['codigo']) and !empty($_POST['pass']))
            {

                include('acceso.php');
                $acceso=new acceso($_POST['codigo'],md5($_POST['pass']),'');
                $acceso->login();
            }
            else
            {

                header('location:index.php');
            }
        }
        else
        {

            header('location:index.php');
        }

    }
        break;


}


