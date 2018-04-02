<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 03/10/2017
 * Time: 9:29
 */
include 'rpaProcesUserClassIml.php';
class rpaProcesUserClass implements rpaProcesUserClassIml
{
    public $id;
    public $id_rpa_process;
    public $id_user;
    public $add_user;
    public $add_date;
    private $page;
    private $per_page;

    /**
     * rpaProcesUserClass constructor.
     * @param $id
     * @param $id_rpa_process
     * @param $id_user
     * @param $add_user
     * @param $add_date
     * @param $page
     * @param $per_page
     */
    public function __construct($id, $id_rpa_process, $id_user, $add_user, $add_date,$page, $per_page)
    {
        $this->id = $id;
        $this->id_rpa_process = $id_rpa_process;
        $this->id_user = $id_user;
        $this->add_user = $add_user;
        $this->add_date = $add_date;
        $this->page = $page;
        $this->per_page = $per_page;
    }


    public function comprobar()
    {
        $pathLocal="C:/rpa";
        $pathServidor="";
        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $query = $db->query("SELECT id_rpa_process FROM rpa_process_user WHERE  rpa_process_user.id_user='".$this->getIdUser()."'");
        while( $result = $query->fetch_array(MYSQLI_ASSOC) ) {
            foreach(glob($pathLocal,GLOB_ONLYDIR) as $file) {
                echo "filename: $file : filetype: " . filetype($file) . "<br />";
            }
        }
        return false;


    }



    public function crear()
    {

        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $query = $db->query("SELECT * FROM rpa_process_user WHERE rpa_process_user.id_rpa_process= '".$this->getIdRpaProcess()."' and rpa_process_user.id_user='".$this->getIdUser()."'");
        if ($query->num_rows>0){
            return false;
        }
        else
            {
                $ok= $db->query("INSERT rpa_process_user SET id_rpa_process= '".$this->getIdRpaProcess()."', id_user= '".$this->getIdUser()."', add_date= '".$this->getAddDate()."', add_user= '".$this->getAddUser()."'");

                if($ok){

                    return true;
                }
                else
                {
                    return false;
                }
        }

    }

    public function editar()
    {

    }

    public function eliminar()
    {

        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $ok= $db->query("DELETE FROM rpa_process_user WHERE id = '".$this->getId()."'");

        if($ok){

            return true;
        }
        else
        {
            return false;
        }
    }

    public function Paginador()
    {

        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $filtro='';
        $filtro.=' ORDER BY id ASC ';

        if ($this->getPage() != 1) $start = ($this->getPage()-1) * $this->getPerPage();
        else $start=0;

        $select = $db->query("SELECT user.first_name as nombre, user.last_name as apellido, rpa_process_user.id_rpa_process as id_rpa_process, rpa_process.name as name,
rpa_process_user.id_user as id_user, rpa_process_user.add_date as add_date, rpa_process_user.add_user as add_user,
rpa_process_user.id as id FROM rpa_process_user,rpa_process,user where rpa_process_user.id_rpa_process=rpa_process.id_rpa and rpa_process_user.id_user=user.id $filtro LIMIT $start, $this->per_page "); // Select article list from $start

        $numArticles = $db->query("SELECT id FROM rpa_process_user  $filtro"); // Total number of articles in the database
        $num = $db->row_num($numArticles);
        $numPage = ceil($num / $this->getPerPage()); // Total number of page

        $articleList = '';
        while( $result = $select->fetch_array(MYSQLI_ASSOC) ) {

            $articleList .= ' <tr>
                            <td class="text-center e1f5fe light-blue lighten-5"><a class="h6 blue-grey-text" >' .$result['id_rpa_process'].'</a></td> 
                            <td class="text-center"><a>' .$result['name'] .' </a></td>
                            <td class="text-left"><a >'. "(".$result['id_user'].")".$result['nombre']." ".$result['apellido'] .'</a></td>
                            <td class="text-left"><a >'. date('Y-m-d H:i:s', strtotime($result['add_date'])).'</a></td>
                             <td class="text-center"><a>' .$result['add_user'] .' </a></td>
                            <td class="text-center"><a onclick="eliminarPorcess_userClass('. $result['id'].')"><i class="fa fa-remove fa-3x red-text" aria-hidden="true"></i> </a></td>';

        }

        echo json_encode( array('numPage' => $numPage, 'articleList' => $articleList));
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdRpaProcess()
    {
        return $this->id_rpa_process;
    }

    /**
     * @param mixed $id_rpa_process
     */
    public function setIdRpaProcess($id_rpa_process)
    {
        $this->id_rpa_process = $id_rpa_process;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
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
    public function setAddUser($add_user)
    {
        $this->add_user = $add_user;
    }

    /**
     * @return mixed
     */
    public function getAddDate()
    {
        return $this->add_date;
    }

    /**
     * @param mixed $add_date
     */
    public function setAddDate($add_date)
    {
        $this->add_date = $add_date;
    }


}