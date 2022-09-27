

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Usuário | Projeto para Web com PHP</title>
        <link rel="stylesheet"
            href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Topo //-->
                    <?php 
                        include 'includes/topo.php';
                    ?>
                </div>
            </div>
            <div class="row" style="min-height: 500px;">
                <div class="col-md-12">
                    <!-- Menu //-->
                    <?php 
                        include 'includes/menu.php';
                    ?>
                </div>
                <div class="col-md-10" style="padding-top: 50px;">
                    <!-- Conteúdo //-->
                    <?php
                        require_once 'includes/funcoes.php';
                        require_once 'core/conexao_mysql.php';
                        require_once 'core/sql.php';
                        require_once 'core/mysql.php';

                        if(isset($_SESSION['login'])) {
                            //A função isset() é utilizada para a checagem de determinada variável quando precisamos saber se ela está vazia 
                            //ou já está configurada com algum valor.
                            //no caso de vazia (null) retorna false
                            //se não, retorna true, zero (0) não é considerado um valor null
                            //se o usuario estiver logado
                           $id = (int) $_SESSION['login']['usuario']['id'];
                            //Session verifica qual o id do usuario se ele estiver logado.
                           $criterio = [
                                ['id', '=', $id]
                           ];

                           $retorno = buscar(
                                'usuario',
                                ['id', 'nome', 'email'],
                                $criterio
                           );
                           //função buscar - mysql.php

                           $entidade = $retorno[0];
                        }
                    ?>

                    <h2>Usuário</h2>
                    <form method="post" action="core/usuario_repositorio.php">
                        <input type="hidden" name="acao"
                                value="<?php echo empty($id) ? 'insert' : 'update' ?>">
                        <!--
                        //echo empty($id) ? 'insert' : 'update'
                        // se o id estiver vazio então inserir dados (insert), se não então atualizar dados (update) 
                        -->
                        <input type="hidden" name="id"
                                value="<?php echo $entidade['id'] ?? '' ?>">
                        <!--
                        //echo $entidade['id'] ?? ''
                        //pegar o id na tabela entidade no caso de atualizar dados (update) 
                        -->
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input class="form-control" type="text" 
                                require="required" id="nome" name="nome"
                                value="<?php echo $entidade['nome'] ?? '' ?>">
                        <!--
                        //echo $entidade['nome'] ?? ''
                        //caso houver, utiliza nome armazenado na tabela $entidade (continua o mesmo se não for modificado)
                        -->
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="text" 
                                require="required" id="email" name="email"
                                value="<?php echo $entidade['email'] ?? '' ?>">
                        <!--
                        //echo $entidade['email'] ?? ''
                        // caso houver, utiliza o email armazenado na tabela $entidade (continua o mesmo se não for modificado)
                        -->
                        </div>
                        <?php if(!isset($_SESSION['login'])) : ?>
                          <!--  
                            *apenas se o usuario não estiver logado
                            *campo com valor null -->
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input class="form-control" type="password" 
                                require="required" id="senha" name="senha">
                        <!--
                         criar senha
                        -->
                        </div>
                        <?php endif; ?>
                        <div class="text-right">
                            <button class="btn btn-success"
                                        type="sbmit">Salvar</button>
                        </div>
                    </form>
                <!-- permanece após: -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Rodapé //-->
                    <?php
                        include 'includes/rodape.php';
                    ?>
                </div>
            </div>
        </div>
        <script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
    </body>
</html>
