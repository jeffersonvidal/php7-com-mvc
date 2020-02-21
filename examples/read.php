<?php
/* chama autoload que gerencia as classes e mvc */
require __DIR__ ."/../vendor/autoload.php";

// use CoffeeCode\DataLayer\Connect;
// $conn = Connect::getInstance();
// $error = Connect::getError();
// if($error){
//     echo $error->getMessage();
//     die();
// }
// $query = $conn->query("SELECT * FROM users");
// var_dump($query->fetchAll());

use Source\Models\User; //usar a classe User
$user = new User(); //nova instância do objeto User
$list = $user->find()->fetch(true); //select * form na tabela users, retorna um objeto encapsulado

/**@ $userItem User */
foreach($list as $userItem){
    var_dump($userItem->data()); //retorna todos os campos da tabela
    //var_dump($userItem->first_name); // retorna campo específico
    //var_dump($userItem->addresses());
    foreach($userItem->addresses() as $address){
        //var_dump($address->data()->street); //mostra campo específico
        //var_dump($address->street); //mostra campo específico
        var_dump($address->data()); //retorna objeto com todos os dados
        echo  "<br>";
    }
    
    
}