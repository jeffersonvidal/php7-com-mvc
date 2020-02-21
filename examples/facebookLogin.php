<?php

use Source\Models\User;

ob_start();

require __DIR__ . "/../vendor/autoload.php";

if(empty($_SESSION["userLogin"])){
    echo "<h1>Não está logado</h1>";

    $facebook = new \League\OAuth2\Client\Provider\Facebook([
        'clientId'          => FACEBOOK["app_id"],
        'clientSecret'      => FACEBOOK["app_secret"],
        'redirectUri'       => FACEBOOK["app_redirect"],
        'graphApiVersion'   => FACEBOOK["app_version"],
    ]);

    /* Percisará da autorização para usar os dados: email */
    $authUrl = $facebook->getAuthorizationUrl([
        "scope" => ["email"]
    ]);

    /* Verifica se o aplicativo está autorizado pelo usuario para fazer o login */
    $error = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRIPPED);
    if($error){
        echo "<h4>Você precisa autorizar para continuar</h4>";
    }

    /* Pega código fornecido pelo facebook */
    $code = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRIPPED);
    if($code){
        $token = $facebook->getAccessToken("authorization_code", [
            "code" => $code;
        ]);

        /* Inicia sessão com os dados do usuário vindas do facebook */
        $_SESSION["userLogin"] = $facebook->getResourceOwner($token);

        /* Atualiza a página  */
        header("Refresh: 0");
    }

    echo '<a href="'.$authUrl.'">Login com Facebook!</a>';

}else {
    /* Dados do Facebook */
    $user = $_SESSION["userLogin"];

    /* fazer um if buscando se já existe um usuário 
    com o email ou fbID já cadastrado, se não tiver 
    usar os dados abaixo e cadastrar*/


    $usuario = new User();
    $usuario->nome = $user->getFirstName(); //pega primeiro nome
    $usuario->sobrenome = $user->getLastName(); //pega sobrenome
    $usuario->email = $user->getEmail(); //pega email
    $usuario->foto = $user->getPictureUrl(); //pega url da imagem do perfil
    $usuario->genero = $user->getGender(); //pega o gênero
    $usuario->fbID = $user->getId(); //pega id do perfil no facebook
    //$usuario->save(); //Salva os dados do usuario no BD

    echo '<a href='?off=true'>Sair</a>'; //link para sair do sistema
    /* Efetua logoff do sistema */
    $off = filter_input(INPUT_GET, "off", FILTER_VALIDATE_BOOLEAN);
    if($off){
        unset($_SESSION["userLogin"]); //encerra sessão do usuário no sistema
        /* Atualiza a página  */
        header("Refresh: 0");
    }
}

ob_end_flush();
