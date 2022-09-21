<?php
    session_start();
?>
<div class="card">
    <div class="card-header">
        <h1> Projeto Blog em PHP + MySQL IFSP - Alexia</h1>
    </div>
    <?php if(isset($_SESSION['login'])): 
        // se o usuario logar ?>
    
    <div class="card-body text-right">
        Olá <?php echo $_SESSION['login']['usuario']['nome']?>
        <!-- mostrar o nome do usuario -->
        <a href="core/usuario_repositorio.php?acao=logout"
            class="btn btn-link btn-sm" role="button">Sair</a>
    </div>
    <?php endif ?>
</div>