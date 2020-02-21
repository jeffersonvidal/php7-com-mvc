<?php
/* chama autoload que gerencia as classes e mvc */
require __DIR__ ."/../vendor/autoload.php";

use Source\Models\User;
use Source\Models\Address;

$user = (new User())->findById(6); //busca usuário pelo ID
//$address = (new Address())->find("userID = :uid", "uid={$user->id}");
$address = (new Address())->find("userID = :uid","uid={$user->id}")->fetch();

if($user){ //veifica se existe o usuário no BD
    $user->destroy(); //exclui o usuário do BD
    $address->destroy(); //exclui o usuário do BD

    //var_dump($address);
    
    echo 'Excluído com sucesso <hr>';
}else{
    echo $user->fail()->getMessage() . 'Erro de usuário <hr>';
    echo $address->fail()->getMessage() . 'Erro de endereço <hr>';
    //var_dump($user); //se não encontrar e/ou excluir retorna algo
}