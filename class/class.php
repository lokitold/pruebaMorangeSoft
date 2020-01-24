<?php

#set values debug php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 800);
session_start();

#require model class
require_once("classconexion.php");


class Login extends Db
{

    public function __construct()
    {
        self::SetNames();
        parent::__construct();
    }

    public function registrarVisitaUsuario()
    {

        #generar session
        $_SESSION["acceso"] = TRUE;

        #guardar acceso en base de Datos;
        $query = " insert into acceso_user (remote_addr, hora_acceso, user_agent, php_self)values (?, ?, ?, ?); ";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(1, $remoteAddr);
        $stmt->bindParam(2, $horaAcceso);
        $stmt->bindParam(3, $userAgent);
        $stmt->bindParam(4, $phpSelf);
        $remoteAddr = strip_tags($_SERVER['REMOTE_ADDR']);
        $horaAcceso = strip_tags(date("Y-m-d h:i:s"));
        $userAgent = strip_tags($_SERVER['HTTP_USER_AGENT']);
        $phpSelf = strip_tags($_SERVER['PHP_SELF']);
        $stmt->execute();
        #


    }


}

?>
