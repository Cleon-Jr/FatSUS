<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NFiscal
 *
 * @author Cleon
 */
class NFiscal {
    private $db;
    
    
    public function __construct($conn) {
        $this->db = $conn;
    }
    
    
    public function getFileName(){
        try {
            $sql = "select * from tb_nfe where nfe_arquivo = ?";
            $stmt = $this->db->prepare($sql);
                if($stmt->execute(array())){
                    return $stmt;
                }
                else{
                    return false;
                }
            
        } catch (Exception $e) {
            echo "Error. ".$e->getMessage();
        }
    }
    
    
    
    public function addNfeFile(){
        try {
            $sql = "insert into tb_nfe values(null,?,?,?,?,?,?)";
            $stmt = $this->db->prepare($sql);
                if($stmt->execute(array())){
                    return $stmt;
                }
                else{
                    return false;
                }
            
        } catch (Exception $ex) {
            
        }
    }
    
    
}
