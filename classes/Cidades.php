<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cidades
 *
 * @author Cleon
 */
class Cidades {
    private $db;
    
    public function __construct($conn) {
        $this->db = $conn;
    }
    
    
    
    public function getIdCidades($id){
        try {
            $sql = "select * from cidade where estado = ?";
            $stmt = $this->db->prepare($sql);
                if($stmt->execute(array($id))){
                    return $stmt;
                }
                else{
                    return false;
                }
            
        } catch (Exception $e) {
            echo "Error ".$e->getMessage();
        }
    }
}
