<?php

namespace Source\App;
use League\Plates\Engine;
use Source\Models\User;
use Source\Support\Seo;

class Web
{
    private $view;
    private $seo;

    public function __construct()
    {
        $this->view = Engine::create(__DIR__ . "/../../theme","php"); //diretório do tema
        $this->seo = new Seo();
    }
    /* cada método é uma área de seu site */
    public function home(): void
    {
        $users = (new User())->find()->fetch(true);
        /* Enviando dados de SEO/SMO para o cabeçalho da página */
        $head = $this->seo->render(
            "Home | " . SITE,
            "Lorem ipsum dolor sit amet consectetur adipisicing.", //description
            url(), //url
            "https://via.placeholder.com/1200x628?text=Home+Cover" //image
        );

        echo $this->view->render("home",[
            "head" => $head,
            "users" => $users
        ]);
        //var_dump($users);
    }

    public function blog($data): void
    {
        echo "<h1>Web BLOG</h1>";
        var_dump($data);
    }

    public function post($data): void
    {
        echo "<h1>Web ARTIGO</h1>";
        var_dump($data);
    }

    public function category($data): void
    {
        echo "<h1>Web CATEGORIA</h1>";
        var_dump($data);
    }
    
    public function contact($data): void
    {
        /* Enviando dados de SEO/SMO para o cabeçalho da página */
        $head = $this->seo->render(
            "Contato | " . SITE,
            "Lorem ipsum dolor sit amet consectetur adipisicing.", //description
            url(), //url
            "https://via.placeholder.com/1200x628?text=Contato+Cover" //image
        );
        echo $this->view->render("contact",[
            "head" => $head
        ]);
    }

    public function error(array $data): void
    {
        /* Enviando dados de SEO/SMO para o cabeçalho da página */
        $head = $this->seo->render(
            "Erro  {$data['errcode']} | " . SITE,
            "Lorem ipsum dolor sit amet consectetur adipisicing.", //description
            url("ops/{$data['errcode']}"), //url
            "https://via.placeholder.com/1200x628?text=Error+{$data['errcode']}" //image
        );
        echo $this->view->render("error",[
            "head" => $head,
            "error" => $data["errcode"]
        ]);
    }
}


