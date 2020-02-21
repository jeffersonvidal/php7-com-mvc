<?php
use Dompdf\Dompdf;

/* chama autoload que gerencia as classes e mvc */
require __DIR__ ."/../vendor/autoload.php";

$dompdf = new Dompdf(["enable_remote" => true]); //permite usar medias externas
$dompdf->loadHtml("<h1>Olá mundo</h1>");

/* Incia sessão de cache */
ob_start();
//require __DIR__ . "/contents/users.php"; //carrega página para ser convertida em pdf
$dompdf->loadHtml(ob_get_clean()); //obtem arquivo entre as tags ob_ dá um clean e não deixa sair para output

// $dompdf->setPaper("A4", "landscape");
$dompdf->setPaper("A4");
$dompdf->render(); //gera pdf
//$dompdf->stream("file.pdf", ["Attachment" => false]); //define nome do arquivo e já abre o arquivo gerado no navegador
