<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 01/09/2017
 * Time: 9:46
 */
include "rpaProcesClassImpl.php";
class rpaProcesClass implements rpaProcesClassImpl
{
    public $nombre;
    public $descripcion;
    public $enable;
    public $fecha_new;
    public $version;
    public $version_txt;
    public $add_user;
    public $file;
    public $id;
    private $page;
    private $per_page;
    public $id_robot;

    function __construct($nombre,$descripcion,$enable,$fecha_new,$version,$version_txt,$add_user,$file,$id,$page,$per_page,$id_robot){

        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
        $this->enable=$enable;
        $this->fecha_new=$fecha_new;
        $this->version=$version;
        $this->version_txt=$version_txt;
        $this->add_user=$add_user;
        $this->file=$file;
        $this->id=$id;
        $this->page = $page;
        $this->per_page = $per_page;
        $this->id_robot = $id_robot;

    }

    function crear(){

        require_once "../bbdd/conexion.php";
        $db=new conexion();
       $ok= $db->query("INSERT rpa_process SET id_rpa = '".$this->getIdRobot()."', name= '".$this->getNombre()."', description= '".$this->getDescripcion()."', enabled= '".$this->getEnable()."', add_date= '".$this->getFechaNew()."'
       , version= '".$this->getVersion()."', version_comments= '".$this->getVersionTxt()."', proyect= '".$this->getFile()."',add_user= '".$this->getAddUser()."'");

       if($ok){

           $query = $db->query("SELECT id_rpa FROM rpa_process where (SELECT MAX(id) FROM rpa_process)");
           $row = $db->mostrar($query);
           $this->setId($row['id_rpa']);
           // Estructura de la carpeta deseada
           $nombreFichero = dirname(__DIR__)."/bat/".$this->getId().".bat";
           $nombreFicheroVs = dirname(__DIR__)."/bat/".$this->getId().".vbs";;
           // Para crear una estructura anidada se debe especificar
           // el parámetro $recursive en mkdir().

                        if(file_exists($nombreFichero)){
                            ?>
                            <script language='javascript'>
                                alert('El fichero .bat ya existe');
                            </script>
                            <?php
                            return true;
                        }
                        else{

                            if ($escritura = fopen($nombreFichero,"a")){

                                if (fwrite($escritura,"\"C:\Program Files (x86)\UiPath Studio\UiRobot.exe\" /file:\"C:\app\bot\\".$this->getId()."\Main.xaml\"")){

                                    if (file_exists($nombreFicheroVs)){

                                        ?>
                                        <script language='javascript'>
                                            alert('El fichero de Vs ya existe');
                                        </script>
                                        <?php
                                        return true;
                                    }
                                    else{

                                        if ($escritura = fopen($nombreFicheroVs,"a")){

                                            if (fwrite($escritura,"Set WshShell = CreateObject(\"WScript.Shell\") \n WshShell.Run chr(34) & \"".$this->getId().".bat\" & Chr(34), 0 \n Set WshShell = Nothing")){
                                                return true;
                                            }
                                            else{

                                                ?>
                                                <script language='javascript'>
                                                    alert('Fallo en la escritura');
                                                </script>
                                                <?php

                                                header('location:../comun.php');
                                            }
                                        }
                                        fclose($escritura);
                                    }
                                }
                                else
                                {
                                    ?>
                                    <script language='javascript'>
                                        alert('Fallo en la escritura');
                                    </script>
                                    <?php

                                    header('location:../comun.php');
                                }

                            }
                            else{
                                return false;
                            }
                            fclose($escritura);
                        }



        }
        else
        {
            return false;
        }
    }

    function editar(){

        require_once "../bbdd/conexion.php";
        $db=new conexion();
            $ok= $db->query("UPDATE rpa_process SET name= '".$this->getNombre()."', description= '".$this->getDescripcion()."', enabled= '".$this->getEnable()."', add_date= '".$this->getFechaNew()."'
       , version= '".$this->getVersion()."', version_comments= '".$this->getVersionTxt()."', proyect= '".$this->getFile()."',add_user= '".$this->getAddUser()."' WHERE id = '".$this->getId()."'");

        if($ok){

            return true;
        }
        else
        {
            return false;
        }
    }

    function eliminar(){

       require_once "../bbdd/conexion.php";
        $db=new conexion();
       $ok= $db->query("DELETE FROM rpa_process WHERE id = '".$this->getId()."'");

       if($ok){
           $nombreFichero = dirname(__DIR__)."/bat/".$this->getId().".bat";
           $nombreFicheroVs = dirname(__DIR__)."/bat/".$this->getId().".vbs";;
           unlink($nombreFichero);
           unlink($nombreFicheroVs);


           return true;
       }
       else
       {
           return false;
       }
    }

    public function paginador()
    {
        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $filtro='';
        $filtro.=' ORDER BY id DESC ';


        if ($this->getPage() != 1) $start = ($this->getPage()-1) * $this->getPerPage();
        else $start=0;

        $select = $db->query("SELECT * FROM rpa_process $filtro LIMIT $start, $this->per_page "); // Select article list from $start

        $numArticles = $db->query("SELECT id FROM rpa_process  $filtro"); // Total number of articles in the database
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
            <td class="text-left"><a >' .$result['add_user'] . '</a></td> 
            <td class="text-left"><a  onclick="eliminarPorcessClass('.$result['id'].')"><i class="fa fa-remove fa-3x red-text" aria-hidden="true"></i></a></td> 
            <td class="text-left"><a  onclick="editarProcessClass('.$result['id'].')"><i class="fa fa-pencil fa-3x blue-text" aria-hidden="true"></i></a></td> 
            
            </tr>';
        }


        // We send back the total number of page and the article list
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
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
    public function setDescripcion($descripcion)
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
    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    /**
     * @return mixed
     */
    public function getFechaNew()
    {
        return $this->fecha_new;
    }

    /**
     * @param mixed $fecha_new
     */
    public function setFechaNew($fecha_new)
    {
        $this->fecha_new = $fecha_new;
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
    public function setVersion($version)
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
    public function setVersionTxt($version_txt)
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
    public function setAddUser($add_user)
    {
        $this->add_user = $add_user;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
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