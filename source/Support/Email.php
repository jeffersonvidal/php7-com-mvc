<?php

namespace Source\Support;

use Exception;
use stdClass;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email
{
    private $email; //PHPMailer
    private $data; //stdClass
    private $error; //Exception

    public function __construct()
    {
        $this->mail = new PHPMailer("true"); //instância do PHPMailer
        $this->data = new stdClass(); //instância do stdClass

        $this->mail->isSMTP(); //usar servidor SMTP
        $this->mail->isHTML(); //Body da mensagem será HTML
        $this->mail->setLanguage("br"); //idioma do email
        //$this->mail->SMTPDebug = SMTP::DEBUG_SERVER;

        /* Modo de envio */
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = "tls";
        $this->mail->CharSet = "utf-8";
        $this->mail->Host = CONF_SMTP_MAIL["host"];
        $this->mail->Port = CONF_SMTP_MAIL["port"];
        $this->mail->Username = CONF_SMTP_MAIL["user"];
        $this->mail->Password = CONF_SMTP_MAIL["passwd"];
    }

    /* Montando o email */
    public function add(string $subject, string $body, string $recipient_name, string $recipient_email): Email
    {
        $this->data->subject = $subject; //assunto do email
        $this->data->body = $body; //conteúdo do email
        $this->data->recipient_name = $recipient_name; //nome de quem receberá o email
        $this->data->recipient_email = $recipient_email; //email de quem receberá a msg

        return $this;
    }

    /* Função para anexar arquivos no email */
    public function attach(string $filePath, string $fileName): Email
    {
        $this->data->attach[$filePath] = $fileName; //pega caminho e nome do arquivo a ser anexado
    }

    /* Função para enviar o email */
    public function send(string $from_name = CONF_SMTP_MAIL["from_name"], string $from_email = CONF_SMTP_MAIL["from_email"]): bool
    {
        try {
            $this->mail->Subject = $this->data->subject; //assunto da mensagem
            $this->mail->msgHTML($this->data->body); //conteúdo da mensagem
            $this->mail->addAddress($this->data->recipient_email, $this->data->recipient_name); // quem recebe
            $this->mail->setFrom($from_email, $from_name);
            
            /*Verifica existência de anexos no email */
            if(!empty($this->data->attach)){
                foreach($this->data->attach as $path => $name){ //no caso de múltiplos anexos percorre cada um, pegando o caminho e nome do arquivo
                    $this->mail->addAttachment($path, $name); //pega caminho e depois o nome do arquivo
                }
            }
            
            $this->mail->send(); //dispara o envio do email
            return true;
        } catch (Exception $exception) {
            $this->error = $exception;
            return false;
        }
    }

    /* Retorna erros do envio de email */
    public function error(): ?Exception //retorna valor nulo ou o erro ocorrido
    {
        return $this->error;
    }
}