<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Cleon
 */


class User {    
    
    private $db;
    // Construtor recebendo parâmetro $conn da classe Database
    function __construct($conn) {
        $this->db = $conn;
    }
    
    // Método para pegar todos os registros da tabela
    public function getAll(){
        $sql = "select * from tb_users";
        
        $stmt = $this->db->prepare($sql);
            if($stmt->execute()){
                return $stmt;
            }
            else{
                return false;
            }
    }
    
    // Método para pegar um registro pelo ID
    public function getID($id){
        $sql = "select * from tb_users where use_id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));        
        return $stmt;
    }
    
          
    // Método para editar um registro incluindo a senha
    public function updateIDfull($id, $nome, $cpf, $cns, $setor, $email, $senha){
        $sql = "update tb_users set use_nome=?, use_cpf=?, use_cns=?, use_setor=?, use_email=?, use_senha=? where use_id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            $nome,$cpf,$cns,$setor,$email, md5($senha),$id
        ));
        return $stmt;
    }
    
    // Método para editar um registro sem a senha
    public function updateIDoffPass($id, $nome, $cpf, $cns, $setor, $email){
        $sql = "update tb_users set use_nome=?, use_cpf=?, use_cns=?, use_setor=?, use_email=? where use_id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            $nome,$cpf,$cns,$setor,$email,$id
        ));
        return $stmt;
    }
    
    
    // Método para adicionar usuário
    public function addUser($nome, $cpf, $cns, $setor, $email, $senha){        
        $sql = "insert into tb_users values(null,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            $nome,$cpf,$cns,$setor,$email, md5($senha)
        ));
        return $stmt;
    }
    
    
    // Método para excluir usuário
    public function delUser($id){
        $sql = "delete from tb_users where use_id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt;
    }
    
    
    // Método para login do usuário
    public function loginUser($email, $senha){
        $sql = "select * from tb_users where use_email=? and use_senha=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
           $email, md5($senha)
        ));
        return $stmt;
    }
   

    
}
