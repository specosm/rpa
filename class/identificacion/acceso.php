<?php

class acceso
{
    protected $user;
    protected $pass;

    public function __construct($usuario, $contra)
    {

        $this->user = htmlspecialchars($usuario);
        $this->pass = htmlspecialchars($contra);
    }

    public function login()
    {

        $db=new conexion();

        $inicio = $db->query("SELECT * FROM user where login_id = '" . $this->getUser() . "' AND password='" . $this->getPass() . "'");
        if ($db->row_num($inicio) == 1) {
            $row_consulta = $db->mostrar($inicio);
            session_start();
            $_SESSION["user"] = $row_consulta["first_name"];
            $_SESSION["pass"] = $row_consulta["password"];
            $_SESSION["apellidos"] = $row_consulta["last_name"];
            $_SESSION["email"]= $row_consulta["email"];
            $_SESSION["admin"]= $row_consulta["admon"];
            $_SESSION["id"] = $row_consulta["id"];
            $_SESSION["id_persona"] = $row_consulta["id_persona"];
            $_SESSION["bot"]=0;
            $_SESSION["backInformesDetalle"]=0;
            $fehcaActual = date_create()->format('Y-m-d H:i:s');
            $db->query("UPDATE user SET last_login_date= '".$fehcaActual."' WHERE id = '".$row_consulta["id"]."'");

                header('location:../../comun.php');

            } else {

                echo "<script language='javascript'>";
                echo "alert('La contrseña es incorrecta o el usuario no exisite');";
                echo "history.back();";
                echo "</script>";
            }


        }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser(string $user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getPass(): string
    {
        return $this->pass;
    }

    /**
     * @param string $pass
     */
    public function setPass(string $pass)
    {
        $this->pass = $pass;
    }

}

