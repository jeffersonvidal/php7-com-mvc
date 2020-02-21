<?php
/* chama autoload que gerencia as classes e mvc */
require __DIR__ ."/../vendor/autoload.php";

use Source\Models\User;

$user = (new User())->findById(3); //busca usuário pelo ID

$user->nome = "José";
$user->sobrenome = "Qualquer sobrenome";
$user->genero = "M";


if($user->save()){ //veifica se existe o usuário no BD
    echo 'Modificado com sucesso <hr>';
}else{
    echo '<hr>';
    var_dump($user); //se não encontrar e/ou excluir retorna algo
}
