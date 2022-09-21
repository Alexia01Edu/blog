<?php
session_start();
require_once '../includes/valida_login.php';
require_once '../includes/funcoes.php';
require_once 'conexao_mysql.php';
require_once 'sql.php';
require_once 'mysql.php';

foreach($_POST as $indice => $dado){
//Valores que chegam pelo método post 
//enquanto percorre a array $$_POST, também  pega o valor da sua chave.
//Um valor é pego a cada repetição ou iteração.
    $$indice = limparDados($dado);
// A variavel indice, tem nome variavel, ou seja, o nome mude muda acada iteração
//o valor de $dado sera o nome do $indice 
}

foreach($_GET as $indice => $dado){
    $$indice = limparDados($dado);
}

$id = (int)$id;
// Pegar o id transformar em int e armazenar em id 
switch($acao){
    //switch - função de repetição
    case 'insert':
        //caso seja para inserir novo dados
        //função sql.php
        $dados = [
            'titulo' => $titulo,
            'texto' => $texto,
            'data_postagem' => "$data_postagem $hora_postagem",
            'usuario_id' => $_SESSION['login'] ['usuario'] ['id']
        ];

        insere(
            'post',
            $dados
        );
        //função (Mysql.php) 'insere' parâmetros: string 'post' (tabela), array $dados;
        //function insere(string $entidade, array $dados) : bool 

        break;

        case 'update':
            //caso seja para atualizar dados existentes
            //função sql.php
            $dados = [
                'titulo' => $titulo,
                'texto' => $texto,
                'data_postagem' => "$data_postagem $hora_postagem",
                'usuario_id' => $_SESSION['login'] ['usuario'] ['id']
            ];

            $criterio = [
                ['id', '=', $id]
            ];
    
            atualiza(
                'post',
                $dados,
                $criterio
            );
    
            break;

            case 'delete':
            //caso seja para deletar dados
            //função sql.php
                $criterio = [
                    ['id', '=', $id]
                ];
        
                deleta(
                    'post',
                    $criterio
                );
        
                break;

    }
    header('Location: ../index.php');  
?>