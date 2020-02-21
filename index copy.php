<?php
/* chama autoload que gerencia as classes e mvc */
require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;
$router = new Router(URL_BASE);

/* Controller estão na pasta App */
$router->namespace("Source\App");

/**Web home */
$router->group(null);
$router->get("/","Web:home");
$router->get("/{filter}","Web:home");
$router->get("/{filter}/{page}","Web:home");

/** Contato */
$router->group("contato");
$router->get("/contato","Web:contact");

/**blog */
$router->group("blog");
$router->get("/","Web:blog");
$router->get("/{post_uri}","Web:post");
$router->get("/categoria/{cat_uri}","Web:category");

/** Admin home */
$router->group("admin");
$router->get("/","Admin:home");

/** Erros de rota */
$router->group("ooops");
$router->get("/{errcode}", "Web:error");

$router->dispatch(); //faz roteamento da rota e dispara a mesma

/* Redirecionamento de acordo o erro */
if($router->error()){
    $router->redirect("/ooops/{$router->error()}");
}
