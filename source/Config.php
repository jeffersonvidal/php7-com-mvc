<?php
session_start(); //inicia sessão

/* Configuração de conexão com banco de dados
basta mudar o DRIVER e PORTA para usar outros BDs */
define("DATA_LAYER_CONFIG", [ //
    "driver" => "mysql", //driver ou tipo do BD quer será usado
    "host" => "localhost", //endereço do BD
    "port" => "3306", //porta usada pelo BD
    "dbname" => "phpbase", //nome do BD
    "username" => "root", //usuário do BD
    "passwd" => "root", //senha do BD
    "options" => [ //
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", //utilizar codificação charset utf8 para tratar acentos e caracteres epeciais (é,ç,ã) em palavras        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //tratar excessões e obter erros do php
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //resultados vindos do BD já vem encapsulado em um objeto
        PDO::ATTR_CASE => PDO::CASE_NATURAL //a conexão não influencia na aplicação fazer conversão de caracteres na abstração
    ]
]);

/* Configuração de envio de emails com PHPMailer */
define("CONF_SMTP_MAIL",[
    "host" => "smtp.gmail.com",
    "port" => "587",
    "user" => "email@gmail.com",
    "passwd" => "",
    "from_name" => "Nome do Remetente",
    "from_email" => "email@gmail.com"
]);

/* Configurações de Rotas */
define("URL_BASE", "http://localhost/php7-com-mvc");
define("SITE", "Nome do meu site");

function url(string $uri = null): string
{
    if ($uri) {
        return URL_BASE . "/{$uri}";
    }
    return URL_BASE;
}

/* Login com redes sociais */
/* COnfigurações do Facebook */
define("FACEBOOK",[
    "app_id" => "", //ID do aplicativo gerado pelo Facebook
    "app_secret" => "", //Chave do aplicativo gerado pelo Facebook
    "app_redirect" => "", //URL da página que usará o aplicativo de login
    "app_version" => "v4.0" //versão do oauth
]);

/* COnfigurações SEO/SMO */
define("SEO_SMO",[
    "fbAppID" => "123", //ID do aplicativo do facebook
    "fbProfile" => "123456789", //ID do perfil do criador
    "fbPage" => "meuNome", //Página do facebook
    "twCreator" => "@fulano", //perfil do criador
    "twSite" => "@meusite", //perfil do site do criador
    "twDominio" => "site.com.br" //endereço do site do criador
]);

/* Envio de email com SendGrid - https://sendgrid.com/ */
define("SENDGRID_EX",[
    "user" => "****",
    "passwd" => "****"
]);

/* Retorna mensagens do sistema */
function message(string $message, string $type): string
{
    return "<div class=\"message {$type}\">{$message}</div>";
}
