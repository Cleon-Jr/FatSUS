<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Process
 *
 * @author Cleon
 */
class Process {
    private $db;
    
    
    public function __construct($conn) {
        $this->db = $conn;
    }
    
    // Pega todos os processos registrados
    public function getAllProcess(){
        try {
            $sql = "select * from tb_process";
            $stmt = $this->db->prepare($sql);
                if($stmt->execute()){
                    return $stmt;
                }
                else{
                    return false;
                }
            
        } catch (Exception $e) {
            echo "Error! ".$e->getMessage();
        }
    }


    public function addProcess($data_reg, $num_pro, $data, $hora, $usuario, $pro_com_cnpj, $status){
        try {
            $sql = "insert into tb_process values(null,?,?,?,?,?,?,?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($data_reg, $num_pro, $data, $hora, $usuario, $pro_com_cnpj, $status
                ));
            return $stmt;
            
            
        } catch (Exception $e) {
            echo "Error ".$e->getMessage();
        }
    }
    
        
    
    
    public function getLastProcess(){
        try {
            $sql = "select * from tb_process order by pro_id desc limit 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
            
        } catch (Exception $e) {
            echo "Error. ".$e->getMessage();
        }
    }
    
    
    
    public function updateProcess($com_cnpj, $process_number){
        try {
            $sql = "update tb_process set pro_com_cnpj=? where pro_numero=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($com_cnpj,$process_number));
            return $stmt;
            
        } catch (Exception $e) {
            echo "Error. ".$e->getMessage();
        }
    }
    
    
    
    public function getNumProcess($process_number){
        try {
            $sql = "select * from tb_process where pro_numero=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($process_number));
            return $stmt;
            
        } catch (Exception $e) {
            echo "Error. ".$e->getMessage();
        }
    }
    
    
    
    
}