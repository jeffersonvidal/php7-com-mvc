<?php
/* chama autoload que gerencia as classes e mvc */
require __DIR__ ."/../vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\TelegramBotHandler;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Formatter\LineFormatter;

/* Logger(name(web, admin), handlers, processors, timezone ) */
$logger = new Logger("web");
$logger->pushHandler(new BrowserConsoleHandler(Logger::DEBUG));
$logger->pushHandler(new StreamHandler(dirname(__DIR__)."/log.txt", Logger::WARNING));

/* Utilizar ferramenta (API) online SendGrid para enviar emails */
/*$logger->pushHandler(new SendGridHandler(
    SENDGRID_EX["user"], //apiUser
    SENDGRID_EX["passwd"], //apiKey
    "noreply@meusite.com", //remetente
    "admin@meusite.com", //destinatário (Administrador do sistema)
    "Erro em meusite.com: ".date("d/m/Y H:i:s"), //título da mensagem
    Logger::CRITICAL //nível
));*/

/* Padronização PSR3 */
$logger->pushProcessor(function ($record){
    $record["extra"]["HTTP_HOST"] = $_SERVER["HTTP_HOST"];
    $record["extra"]["REQUEST_URI"] = $_SERVER["REQUEST_URI"];
    $record["extra"]["REQUEST_METHOD"] = $_SERVER["REQUEST_METHOD"];
    $record["extra"]["HTTP_USER_AGENT"] = $_SERVER["HTTP_USER_AGENT"];
    return $record;
});

/* Enviar para Telegram - BotName: PHPAlertBot */
$teleKey = ""; //key do bot telgram
$teleChannel = "-123654789"; //usar o nome do grupo: @AlertasSistemasPHP ou o ID: -1001210535561
$teleHandler = new TelegramBotHandler($teleKey, $teleChannel, Logger::EMERGENCY);
$teleHandler->setFormatter(new LineFormatter("%level_name%: %message%"));
$logger->pushHandler($teleHandler);

/* Mostra informações apenas no console do navegador */
$logger->debug("Olá mundo", ["logger" => true]);
$logger->info("Olá mundo", ["logger" => true]);
$logger->notice("Olá mundo", ["logger" => true]);

/* Para monitoramento e salvar no banco ou arquivo txt */
$logger->warning("Olá mundo", ["logger" => true]);
$logger->error("Olá mundo", ["logger" => true]);

/* Enviar por email, monitorar e salvar no banco de dados e/ou arquivo txt */
$logger->critical("Olá mundo", ["logger" => true]);
$logger->alert("Olá mundo", ["logger" => true]);

/* Servidor caiu, parou e-commerce, o bicho tá pegando rsrsrs
enviar mensagem para app Telegram */
$logger->emergency("Corre que o bicho tá pegando seu Féla! Colocar os erros e o site onde está com problema.");
