<?php $v->layout("_theme");?>

<div class="error">
    <h2>Oooops Erro <?= $error; ?>!</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus hic incidunt eaque? In, assumenda eos.</p>
</div>

<!-- Bloco insere sidebar / menu no template -->
<?php $v->start("sidebar");?>
<a href="<?= url();?>">Voltar</a>
<?php $v->end();?>