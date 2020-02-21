<?php
namespace Source\Models;
use CoffeeCode\DataLayer\DataLayer;

class User extends DataLayer //herda tudo da classe DataLayer
{
    public function __construct()
    {
        //$entity, array required, string primary = 'id', bool $timestamps = true
        parent::__construct("usuarios", ["nome","sobrenome"]); //pega primeiro nome e ultimo nome da tabela users
    }

    
    public function addresses()
    {
        return (new Address())->find("userID = :uid","uid={$this->id}")->fetch(true);
    }
}