<?php $v->layout("_theme");?>

<div class="users">
    <?php if($users): 
        foreach ($users as $user):
            ?>
            <article class="users_user">
                <h3><?= $user->nome, " ", $user->sobrenome; ?></h3>
            </article>
            <?php
        endforeach;
    else:
        ?>
    
    <h4>Não existem usuários cadastrados.</h4>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, aperiam.</p>

    <?php
    endif; ?>
</div>