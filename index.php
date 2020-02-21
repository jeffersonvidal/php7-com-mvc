<?php
/* chama autoload que gerencia as classes e mvc */
require __DIR__ . "/vendor/autoload.php";

//use CoffeeCode\Router\Router;
$route = new CoffeeCode\Router\Router(URL_BASE);

/* Controller estão na pasta App */
$route->namespace("Source\App");

/**Web home */
$route->group(null);
$route->get("/", "Form:home", "form.home"); //url, Classe:método, apelido
$route->get("/create", "Form:create", "form.create"); //url, Classe:método, apelido
$route->get("/delete", "Form:delete", "form.delete"); //url, Classe:método, apelido


/* Process */
$route->dispatch();

if($route->error()){
    //$route->redirect("/ops/{$route->error()}");
    var_dump($route->error());
}