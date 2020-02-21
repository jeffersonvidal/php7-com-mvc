<?php
/* chama autoload que gerencia as classes e mvc */
require __DIR__ ."/../vendor/autoload.php";

/* Vai criar pastas uploads\images\ano\mes\nomedoarquivo.ext */
$upload = new \CoffeeCode\Uploader\Image("uploads","images"); //para imagens
//$upload = new \CoffeeCode\Uploader\File("storage","files"); //para arquivos diversos
//$upload = new \CoffeeCode\Uploader\Media("storage","media"); //para arquivos de mídia (audio e video)
//$upload = new \CoffeeCode\Uploader\Send("storage","media", []); //para arquivos não permitidos nativamente pela hospedagem

$files = $_FILES; //global

if(!empty($files["image"])){
    $arquivo = $files["image"];
    var_dump($arquivo);

    if(empty($arquivo["type"]) || !in_array($arquivo["type"], $upload::isAllowed())){
        echo "<p>Selecione uma imagem válida</p>";
    }else{
        $uploaded = $upload->upload($arquivo, pathinfo($arquivo["name"], PATHINFO_FILENAME), "1920");
        echo "<img src='{$uploaded}' />";
    }
}

?>

<form action="" method="post" enctype="multipart/form-data">
<h4>Single Image</h4>
<input type="file" name="image" id="">
<button>Enviar</button>

</form>


<?php
if(!empty($files["images"])){
    $imagens = $files["images"];

    /* Corrigindo pegar indices de array em upload multiplo */
    for($i=0; $i < count($imagens["type"]); $i++){
        foreach(array_keys($imagens) as $keys){
            $imageFiles[$i][$keys] = [$imagens[$keys][$i]];
        }
    }

    foreach($imageFiles as $file){
        if (empty($file["type"])) {
            echo "<p>Selecione uma imagem válida</p>";
        } elseif (!in_array($file["type"], $upload::isAllowed())) {
            echo "<p>O arquivo não é válido.</p>";
        } else {
            $uploaded = $upload->upload($file, pathinfo($file["name"], PATHINFO_FILENAME), "1920");
            echo "<img src='{$uploaded}' />";
        }
        //var_dump($file);
    }
    
}
?>

<form action="" method="post" enctype="multipart/form-data">
<h4>Multiple Image</h4>
<input type="file" name="images[]" accept="image/jpeg, image/jpg, image/png" multiple>
<button>Enviar</button>

</form>
