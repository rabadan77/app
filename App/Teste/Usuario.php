<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Henrique Rabadan <rabadan at agaerre.com.br>
 */
namespace App\Teste;

class Usuario {
    private $id;
    private $user;
    private $senha;
    private $ativo;
    
    function getId() {
        return $this->id;
    }

    function getUser() {
        return $this->user;
    }

    function getSenha() {
        return $this->senha;
    }

    function getAtivo() {
        return $this->ativo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function loadById($id) {
            $sql = new \App\DB\Sql();
            $results = $sql->select("SELECT * FROM usuarios WHERE id = :ID", array(":ID"=>$id));
            
            if (count($results) > 0) {
            $this->setData($results[0]);
            }
    }
    
    public static function getList() {
        $sql = new \App\DB\Sql();
        return $sql->select("SELECT * FROM usuarios ORDER BY user");
    }
    
    public static function search($user) {
        $sql = new \App\DB\Sql();
        return $sql->select("SELECT * FROM usuarios WHERE user LIKE :SEARCH", array(
            ':SEARCH'=>"%".$user."%"
        ));
    }

    public function login($user, $senha) {
        $sql = new \App\DB\Sql();
        $results = $sql->select("SELECT * FROM usuarios WHERE user = :USER AND senha = :SENHA", array(
            ":USER"=>$user,
            ":SENHA"=>$senha
                ));

        if (count($results) > 0) {

            $this->setData($results[0]);
            

        } else {
            throw  new \Exception("Login e/ou senha inválidos");
        }
    }
    public function setData($data) {
        $this->setId($data["id"]);
        $this->setUser($data["user"]);
        $this->setSenha($data["senha"]);
        $this->setAtivo($data["ativo"]);
    }

        public function insert() {
        $sql = new \App\DB\Sql();
        $results = $sql->select("CALL sp_usuarios_insert(:USER, :SENHA)", array(
           ':USER'=> $this->getUser(),
            ':SENHA'=> $this->getSenha()
        ));
                if (count($results) > 0) {

            $this->setData($results[0]);
         }
    }
    
    public function update($user, $senha) {
        $this->setUser($user);
        $this->setSenha($senha);
        $sql = new \App\DB\Sql();
        $sql->query("UPDATE usuarios SET user = :LOGIN, senha = :SENHA WHERE id = :ID", array(
            ':LOGIN'=>$this->getUser(),
            ':SENHA'=> $this->getSenha(),
            ':ID'=> $this->getId()
        ));
    }
    
    public function delete() {
        $sql = new \App\DB\Sql();
        $sql->query("DELETE FROM usuarios WHERE id = :ID", array(
            ':ID'=> $this->getId()
        ));
        $this->setId("");
        $this->setUser("");
        $this->setSenha("");
        $this->setAtivo("");
    }

        public function __construct($user = "", $senha = "") {
        $this->setUser($user);
        $this->setSenha($senha);
    }
        public function __toString() {
        return json_encode(array(
            "id"=>$this->getId(),
            "user"=>$this->getUser(),
            "senha"=>$this->getSenha(),
            "ativo"=> $this->getAtivo()
        ));
    }
}
