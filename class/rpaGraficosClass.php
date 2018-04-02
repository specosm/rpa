<?php
/**
 * Created by PhpStorm.
 * User: jortegau
 * Date: 26/01/2018
 * Time: 14:45
 */
include "rpaGraficosClassImpl.php";
class rpaGraficosClass implements rpaGraficosClassImpl
{
    public $id;
    public $nombre;
    public $descripcion;
    public $enable;
    public $fecha;
    public $version;
    public $version_txt;
    public $add_user;
    private $page;
    private $per_page;
    public $id_robot;

    /**
     * rpaGraficosClass constructor.
     * @param $id
     * @param $nombre
     * @param $descripcion
     * @param $enable
     * @param $fecha
     * @param $version
     * @param $version_txt
     * @param $add_user
     * @param $page
     * @param $per_page
     * @param $id_robot
     */
    public function __construct($id, $nombre, $descripcion, $enable, $fecha, $version, $version_txt, $add_user, $page, $per_page, $id_robot)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->enable = $enable;
        $this->fecha = $fecha;
        $this->version = $version;
        $this->version_txt = $version_txt;
        $this->add_user = $add_user;
        $this->page = $page;
        $this->per_page = $per_page;
        $this->id_robot = $id_robot;
    }

    public function paginador()
    {

        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $filtro='';
        $filtro.=' ORDER BY rpa_process.id ASC ';
        $i=0;

        if ($this->getPage() != 1) $start = ($this->getPage()-1) * $this->getPerPage();
        else $start=0;

        $select = $db->query("SELECT DISTINCT rpa_process.id_rpa,rpa_process.name,rpa_process.description,rpa_process.enabled,rpa_process.version_comments,rpa_process.add_date,rpa_process.add_user,rpa_process.id FROM rpa_process,rpa_process_user,user WHERE rpa_process_user.id_user=user.id and rpa_process.id_rpa=rpa_process_user.id_rpa_process and (rpa_process_user.id_user= '".$_SESSION['id']."' or user.admon!='S') $filtro LIMIT $start, $this->per_page "); // Select article list from $start

        $numArticles = $db->query("SELECT rpa_process.id FROM rpa_process,rpa_process_user,user WHERE rpa_process_user.id_user=user.id and rpa_process.id_rpa=rpa_process_user.id_rpa_process and (rpa_process_user.id_user= '".$_SESSION['id']."' or user.admon!='S')  $filtro"); // Total number of articles in the database
        $num = $db->row_num($numArticles);
        $numPage = ceil($num / $this->getPerPage()); // Total number of page

        // We build the article list
        $articleList = '';
        while( $result = $select->fetch_array(MYSQLI_ASSOC) ) {
            $colores[$i]="rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).",".random_int(0,255).")";
            $referencia[$i]=$result['id_rpa']." - ".$result['name'];
            $query = $db->query("SELECT COUNT(rpa_process_work.id_rpa_process) as id_final FROM rpa_process_work WHERE rpa_process_work.id_rpa_process ='".$result['id_rpa']."'");
            while($row_query=$query->fetch_array(MYSQLI_ASSOC)){
                $array_color[$i]=$row_query['id_final'];

            }
            $i++;
            $articleList .= ' <tr>
            <td class="text-left"><a  id="id">' .$result['id_rpa'].'</a></td> 
            <td class="text-left"><a >' . $result['name'] . '</a></td> 
            <td class="text-left"><a >' . $result['description'] . '</a></td> 
            <td class="text-left"><a >' .date('Y-m-d', strtotime($result['add_date'])) . '</a></td> 
            <td class="text-center"><a onclick="verGraficos('.$result['id_rpa'].')"><i class="fa fa-bar-chart-o fa-2x" aria-hidden="true"></i> </a></td> 
            
            </tr>';
        }

        $array_num=count($array_color);
        for($i=0;$i<$array_num;++$i)
        {
            $referencia[$i]=$referencia[$i].' ['. $array_color[$i].']';
        }
        // We send back the total number of page and the article list
        echo json_encode( array('articleList' => $articleList,"a" => $colores,'numPage' => $numPage, "b" => $array_color, "c" => $referencia));

    }

    public function GraficoEstadoTiempo()
    {
        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $i=0;
        $numero = $db->query("SELECT DISTINCT DATE_FORMAT(fh_start,'%d-%m-%Y') as fecha,reference as nombre, id_rpa_process as id  FROM rpa_process_work WHERE rpa_process_work.id_rpa_process='".$_POST['id_rpa']."' ORDER BY id_rpa_process");
        while($row_numero=$numero->fetch_array(MYSQLI_ASSOC)){
            $referencia[$i]=$row_numero['fecha'];
            $nombre= $row_numero['id']."-".$row_numero['nombre'];
            $query = $db->query("SELECT SUM(CASE WHEN finalizado_ok=1 THEN 1 ELSE 0 END) AS ok,SUM(CASE WHEN finalizado_ok=0 THEN 1 ELSE 0 END) AS ko ,SUM(CASE WHEN isnull(finalizado_ok) THEN 1 ELSE 0 END) AS otro FROM rpa_process_work WHERE DATE_FORMAT(fh_start,'%d-%m-%Y') = '".$row_numero['fecha']."' ORDER BY id_rpa_process");
            $row_query=$query->fetch_array(MYSQLI_ASSOC);
            $array_ok[$i]=$row_query['ok'];
            $array_ko[$i]=$row_query['ko'];
            $array_otro[$i]=$row_query['otro'];
            $i++;
        }



        echo json_encode(array("e" => $nombre,"d" => $array_otro,"c" => $array_ko, "b" => $array_ok, "a" => $referencia));
    }

    public function informeGraficoEstadoTiempo()
    {
        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $i=0;
        $sumaTiempo=0;
        $numero = $db->query("SELECT DISTINCT rpa_process_work.reference as nombre, TIME_TO_SEC(rpa_process_work_tiempo.dataTotal) as fecha, rpa_process_work_tiempo.actividad , rpa_process_work_tiempo.id_rpa_process_work_tiempo as id  FROM rpa_process_work_tiempo,rpa_process_work WHERE rpa_process_work_tiempo.id_rpa_process_work_tiempo=rpa_process_work.id and rpa_process_work_tiempo.id_rpa_process_work_tiempo='".$_POST['id_rpa']."' ORDER BY rpa_process_work_tiempo.id ASC");
        while($row_numero=$numero->fetch_array(MYSQLI_ASSOC)){
            $nombre=$row_numero['nombre'];
            $referencia[$i]=$row_numero['actividad'];
            $sumaTiempo=$sumaTiempo+$row_numero['fecha'];
            $tiempo[$i]=$row_numero['fecha'];
            $i++;
        }

        array_push($referencia, "Tiempo Total");
        array_push($tiempo, $sumaTiempo);


        echo json_encode(array("b" =>$tiempo, "a" => $referencia,"c"=>$nombre,"d"=>$sumaTiempo));
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * @param mixed $enable
     */
    public function setEnable($enable): void
    {
        $this->enable = $enable;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version): void
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getVersionTxt()
    {
        return $this->version_txt;
    }

    /**
     * @param mixed $version_txt
     */
    public function setVersionTxt($version_txt): void
    {
        $this->version_txt = $version_txt;
    }

    /**
     * @return mixed
     */
    public function getAddUser()
    {
        return $this->add_user;
    }

    /**
     * @param mixed $add_user
     */
    public function setAddUser($add_user): void
    {
        $this->add_user = $add_user;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page): void
    {
        $this->page = $page;
    }

    /**
     * @return mixed
     */
    public function getPerPage()
    {
        return $this->per_page;
    }

    /**
     * @param mixed $per_page
     */
    public function setPerPage($per_page): void
    {
        $this->per_page = $per_page;
    }

    /**
     * @return mixed
     */
    public function getIdRobot()
    {
        return $this->id_robot;
    }

    /**
     * @param mixed $id_robot
     */
    public function setIdRobot($id_robot): void
    {
        $this->id_robot = $id_robot;
    }


}