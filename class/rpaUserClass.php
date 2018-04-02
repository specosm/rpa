<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24/11/2017
 * Time: 12:31
 */
include 'rpaUserClassImpl.php';
class rpaUserClass implements rpaUserClassImpl
{
    public $id;
    public $id_persona;
    public $firstName;
    public $lastName;
    public $email;
    public $loginId;
    public $password;
    public $admon;
    public $lastLoginDate;
    public $enabled;
    public $addUser;
    public $addDate;
    private $page;
    private $per_page;

    /**
     * rpaUserClass constructor.
     * @param $id
     * @param $id_persona
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $loginId
     * @param $password
     * @param $admon
     * @param $lastLoginDate
     * @param $enabled
     * @param $addUser
     * @param $addDate
     * @param $page
     * @param $per_page
     */
    public function __construct($id, $id_persona, $firstName, $lastName, $email, $loginId, $password, $admon, $lastLoginDate, $enabled, $addUser, $addDate, $page, $per_page)
    {
        $this->id = $id;
        $this->id_persona = $id_persona;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->loginId = $loginId;
        $this->password = $password;
        $this->admon = $admon;
        $this->lastLoginDate = $lastLoginDate;
        $this->enabled = $enabled;
        $this->addUser = $addUser;
        $this->addDate = $addDate;
        $this->page = $page;
        $this->per_page = $per_page;
    }


    public function crear()
    {

        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $query = $db->query("SELECT * FROM user WHERE user.login_id= '".$this->getLoginId()."'");
        if ($query->num_rows>0){
            return false;
        }
        else
        {
            try {
            $ok= $db->query("INSERT user SET id_persona = '".$this->getIdPersona()."', first_name = '".$this->getFirstName()."', last_name = '".$this->getLastName()."'
            ,email = '".$this->getEmail()."',login_id = '".$this->getLoginId()."', password = '".$this->getPassword()."'
            ,admon = '".$this->getAdmon()."', enabled = '".$this->getEnabled()."', add_user = '".$this->getAddUser()."',
            add_date = '".$this->getAddDate()."'");
            } catch (Exception $e) {
                $error= 'Excepción capturada: '.  $e->getMessage() ."\n";
                ?>
                <script language='javascript'>
                    alert(<?php echo $error; ?>);
                    window.location.href = "../comun.php";
                </script>
                <?php
            }
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
        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $ok= $db->query("UPDATE user SET last_name= '".$this->getLastName()."', id_persona= '".$this->getIdPersona()."', first_name= '".$this->getFirstName()."', email= '".$this->getEmail()."'
       , login_id= '".$this->getLoginId()."', password= '".$this->getPassword()."', admon= '".$this->getAdmon()."',enabled= '".$this->getEnabled()."' WHERE id = '".$this->getId()."'");

        if($ok){

            return true;
        }
        else
        {
            return false;
        }
    }

    public function editarPerfil()
    {
        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $ok= $db->query("UPDATE user SET last_name= '".$this->getLastName()."', first_name= '".$this->getFirstName()."', email= '".$this->getEmail()."'
       , login_id= '".$this->getLoginId()."', password= '".$this->getPassword()."' WHERE id = '".$this->getId()."'");

        if($ok){

            return true;
        }
        else
        {
            return false;
        }
    }


    public function eliminar()
    {
        require_once "../bbdd/conexion.php";
        $db=new conexion();
        $ok= $db->query("DELETE FROM user WHERE id = '".$this->getId()."'");

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

        $select = $db->query("SELECT user.id as id, user.id_persona, user.first_name as nombre, user.last_name as apellido,user.email as email,
user.login_id as login_id,user.admon as admon, user.last_login_date as last_login_date, user.enabled as enabled, user.add_user as add_user,user.add_date as add_date 
FROM user  $filtro LIMIT $start, $this->per_page "); // Select article list from $start

        $numArticles = $db->query("SELECT id FROM user $filtro"); // Total number of articles in the database
        $num = $db->row_num($numArticles);
        $numPage = ceil($num / $this->getPerPage()); // Total number of page

        $articleList = '';
        while( $result = $select->fetch_array(MYSQLI_ASSOC) ) {

            $articleList .= ' <tr>
                            <td class="text-center e1f5fe light-blue lighten-5"><a class="h6 blue-grey-text" >' .$result['id_persona'].'</a></td> 
                            <td class="text-center"><a>' .$result['nombre'] .' </a></td>
                            <td class="text-left"><a >'. $result['apellido'] .'</a></td>
                             <td class="text-left"><a >'. $result['email'] .'</a></td>
                              <td class="text-left"><a >'. $result['login_id'] .'</a></td>
                               <td class="text-left"><a >'. $result['admon'] .'</a></td>
                                <td class="text-left"><a >'. $result['last_login_date'] .'</a></td>
                                 <td class="text-left"><a >'. $result['enabled'] .'</a></td>
                                   <td class="text-center"><a>' .$result['add_user'] .' </a></td>
                            <td class="text-left"><a >'. date('Y-m-d H:i:s', strtotime($result['add_date'])).'</a></td>                      
                            <td class="text-center"><a onclick="eliminarUser('. $result['id'].')"><i class="fa fa-remove fa-3x red-text" aria-hidden="true"></i> </a></td>
                              <td class="text-center"><a onclick="editarUser('. $result['id'].')"><i class="fa fa-pencil fa-3x green-text" aria-hidden="true"></i> </a></td>';

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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdPersona()
    {
        return $this->id_persona;
    }

    /**
     * @param mixed $id_persona
     */
    public function setIdPersona($id_persona): void
    {
        $this->id_persona = $id_persona;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getLoginId()
    {
        return $this->loginId;
    }

    /**
     * @param mixed $loginId
     */
    public function setLoginId($loginId): void
    {
        $this->loginId = $loginId;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getAdmon()
    {
        return $this->admon;
    }

    /**
     * @param mixed $admon
     */
    public function setAdmon($admon): void
    {
        $this->admon = $admon;
    }

    /**
     * @return mixed
     */
    public function getLastLoginDate()
    {
        return $this->lastLoginDate;
    }

    /**
     * @param mixed $lastLoginDate
     */
    public function setLastLoginDate($lastLoginDate): void
    {
        $this->lastLoginDate = $lastLoginDate;
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param mixed $enabled
     */
    public function setEnabled($enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return mixed
     */
    public function getAddUser()
    {
        return $this->addUser;
    }

    /**
     * @param mixed $addUser
     */
    public function setAddUser($addUser): void
    {
        $this->addUser = $addUser;
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
    public function setAddDate($addDate): void
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



}