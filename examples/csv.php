<?php
/* chama autoload que gerencia as classes e mvc */
require __DIR__ ."/../vendor/autoload.php";

use Faker\Factory;
use League\Csv\Reader;
use League\Csv\Writer;
use League\Csv\Statement;
//use League\Csv\XMLConverter;
use Source\Models\User;

$pasta = dirname(__DIR__) . "/csv";
/* Apenas gerar e exibir arquivo csv -  NÃO gera no servidor */
$output = false; //habilita gerar arquivo para download
if($output){
    $users = (new User())->find()->fetch(true);
    $csv = Writer::createFromString("");
    $csv->insertOne([
        "nome",
        "sobrenome",
        "genero"
    ]);
    foreach ($users as $user) {
        $csv->insertOne([
            $user->nome,
            $user->sobrenome,
            $user->genero
        ]);
    }
    $csv->output("usuarios.csv"); //gera arquivo CSV para download
}

/* Cria e salva arquivo no servidor em local especificado */
$create = false; //habilita criar arquivo no servidor
if($create){
    $users = (new User())->find()->fetch(true); //busca dados dos usuarios na tabela usuarios
    $stream = fopen($pasta."/usuarios.csv", "w"); //define local e permissão para gerar e escrever no arquivo usuarios.csv
    
    $csv = Writer::createFromStream($stream);

    $csv->insertOne([
        "nome",
        "sobrenome",
        "genero"
    ]);
    foreach ($users as $user) {
        $csv->insertOne([
            $user->nome,
            $user->sobrenome,
            $user->genero
        ]);
    }
    echo true;
}

/* Faz a leitura de arquivo salvo no servidor */
$read = false; //habilita leitura do arquivo csv
if($read){
    $stream = fopen($pasta."/usuarios.csv", "r"); //importa arquivo do servidor
    $csv = Reader::createFromStream($stream);//faz leitura do arquivo

    $csv->setDelimiter(","); //informar delimitador do arquivo (virgula "," ou ponto e virgula ";"
    $csv->setHeaderOffset(null); //informa que a primeira linha será o cabeçalho da planilha

    $stmt = (new Statement());//abrir os dados do arquivo
    $users = $stmt->process($csv);

    foreach ($users as $user) {
        var_dump($user);
    }
}

/* Editar dados do arquivo csv salvo no servidor */
$edit = false; //habilita edição do arquivo csv
if($edit){
    $stream = fopen($pasta."/usuarios.csv", "a+"); //importa arquivo do servidor
    $csv = Writer::createFromStream($stream);
    $faker = Factory::create("pt-br");
    $genero = ["male", "female"][rand(0,1)];

    $csv->insertOne([
        $faker->firstName,
        $faker->lastName,
        strtoupper(substr($genero, 0, 1))
    ]);
}
