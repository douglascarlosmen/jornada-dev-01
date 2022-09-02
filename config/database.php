<?php

class DataBase{

    public static function getConnection(){

        $envPath = realpath(dirname(__FILE__) . '/../env.ini');
        $env = parse_ini_file($envPath);

        $conn = new mysqli($env['host'], $env['username'], $env['password']);

        //validar conexão.
        if($conn->connect_error){

            die("Erro: " . $conn->connect_error);
        }
        return $conn;
    }

    public static function executeSql($sql){
        $conn =self::getConnection();

        if(mysqli_query($conn, $sql)){
            throw new Exception(mysqli_error($conn));
        }
        $id = $conn->insert_id;
        $conn->close();
        return $id;
    }

    public static function getResultQuery($sql){
        $conn = self::getConnection();
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
}