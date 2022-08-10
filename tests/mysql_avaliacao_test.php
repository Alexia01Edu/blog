<?php

require_once '../includes/funcoes.php';
require_once '../core/conexao_mysql.php';
require_once '../core/sql.php';
require_once '../core/mysql.php';

insert_teste(5, 'amo esse post', 1, 1);
buscar_teste();
update_teste(2, 5, 'lindo!!!');
buscar_teste();

function insert_teste($nota, $comentario, $usuario_id, $post_id) : void
{
    $dados = ['nota' => $nota, 'comentario' => $comentario, 'usuario_id' => $usuario_id, 'post_id' => $post_id];
    insere('avaliacao', $dados);
}
function buscar_teste() : void 
{
    $avaliacoes = buscar('avaliacao', [ 'id', 'nota', 'comentario', 'usuario_id', 'post_id'], [], '');
    print_r($avaliacoes);
}
function update_teste($id, $nota, $comentario) : void
{
    $dados = ['nota' => $nota, 'comentario' => $comentario];
    $criterio = [['id', '=', $id]];
    atualiza('avaliacao', $dados, $criterio);
}

//INSERT INTO post (titulo, texto, usuario_id, data_postagem) VALUES ('orgulho e preconceito', 'jane austen', 3, '2022/01/05');
?>