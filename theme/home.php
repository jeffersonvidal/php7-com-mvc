<?php $v->layout("_theme", ["title" => "Usuários"]); ?>

<div class="create">
    <div class="form_ajax" style="display: none"></div>
    
    <form class="form" name="gallery" action="<?= $router->route("form.create");?>" method="post"
          enctype="multipart/form-data">
        <label>
            <input type="text" name="first_name" placeholder="Nome:"/>
        </label>
        <label>
            <input type="text" name="last_name" placeholder="Sobrenome:"/>
        </label>
        <button>Cadastrar Usuário</button>
    </form>
</div>

<section class="users">
    <?php 
        if(!empty($users)):
            foreach ($users as $user):
                $v->insert("user", ["user" => $user]);
            endforeach; 
        endif; 
    ?>
</section>
<!-- Inicia sessão JS para inserir o script na página através do plates -->
<?php $v->start("js");?>

<script>
    $(function (){
        //faz o carregamento da requisição
        function load(action){
            var load_div = $(".ajax_load");
            if(action === "open"){
                load_div.fadeIn().css("display", "flex");
            }else{
                load_div.fadeOut();
            }
        }

        $("form").submit(function(e){
            e.preventDefault(); //evita método http do formulário
        });

        $("body").on("click", "[data-action]", function(e){
            e.preventDefault(); //evita método http do formulário
            var data = $(this).data();
            var div = $(this).parent();

            $.post(data.action, data, function(){
                div.fadeOut();
            }, "json").fail(function(){
                alert("Erro ao processar requisição");
            });
        });
    });
</script>

<?php $v->end();?>
