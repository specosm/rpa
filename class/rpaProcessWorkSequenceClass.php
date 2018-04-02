<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 17/10/2017
 * Time: 10:58
 */
include 'rpaProcessWorkSequenceClassImpl.php';
class rpaProcessWorkSequenceClass implements rpaProcessWorkSequenceClassImpl
{
public $IdRpaProcessWork;
public $Comment;
public $addDate;
public $id;
private $page;
private $per_page;

    /**
     * rpaProcessWorkSequenceClass constructor.
     * @param $IdRpaProcessWork
     * @param $Comment
     * @param $addDate
     * @param $id
     * @param $page
     * @param $per_page
     */
    public function __construct($IdRpaProcessWork, $Comment, $addDate, $id, $page, $per_page)
    {
        $this->IdRpaProcessWork = $IdRpaProcessWork;
        $this->Comment = $Comment;
        $this->addDate = $addDate;
        $this->id = $id;
        $this->page = $page;
        $this->per_page = $per_page;
    }


    public function BuscarConFiltro()
    {
        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $query = $db->query("SELECT * FROM rpa_process_work_sequence where id_rpa_process_work = '".$this->getId()."' ORDER BY add_date");
        return $query;
    }

    public function BuscarSinFiltro()
    {
        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $query = $db->query("SELECT * FROM rpa_process_work_sequence ORDER BY id_rpa_process_work");
        return $query;
    }

    public function Paginador()
    {
        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $filtro='';
            $filtro.='WHERE id_rpa_process_work= '.$this->getId();

        if ($this->getPage() != 1) $start = ($this->getPage()-1) * $this->getPerPage();
        else $start=0;

        $select = $db->query("SELECT * FROM rpa_process_work_sequence $filtro LIMIT $start, $this->per_page "); // Select article list from $start

        $numArticles = $db->query("SELECT id FROM rpa_process_work_sequence  $filtro"); // Total number of articles in the database
        $num = $db->row_num($numArticles);
        $numPage = ceil($num / $this->getPerPage()); // Total number of page

        // We build the article list
        $articleList = '';
        while( $result = $select->fetch_array(MYSQLI_ASSOC) ) {

            $articleList .= ' 
            <tr>
            <td class="text-left"><a >' .$result['id_rpa_process_work'].'</a></td> 
            <td class="text-left"><a >' . $result['comment'] . '</a></td>
            <td class="text-left"><a >' .$result['add_date'] . '</a></td> 
            </tr>';
      }


        // We send back the total number of page and the article list
      echo json_encode( array('numPage' => $numPage, 'articleList' => $articleList));


    }


    /**
     * @return mixed
     */
    public function getIdRpaProcessWork()
    {
        return $this->IdRpaProcessWork;
    }

    /**
     * @param mixed $IdRpaProcessWork
     */
    public function setIdRpaProcessWork($IdRpaProcessWork)
    {
        $this->IdRpaProcessWork = $IdRpaProcessWork;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->Comment;
    }

    /**
     * @param mixed $Comment
     */
    public function setComment($Comment)
    {
        $this->Comment = $Comment;
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