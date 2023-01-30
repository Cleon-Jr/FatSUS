<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Manager
 *
 * @author Cleon
 */
class Manager {
    private $db;
    
    
    public function __construct($conn) {
        $this->db = $conn;
    }
    
    
    
    public function getManager(){
        try {
            $sql = "select * from tb_manager";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
                        
        } catch (Exception $e) {
            echo "Error ".$e->getMessage();
        }
    }
    
    
    
    public function addManager($id,$razao,$fantasia,$cnpj,$cnes,$logo,$cep,$rua,$num,$comp,$bairro,$cidade,$uf,$tel1,$tel2,$email,$data,$flag){
        try {
            $sql = "insert into tb_manager values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->db->prepare($sql);
                if($stmt->execute(array(md5($id),$razao,$fantasia,$cnpj,$cnes,$logo,$cep,$rua,$num,$comp,$bairro,$cidade,$uf,$tel1,$tel2,$email,$data,$flag))){
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
