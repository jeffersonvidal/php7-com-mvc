<?php
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Post extends DataLayer //herda tudo da classe DataLayer
{
    public function __construct()
    {
        parent::__construct("posts", ["titulo","descricao"]);
    }
}
