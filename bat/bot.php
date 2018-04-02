<?php
//exec('caja.vbs');
//header('Location: ../index.php');
//echo $PATH;
//exec('"C:\Program Files (x86)\UiPath Studio\UiRobot.exe" /file:"C:\ProgramData\UiPath\Projects\caja_folde.1.0.6443.24506\lib\net45\Main.xaml"');
session_start();

if (isset($_GET['modo']) and isset($_GET['id'])) {
    $modo = isset($_GET['modo']) ? $_GET['modo'] : 0;
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
}
elseif (isset($_POST['modo'])){
    $modo = isset($_POST['modo']) ? $_POST['modo'] : 0;
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
}


require_once "../bbdd/modelo.php";
if ($modo == 1)
{
    shell_exec("c:/rpa/".$id ."/bot.vbs");
    sleep(3);
    $query = $db->query("SELECT MAX(id) as id FROM rpa_process_work where id_rpa_process = '".$id."' and user_start = '". $_SESSION['id_persona']."' ");
    $row = $db->mostrar($query);
    $query->close();
   $_SESSION['bot']=$row['id'];
    echo json_encode($_SESSION['bot']);

}
elseif ($modo == 0) {
    $hoy =date("Y-m-d H:i:s");
    $comentario="Se ha cancelado el proceso por el usuario: ".$_SESSION['id'];
    shell_exec( "c:/rpa/stop.vbs");
    $db->query("update rpa_process_work  set finalizado_ok = 0, fh_stop = '".$hoy ."' where  id = '".$_SESSION['bot']."'");
    $db->query("INSERT rpa_process_work_sequence set id_rpa_process_work = '".$_SESSION['bot']."' , comment = '".$comentario."' , add_date = '".$hoy ."'");
    $ot=$_SESSION['bot'];
    $_SESSION['bot']=0;
    echo json_encode($ot);
}
else
{
    echo json_encode($modo);
}





