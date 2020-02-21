<?php
require __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Paginator\Paginator;
use Source\Models\Post;

$post = new Post();
$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRIPPED);
$paginator = new Paginator("http://localhost/php7-com-mvc/examples/paginator.php?page=", "Página", ["Primeira Página","Primeira"],["Últma Página","Última"]);
//$paginator = new Paginator("http://localhost/php7-com-mvc/examples/paginator.php?page=");
$paginator->pager($post->find()->count(), 3, $page, 2);

$posts = $post->find()->limit($paginator->limit())->offset($paginator->offset())->fetch(true);

echo "<p>Página {$paginator->page()} de {$paginator->pages()}</p>";

$url = URL_BASE . "/";

if($posts){
    foreach($posts as $post){
        echo "<article class='post'>
                <img src='{$post->capa}' /><br>
                <h1>{$post->titulo}</h1>
                <p>{$post->descricao}</p>
            </article>";
    }
}

echo $paginator->render(); //mostra paginação << 1 2 >>
