<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cnae
 *
 * @author Cleon
 */
class Cnae {
    private $db;
    
    public function __construct($conn) {
        $this->db = $conn;
    }
    
    // Pega todos os registros
    public function getAll($page, $limit_reg){
        try {
            $sql = "select * from tb_cnae limit $page, $limit_reg";
            $stmt = $this->db->prepare($sql);
                if($stmt->execute()){
                    return $stmt;
                }
                else{
                    return false;
                }
            
        } catch (Exception $e) {
            echo "Error ".$e->getMessage();
        }
    }
    
    
    // Pega cnae pelo ID
    public function getIDCnae($id_cnae){
        try {
            $sql = "select * from tb_cnae where id=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($id_cnae));
            
            return $stmt;
            
        } catch (Exception $e) {
            echo "Error ".$e->getMessage();
        }
    }
    
       
    //Pega CNAE por número
    public function getNumCnae($buscar){
        try {
            $sql = "select * from tb_cnae where num_cnae like ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($buscar));
            return $stmt;
            
        } catch (Exception $e) {
            echo "Error ".$e->getMessage();
        }      
        
    }
    
    
    
    //Inserir CNAE
    public function addCNAE($num_cnae, $desc_cnae){
        try {
            $sql = "insert into tb_cnae values(null,?,?)";
            $stmt = $this->db->prepare($sql);
                if($stmt->execute(array($num_cnae, $desc_cnae))){
                    return $stmt;
                }
                else{
                    return false;
                }
            
        } catch (Exception $e) {
            echo "Error ".$e->getMessage();
        }
    }
    
    
    //alterar CNAE
    public function editCNAE($num_cnae, $desc_cnae, $id_cnae){
        try {
            $sql = "update tb_cnae set num_cnae=?, desc_cnae=? where id=?";
            $stmt = $this->db->prepare($sql);
                if($stmt->execute(array($num_cnae,$desc_cnae, $id_cnae))){
                    return $stmt;
                }
                else{
                    return false;
                }
            
        } catch (Exception $e) {
            echo "Error ".$e->getMessage();
        }        
    }
    
    
    // Deleta um CNAE
    public function delCNAE($id_cnae){
        try {
            $sql = "delete from tb_cnae where id=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($id_cnae));
            return $stmt;
            
        } catch (Exception $e) {
            echo "Error ".$e->getMessage();
        }
        
    }
   
}
