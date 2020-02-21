<?php
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Address extends DataLayer //herda tudo da classe DataLayer
{
    public function __construct()
    {
        parent::__construct("enderecos", ["userID"], "endID", false);
    }

    public function add(User $user, string $rua, string $num, string $cidade): Address
    {
        $this->userID = $user->id;
        $this->rua = $rua;
        $this->num = $num;
        $this->cidade = $cidade;

        return $this;
    }

}