<?php

require_once 'includes/funcoes.php';
require_once 'core/conexao_mysql.php';
require_once 'core/sql.php';
require_once 'core/mysql.php';

foreach($_GET as $indice => $dado) {
    $$indice = limparDados($dado);
}

$posts = buscar (
    'post', 
    [
        'titulo',
        'data_postagem',
        'texto',
        '(select nome
            from usuario
            where usuario.id = post.usuario_id) as nome'
    ],
    [
        ['id', '=', $post]
    ]

);
//buscar post por titulo, data, texto, nome do usuario e id;
$post = $posts[0];
//post recebe o array posts na posição zero
$data_post = date_create($post['data_postagem']);
//recebe a data da postagem armnazenado na variavel $post
//data está no formato padrão ingles
$data_post = date_format($data_post, 'd/m/Y H:i:s');
//data_format: modifica o formato da data para o formato brasileiro

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $post ['titulo']?></title>
<link rel="stylesheet"
        href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    include 'includes/topo.php';
                ?>
            </div>
        </div>
        <div class="row" style="min-height: 500px;">
            <div class="col-md-12">
                <?php
                    include 'includes/menu.php';
                ?>
            </div>
            <div class="col-md-10" style="padding-top: 50px;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $post['titulo']?></h5>
                    <!-- mostra o titulo do post -->
                    <h5 class="card-subtitle mb-2 text-muted">
                        <?php echo $data_post?> Por <?php echo $post['nome']?>
                    </h5>
                    <!-- mostra a data formada da postagem, seguido do nome do usuario -->
                    <div class="cart-text">
                        <?php echo html_entity_decode($post['texto']) ?>
                    </div>
                    <!--desfaz o efeito do htmlentities() da função limpar dados, 
                    ela decodifica as entidades HTML e as tranforma em caracteres de novo-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php 
                    include 'includes/rodape.php';
                ?>
            </div>
        </div>
    </div>
    <script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
</body>
</html>