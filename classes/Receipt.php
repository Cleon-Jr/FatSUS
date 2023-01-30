<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Receipt
 *
 * @author Cleon
 */
class Receipt {
    private $db;
    
    public function __construct($conn) {
        $this->db = $conn;
    }
    
    
    
    public function addReceipt($process_number, $data, $valor, $pagador, $cnpj_cpf_pag, $valor_ext, $referencia, $emissor, $cnpj_cpf_emiss, $tel, $forma_pag){
        try {
            $sql = "insert into tb_receipt values(null,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->db->prepare($sql);
                if($stmt->execute(array(
                    $process_number, $data, $valor, $pagador, $cnpj_cpf_pag, $valor_ext, $referencia, $emissor, $cnpj_cpf_emiss, $tel, $forma_pag
                ))){
                    return $stmt;
                }
                else{
                    return false;
                }
            
            
        } catch (Exception $e) {
            echo "Error ".$e->getMessage();
        }
    }
    
    
  
    
    public function getReceiptProcess($process_number){
        try {
            $sql = "select * from tb_receipt where rec_num_processo=?";
            $stmt = $this->db->prepare($sql);
                if($stmt->execute(array($process_number))){
                    return $stmt;
                }
                else{
                    return false;
                }
            
        } catch (Exception $e) {
            echo "Error. ".$e->getMessage();
            
        }
    }
    
    
    
}
