<?php
namespace Source\Support;

use CoffeeCode\Optimizer\Optimizer;

class Seo
{
    protected $optimizer;

    public function __construct(string $schema = "article")
    {
        $this->optimizer = new Optimizer();
        $this->optimizer->openGraph(
            SITE, 
            "pt-br", 
            $schema
        )->publisher(
            SEO_SMO["fbPage"], //página facebook
            SEO_SMO["fbProfile"] //ID do perfil
        )->twitterCard(
            SEO_SMO["twCreator"], //criador - @perfilCriador (@professorvidal)
            SEO_SMO["twSite"], //site - @perfilMinhaPagina (@vidalcorp)
            SEO_SMO["twDominio"] //dominio - meusite.com.br
        )->facebook(
            SEO_SMO["fbAppID"] //appid
        );
    } 

    public function  render(string $title, string $description, string $url, string $image, bool $follow = true): string
    {
        return $this->optimizer->optimize(
            $title, //titulo da página  que vai aparecer no compartilhamento
            $description, //descrição da página  que vai aparecer no compartilhamento
            $url, //url do conteúdo  que vai aparecer no compartilhamento
            $image, //imagem que vai aparecer no compartilhamento
            $follow //follow
        )->render();
    }
}
