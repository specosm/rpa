<?php
/**
 * Created by PhpStorm.
 * User: jortegau
 * Date: 26/01/2018
 * Time: 14:45
 */
include "rpaProcessAdminClassImpl.php";
class rpaProcessAdminClass implements rpaProcessAdminClassImpl
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
        $stop = $db->query("SELECT * FROM rpa_process_work where id = '".$_SESSION['bot']."'");
        $ro=$db->mostrar($stop);
        $stop->close();
        if ($ro['finalizado_ok']!="")
        {
            $_SESSION['bot']=0;
        }
        $filtro='';
        $filtro.=' ORDER BY rpa_process.id_rpa DESC ';
        if ($this->getPage() != 1) $start = ($this->getPage()-1) * $this->getPerPage();
        else $start=0;

        $select = $db->query("SELECT DISTINCT rpa_process.id_rpa,rpa_process.name,rpa_process.description,rpa_process.enabled,rpa_process.version_comments,rpa_process.version,rpa_process.add_date,rpa_process.add_user,rpa_process.id FROM rpa_process,rpa_process_user,user WHERE rpa_process_user.id_user=user.id and rpa_process.id_rpa=rpa_process_user.id_rpa_process and (rpa_process_user.id_user= '".$_SESSION['id']."' or user.admon!='S') $filtro LIMIT $start, $this->per_page "); // Select article list from $start

        $numArticles = $db->query("SELECT rpa_process.id FROM rpa_process,rpa_process_user,user WHERE rpa_process_user.id_user=user.id and rpa_process.id_rpa=rpa_process_user.id_rpa_process and (rpa_process_user.id_user= '".$_SESSION['id']."' or user.admon!='S')  $filtro"); // Total number of articles in the database
        $num = $db->row_num($numArticles);
        $numPage = ceil($num / $this->getPerPage()); // Total number of page

        // We build the article list
        $articleList = '';
        while( $result = $select->fetch_array(MYSQLI_ASSOC) ) {

            $articleList .= ' <tr>
            <td class="text-left"><a  id="id">' .$result['id_rpa'].'</a></td> 
            <td class="text-left"><a >' . $result['name'] . '</a></td> 
            <td class="text-left"><a >' . $result['description'] . '</a></td> 
            <td class="text-left"><a >' . $result['enabled'] . '</a></td> 
            <td class="text-left"><a >' . $result['version'] . '</a></td> 
            <td class="text-left"><a >' .$result['version_comments'] . '</a></td> 
            <td class="text-left"><a >' .date('Y-m-d', strtotime($result['add_date'])) . '</a></td> 
            <td class="text-left"><a >' .$result['add_user'] . '</a></td>';
            $articleList .= '<td><button onclick="identificador(' .$result['id_rpa'].',1)" type="button" class="btn btn-outline-success waves-effect"';

            if($result['enabled'] == 0) {
                $articleList .= 'disabled';
            }
            $articleList .= '>Start</button></td>';

             $articleList .= '<td><button  onclick="identificador(0,0)" type="button" class="btn btn-outline-danger waves-effect"  ';
                if($ro['id_rpa_process'] != $result['id_rpa']) {
                        $articleList .= 'disabled';
                }
                $articleList .='>Stop</button></td>';
                $articleList .='</tr>';
        }


        // We send back the total number of page and the article list
        echo json_encode( array('numPage' => $numPage, 'articleList' => $articleList));

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