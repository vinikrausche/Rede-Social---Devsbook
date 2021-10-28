<?php
namespace src\models;
use \core\Model;

class User extends Model {

    private  $id;
    private   $name;
    private  $email;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->name = ucfirst($name);
    }

    public function getName(){
        return $this->name ;
    }

    public function setEmail($email){
        $this->email = strtolower($email);
    }
    
}