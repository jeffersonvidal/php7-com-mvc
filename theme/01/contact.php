<?php $v->layout("_theme");?>

<div class="contact">
    <h2>Fale conosco!</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus hic incidunt eaque? In, assumenda eos.</p>

    <form action="<?= url();?>" enctype="multipart/form-data" method="post">
        <input type="text" name="name" placeholder="Seu nome" id="">
        <input type="email" name="email" placeholder="Seu email" id="">
        <textarea name="message" placeholder="Mensagem" rows="3" id="" cols="30"></textarea>
        <button>Enviar Mensagem</button>
    </form>

</div>

<!-- insere scripts no bloco scripts do template -->
<?php $v->start("scripts");?>
<script>
    $(function(){
        $("button").after('<button type="reset">LIMPAR</button>')
    });
</script>
<?php $v->end();?>

<!-- Bloco insere sidebar / menu no template -->
<?php $v->start("sidebar");?>
<a href="<?= url();?>">Voltar</a>
<?php $v->end();?>