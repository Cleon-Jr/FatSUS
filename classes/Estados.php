<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estados
 *
 * @author Cleon
 */
class Estados {
    private $db;
    
    public function __construct($conn) {
        $this->db = $conn;
    }
    
    
    
    public function getAll(){
        try {
            $sql = "select * from estado";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array());
            return $stmt;
            
        } catch (Exception $e) {
            echo "Error ".$e->getMessage();
        }
    }
}
