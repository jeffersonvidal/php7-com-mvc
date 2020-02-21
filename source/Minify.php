<?php
use MatthiasMullie\Minify\CSS;
use MatthiasMullie\Minify\JS;

/* Para gerar os CSS e JS compactados no servidor de hospedagem
insira o termo: ?minify=1 após a url raiz. */

$minCSS = new CSS();
$minJS = new JS();

/* Pasta padrão de CSS e JS */
$cssFolder = dirname(__DIR__, 1) . "/theme/assets/css/";//scaneia pasta padrão de arquivos css
$jsFolder = dirname(__DIR__, 1) . "/theme/assets/js/";//scaneia pasta padrão de arquivos js

$minify = filter_input(INPUT_GET, "minify", FILTER_VALIDATE_BOOLEAN);

if($_SERVER["SERVER_NAME"] == 'localhost' || $minify){
    /* Compactando arquivo CSS */
    $cssDir = scandir($cssFolder);
    foreach ($cssDir as $cssItem) {
        $cssFile = $cssFolder . $cssItem;
        if(is_file($cssFile) && pathinfo($cssFile)["extension"] == "css"){
            $minCSS->add($cssFile);
            var_dump($cssFile);
        }
        $minCSS->minify($cssFolder . "style.min.css");
    }

    /* Compactando arquivo JS */
    $jsDir = scandir($jsFolder);
    foreach ($jsDir as $cssItem) {
        $jsFile = $jsFolder . $cssItem;
        if(is_file($jsFile) && pathinfo($jsFile)["extension"] == "js"){
            $minJS->add($jsFile);
            var_dump($jsFile);
        }
        $minJS->minify($jsFolder . "jquery.min.js");
    }
    
    
}

