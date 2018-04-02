<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 08/11/2017
 * Time: 12:09
 */
include 'rpaProcessWorkClassImpl.php';
class rpaProcessWorkClass implements rpaProcessWorkClassImpl
{
    public $id;
    public $IdRpaProcess;
    public $addDate;
    private $page;
    private $per_page;

    /**
     * rpaProcessWorkClass constructor.
     * @param $id
     * @param $IdRpaProcess
     * @param $addDate
     * @param $page
     * @param $per_page
     */
    public function __construct($id, $IdRpaProcess, $addDate, $page, $per_page)
    {
        $this->id = $id;
        $this->IdRpaProcess = $IdRpaProcess;
        $this->addDate = $addDate;
        $this->page = $page;
        $this->per_page = $per_page;
    }


    public function Paginador()
    {
        session_start();
        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $filtro='';
        $filtro.=' ORDER BY rpa_process_work.id DESC ';

        if ($this->getPage() != 1) $start = ($this->getPage()-1) * $this->getPerPage();
        else $start=0;

        $select = $db->query("SELECT DISTINCT rpa_process_work.id_rpa_process,rpa_process_work.reference,rpa_process_work.fh_start,rpa_process_work.fh_stop,rpa_process_work.finalizado_ok, rpa_process_work.id as id, rpa_process_work.add_user as userStrar, user.first_name as nombre, user.last_name as apellido FROM rpa_process_work,user,rpa_process_user where rpa_process_user.id_user=user.id and rpa_process_work.id_rpa_process=rpa_process_user.id_rpa_process and (rpa_process_user.id_user='".$_SESSION['id']."' or user.admon!='S') $filtro LIMIT $start, $this->per_page "); // Select article list from $start

        $numArticles = $db->query("SELECT DISTINCT rpa_process_work.id FROM rpa_process_work,user,rpa_process_user where rpa_process_user.id_user=user.id and rpa_process_work.id_rpa_process=rpa_process_user.id_rpa_process and (rpa_process_user.id_user='".$_SESSION['id']."' or user.admon!='S')  $filtro"); // Total number of articles in the database
        $num = $db->row_num($numArticles);
        $numPage = ceil($num / $this->getPerPage()); // Total number of page

        $articleList = '';
        while( $result = $select->fetch_array(MYSQLI_ASSOC) ) {

            $articleList .= ' <tr>
                            <td class="text-center e1f5fe light-blue lighten-5"><span class="h6 blue-grey-text" >' . $result['id'] . '</span></td> 
                            <td class="text-center"><span >' . $result['id_rpa_process'] . ' </span></td>
                            <td class="text-left"><span >' . $result['reference'] . '</span></td>
                            <td class="text-left"><span >' . date('Y-m-d H:i:s', strtotime($result['fh_start'])) . '</span></td>
                            <td class="text-left"><span >' . "(" . $result['userStrar'] . ")" . " " . $result['nombre'] . " " . $result['apellido'] . '</span></td>';
            $articleList .= ' <td class="text-center"><span>';
            if (is_null($result['fh_stop'])) {
                $articleList .= '-------------';
            } else {
                $articleList .= date('Y-m-d H:i:s', strtotime($result['fh_stop']));
            }

            $articleList .= '</span></td>';

            $articleList .= ' <td class="text-center">';
            if ($result['finalizado_ok'] == 0) {
                $articleList .= '<i class="fa fa-times fa-3x red-text" aria-hidden="true"></i>';
            } elseif ($result['finalizado_ok'] == 1) {
                $articleList .= '<i class="fa fa-check fa-3x green-text" aria-hidden="true"></i>';
            } elseif ($result['finalizado_ok'] == 2) {
                $articleList .= '<i class="fa fa-exclamation fa-3x yellow-text" aria-hidden="true"></i>';
            }

            $articleList .= '</td>';
            $articleList .= '<td onclick="filtro(' . $result['id'] . ')"  class="text-center"><a><i class="fa fa-file-text-o  fa-3x" aria-hidden="true"></i> </a></td>  ';


            $articleList .= ' <td class="text-center">';

            if ($result['finalizado_ok'] == 2) {
                $articleList .= '<a onclick="filtroWarning(' . $result['id'] . ')"><i class="fa fa-file-code-o fa-3x" aria-hidden="true"></i></a>';
            }
            $articleList .= '</td>';


            $articleList .= ' <td class="text-center">';
            if ($result['finalizado_ok']== 0 ) {
                $articleList .= '<a onclick="filtroError('. $result['id'].')"><i class="fa fa-file-excel-o fa-3x" aria-hidden="true"></i></a>';
            }
            $articleList .= '</td>';
            $articleList .= ' </tr>';

        }

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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdRpaProcess()
    {
        return $this->IdRpaProcess;
    }

    /**
     * @param mixed $IdRpaProcess
     */
    public function setIdRpaProcess($IdRpaProcess)
    {
        $this->IdRpaProcess = $IdRpaProcess;
    }

    /**
     * @return mixed
     */
    public function getAddDate()
    {
        return $this->addDate;
    }

    /**
     * @param mixed $addDate
     */
    public function setAddDate($addDate)
    {
        $this->addDate = $addDate;
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
    public function setPage($page)
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
    public function setPerPage($per_page)
    {
        $this->per_page = $per_page;
    }

}