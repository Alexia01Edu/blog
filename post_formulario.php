<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login | Projeto para Web com PHP</title>
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
                        include 'includes/valida_login.php';
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
                        foreach($_GET as $indice => $dado) {
                        //Valores que chegam pelo método $_GET 
                        //enquanto percorre a array $_GET, também  pega o valor da sua chave.
                        //Um valor é pego a cada repetição ou iteração.
                            $$indice = limparDados($dado);
                        //função limparDados, retira tags indesejadas
                        // A variavel indice, tem nome variavel, ou seja, o nome muda a cada iteração
                        //o valor de $dado sera o nome do $indice 
                        }

                        if(!empty($id)) {
                           // se id não estiver vazio
                            $id = (int)$id;
                            //pegar o id do usuario
                            $criterio = [
                                ['id', '=', $id]
                            ];
                            //armazenar dentro de criterio
                            $retorno = buscar(
                                'post',
                                ['*'],
                                $criterio
                            );

                            $entidade = $retono[0];
                        }
                    ?>
                    <h2>Post</h2>
                    <form method="post" action="core/post_repositorio.php">
                        <input type="hidden" name="acao"
                                value="<?php echo empty($id) ? 'insert' : 'update' ?>">
                        <!--
                        //echo empty($id) ? 'insert' : 'update'
                        //se o id estiver vazio então inserir dados (insert), se não então atualizar dados (update) 
                        -->
                        <input type="hidden" name="id"
                                value="<?php echo $entidade['id'] ?? '' ?>">
                        <!--
                        //echo $entidade['id'] ?? ''
                        //utilizar o id armazenado na tabela $entidade (caso houver)
                        -->
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input class="form-control" type="text" 
                                require="required" id="titulo" name="titulo"
                                value="<?php echo $entidade['titulo'] ?? '' ?>">
                        <!--
                        //echo $entidade['titulo'] ?? ''
                        //caso houver, utilizar o titulo armazenado na tabela $entidad (continua o mesmo se não for modificado)
                        -->
                        </div>
                        <div class="form-group">
                            <label for="texto">Texto</label>
                            <textarea class="form-control" type="text" 
                                require="required" id="texto" name="texto" rows="5">
                                <?php echo $entidade['texto'] ?? '' ?>
                            </textarea>
                        <!--
                        //echo $entidade['texto'] ?? ''
                        //caso houver, utilizar o texto armazenado na tabela $entidade, (continua o mesmo se não for modificado)
                        -->
                        </div>
                        <div class="form-group">
                            <label for="texto">Postar em</label>
                            <?php
                                $data = (!empty($entidade['data_postagem']))?
                                    explode(' ', $entidade['data_postagem'])[0] : '';
                                $hora = (!empty($entidade['data_postagem']))?
                                    explode(' ', $entidade['data_postagem'])[1] : ''; 
                            ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <input class="form-control" type="date"
                                        require="required"
                                        id="data_postagem"
                                        name="data_postagem"
                                        value="<?php echo $data ?>">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" type="time"
                                        require="required"
                                        id="hora_postagem"
                                        name="hora_postagem"
                                        value="<?php echo $hora ?>">
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success"
                                    type="submit">Salvar</button>
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