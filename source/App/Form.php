<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\User;

class Form
{
    /** @var Engine */
    private $view;

    public function __construct($router)
    {
        $this->view = Engine::create(
            dirname(__DIR__, 2) . "/theme", //pasta do theme
            "php" //extensão dos arquivos da pasta theme
        );

        $this->view->addData(["router" => $router]); //deixa a variável $router como global
    }

    public function home(): void
    {
        echo $this->view->render("home",[
            "users" => (new User())->find()->order("nome")->fetch(true)
        ]);
    }

    public function create(array $data): void
    {
        $callback["data"] = $data;
        echo json_encode($data);
    }

    public function delete(array $data): void
    {
        if(empty($data["id"])){
            return;
        }

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $user = (new User())->findById($id);

        if($user){
            $user->destroy();
        }

        $callback["remove"] = true;
        echo json_encode($callback);
    }
}
