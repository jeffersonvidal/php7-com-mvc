<?php
require __DIR__ . "/vendor/autoload.php";

use Faker\Factory;
use Faker\Provider\Image;
use Faker\Provider\Lorem;
use Source\Models\Post;

//$faker = \Faker\Factory::create();

try {
    for ($i=0; $i < 15; $i++) { 
        $post = new Post();
        $post->titulo = Lorem::text(20);
        $post->capa = Image::image("images", 300, 150); //Dir. destino, width, height
        $post->descricao = Lorem::paragraphs(2, true);
        $post->save();
        var_dump($post);
    }
} catch (\Exception $e) {
    echo "<hr>" . $e->getMessage();
}
