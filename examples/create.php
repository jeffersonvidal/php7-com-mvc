<?php
/* chama autoload que gerencia as classes e mvc */
require __DIR__ ."/../vendor/autoload.php";

use Source\Models\User;
use Source\Models\Address;

$user = new User(); //nova instância da classe User

$user->nome = "Meu Nome"; //nome a ser salvo
$user->sobrenome = "Meu Sobrenome"; //sobrenome a ser salvo
$user->genero = "M"; //gênero a ser salvo
$user->save(); //sava dados no BD

 /*
if($user->save()){ //veifica se existe o usuário no BD
    echo 'Criado com sucesso <hr>';
}else{
    echo '<hr>';
    var_dump($user); //se não encontrar e/ou excluir retorna algo
}*/

  $addr = new Address(); //nova instância da classe Address
  $addr->add($user, "Rua onde eu moro", "123 Z","Minha Cidade"); //endereço a ser salvo
  $addr->save(); //salva no BD

//var_dump($user);