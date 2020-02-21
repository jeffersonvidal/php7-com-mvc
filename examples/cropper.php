<?php
/* chama autoload que gerencia as classes e mvc */
require __DIR__ ."/../vendor/autoload.php";

use CoffeeCode\Cropper\Cropper;
use Faker\Factory;

// dirname(__DIR__);
$pasta = dirname(__DIR__);


$faker = Factory::create("pt-br");
$generate = false; //habilita gerar ou não imagens com $faker

 
/* Gerar imagens aleatórias com $faker */
if($generate){
    for ($img=0; $img < 3; $img++) { 
        $faker->image(dirname(__DIR__) . "/images", 600, 300);
    }
}


$c = new Cropper("../images/cache"); //pasta das imagens de cache
/* Mostrar as imagens */
for ($image=1; $image < 4 ; $image++) : 
    ?>

    <article>
        <h1>Imagem <?= $image;?></h1>
        <img src="../images/<?= $image;?>.jpg"/> <!-- mostra imagem tamanho original -->
        <img src="<?= $c->make("../images/{$image}.jpg", 300, 300); ?>" /> <!-- gera miniatura 300x300 -->
        <img src="<?= $c->make("../images/{$image}.jpg", 300, 150); ?>" /> <!-- gera miniatura 300x150 -->
    </article>

    <?php
    //$c->flush(); //limpa toda a pasta de cache
    //$c->flush("1.jpg"); //limpa imagem específica da pasta de cache
endfor;
