<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Company
 *
 * @author Cleon
 */
class Company {
    
    private $db;
    
    
    // Construtor
    public function __construct($conn) {
        $this->db = $conn;
    }
    

    
    public function getCNPJ($com_cnpj){
        try {
            $sql = "select * from tb_company where com_cnpj = ?";
            $stmt = $this->db->prepare($sql);
                if($stmt->execute(array($com_cnpj))){
                    return $stmt;
                }
                else{
                    return false;
                }
            
        } catch (Exception $e) {
            echo "Error. ".$e->getMessage();
        }
    }
    
    
    
    
    public function addCompany($com_cnpj,$com_logo,$com_razao,$com_fantasia,$com_dtabertura,$com_ies,$com_nat_jur,$com_cnae,$com_atividadep,$com_atividades,$com_cep,$com_logradouro,$com_num,$com_complemento,$com_bairro,$com_cidade,$com_uf,$com_tel1,$com_tel2,$com_email,$com_site,$com_obs,$com_situacao,$com_dtsituacao,$com_motivo_situacao,$com_situacao_especial,$com_dtsituacao_especial,$com_capital_social,$com_qsa,$flag){
        try {
            $sql = "insert into tb_company values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->db->prepare($sql);
                if($stmt->execute(array(
                    $com_cnpj,$com_logo,$com_razao,$com_fantasia,$com_dtabertura,$com_ies,$com_nat_jur,$com_cnae,$com_atividadep,$com_atividades,$com_cep,$com_logradouro,$com_num,$com_complemento,$com_bairro,$com_cidade,$com_uf,$com_tel1,$com_tel2,$com_email,$com_site,$com_obs,$com_situacao,$com_dtsituacao,$com_motivo_situacao,$com_situacao_especial,$com_dtsituacao_especial,$com_capital_social,$com_qsa,$flag
                ))){
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
