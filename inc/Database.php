<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author Cleon
 */
//require_once './Config.php';

class Database {
    // Atributos 
//    private $dbHost = "fatsus_db.mysql.dbaas.com.br";
//    private $dbName = "fatsus_db";
//    private $dbUsername = "fatsus_db";
//    private $dbPassword = "fat@sus@";
    
    private $dbHost = "localhost";
    private $dbName = "fatsus_db";
    private $dbUsername = "root";
    private $dbPassword = "";

    private $conn = null;
    
    
    // Método de conexão
    public function Connect(){
       if($this->conn == null){
           try {
               $this->conn = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName,$this->dbUsername,$this->dbPassword);               
           } catch (Exception $e) {
               echo "Conection error! ".$e->getMessage();
           }
       }
       return $this->conn;
    }
    
    
    // Método para fechar a conexão
    public function Disconnect(){
        $this->conn = null;
    }
    
}
