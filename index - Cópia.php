<?php
/* chama autoload que gerencia as classes e mvc */
require __DIR__ . "/vendor/autoload.php";

//use CoffeeCode\Router\Router;
$route = new CoffeeCode\Router\Router(URL_BASE);

/* Controller estão na pasta App */
$route->namespace("Source\App");

/**Web home */
$route->group(null);
$route->get("/", "Web:home");
$route->get("/contato", "Web:contact");

/* ERROR */
$route->group("ops");
$route->get("/{errcode}", "Web:error");

/* Process */
$route->dispatch();
if($route->error()){
    $route->redirect("/ops/{$route->error()}");
}