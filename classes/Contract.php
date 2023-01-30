<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contract
 *
 * @author Cleon
 */
class Contract {
    
    private $db;
    
    function __construct($conn) {
        $this->db = $conn;
    }
    
    
    //Método para pegar todos os contratos registrados
    public function getAll(){
        // ...
    }
    
    
    // Método para selecionar um contrato pelo seu número
    public function contractID(){
        // ...
    }
    
    
    // Método para add um novo contrato
    public function addContract(){
        // ...
    }
    
    
    // Método para editar um contrato pelo id
    public function updateContract(){
        
    }
    
    
    // Método para excluir um contrato
    public function delContract(){
        // ...
    }
    
}
