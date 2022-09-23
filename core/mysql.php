<?php
//esse codigo tem as funções responsaveis por criar os parametros para as funções do sql.php
//E as conecta com o banco de dados
//depois as desconecta
//utilizando as funções tipicas do mysql
//

function insere(string $entidade, array $dados) : bool
{
    //
    $retorno = false;

    foreach ($dados as $campo => $dado) {
        //comando de repetição
        //a cada repetição a variavel $dado recebe um valor do array $dados;
        //assim como sua chave do array contida na variavel $campo;
        //a chave é um campo do banco de dados 
        $coringa[$campo] = '?';
        //$coringa é um array que na posição/chave $campo
        //recebe o valor "?";
        $tipo[] = gettype($dado) [0];
        //$tipo[], array que recebe os tipos da variavel dado;
        //gettype - comando que obtem o tipo da variável:
        //"boolean","integer","double(float)", "string","array","object"....
        //parametro $dado, qual o tipo de valor da variavel $dado
        $$campo = $dado;
        //a variavel campo já possuia um valor atribuido a ela
        //agora esse valor passa ser o nome da variavel

        //o sinal $$:
        // variáveis com nomes variáveis.
        //Uma variável variável obtém o valor de uma variável e a trata como o nome de uma variável.
        //www.php.net/manual/pt_BR/language.variables.variable.php
    }

    $instrucao = insert($entidade, $coringa);
    //insert função do sql.php criada em sql.php 
    //utlizando os parametros $entidade, $coringa[] para (string $entidade, array $dados);
    //retornando a $intrucao gerada na função insert para ser armazenda dentro da $instrução;

    $conexao = conecta();
     //a função conecta, conecta ao banco de dados
    //criado no conexao.php
    //a conexao com o banco fica armazenada na variavel $conexao

    $stmt = mysqli_prepare($conexao, $instrucao);
    //retorna: Um objeto de instrução em caso de sucesso e FALSO em caso de falha
    //Prepara a Query SQL e retorna um identificador de instrução a ser usado para outras operações na instrução. A Query deve consistir em uma única instrução SQL.
    //https://www.php.net/manual/pt_BR/mysqli.prepare.php

     //EX:
    //$mysqli = new mysqli("localhost", "my_user", "my_password", "world");
    //$city = "Amersfoort";
    //$stmt = $mysqli->prepare("SELECT District FROM City WHERE Name=?");
    //$mysqli->prepare = mysqli_prepare

    //Parâmetros 
    //$conexao(link): Somente no estilo procedural: Um recurso link retornado por mysqli_connect() ou mysqli_init()link / Conexao.php
    //Query: A Query, como uma string. Deve consistir em uma única instrução SQL.
    //O modelo de instrução pode conter zero ou mais marcadores de parâmetro de ponto de interrogação (?)⁠—também chamados de espaços reservados. 
    //Nota:Os marcadores são válidos apenas em determinados locais nas instruções SQL. 
    //Por exemplo, eles são permitidos na lista VALUES() de uma instrução INSERT (para especificar valores de coluna para uma linha) 
    //ou em uma comparação com uma coluna em uma cláusula WHERE para especificar um valor de comparação.
    //No entanto, eles não são permitidos para identificadores (como nomes de tabelas ou colunas) 
    //ou para especificar ambos os operandos de um operador binário, como o sinal de igual =. 
    //A última restrição é necessária porque seria impossível determinar o tipo de parâmetro. 
    //Em geral, os parâmetros são válidos apenas em instruções DML (Data Manipulation Language), e não em instruções DDL (Data Definition Language).
    //Os marcadores de parâmetro devem ser vinculados às variáveis ​​do aplicativo usando mysqli_stmt_bind_param() antes de executar a instrução.

    //Query: https://rockcontent.com/br/blog/query/
    //Query: instrução/comando SQL, pode insirir, atualizar, selecionar e excluir registros.
    //Em uma interpretação mais simples, são comandos que, ao serem executados, retornam com informações já armazenadas.



    eval('mysqli_stmt_bind_param($stmt, \'' . implode('',$tipo) . '\', $' . implode(', $', array_keys($dados)) . ');');
    //mysqli_stmt_bind_param : junta a $intrução criada pelas funções com os dados inseridos no formulario
    //depois manda eles para o banco de dados.
    //eval : Executa uma string dada no parametro (), como se ela fosse um código PHP

    mysqli_stmt_execute($stmt);
    //mysqli_stmt_execute: Executa uma instrução preparada, armazenada dentro da variavel $stmt

    $retorno = (boolean) mysqli_stmt_affected_rows($stmt);
    //Retorna o número total de linhas alteradas(UPDATE), excluídas(DELETE), inseridas(INSERT) ou correspondidas(SELECT) pela última instrução executada;

    $_SESSION['errors'] = mysqli_stmt_error_list($stmt);
    //Retorna uma lista de erros da última instrução executada
    //Uma lista de erros, cada um como um array associativo contendo errno, error e sqlstate.
    //EX:
    //Variedade (
    //[0] => Matriz
        //(
            //[errno] => 1146
            //[sqlstate] => 42S02
            //[erro] => A tabela 'world.myCountry' não existe
        //))

    mysqli_stmt_close($stmt);
    //Fecha uma instrução preparada
    //Se a instrução atual tiver resultados pendentes ou não lidos, esta função os cancela para que a próxima instrução possa ser executada.

    desconecta($conexao);
    //função que desconecta o canco de dados, armazenado, na variavel $conexao

    return $retorno;
    //retorna uma variavel bollean caso ?
}

function atualiza(string $entidade, array $dados, array $criterio = []) : bool
{
    //boll => boleano
    //atualiza a tabela $entidade

    $retorno = false;
    
    foreach ($dados as $campo => $dado) {
        //a cada iteração $dado recebe um valor do array $dado
        $coringa_dados[$campo] = '?';
        //o array coringa_dado recebe esse valor na chave $campo correspondente
        //EX: ($campo)nome=>($dado)Bruna
        $tipo[] = gettype($dado) [0];
        //armazena o tipo de valor da variavel dado no array $tipo

        $$campo = $dado;
        //o nome da variavel campo é variavel;  ?
    }

    foreach ($criterio as $expressao) {
    //para cada iteração do laço de repetição foreach(), o valor do elemento atual $criterio do array é atribuído a variavel $expressão. 

        $dado = $expressao[count($expressao) -1];
        //$dado recebe o valor do array $expressão na posição [número de elementos do array subtraindo 1, pois um array começa do elemento zero]
        //count: Conta o número de elementos de uma variável, ou propriedades de um objeto;
        //
        $tipo[] = gettype($dado) [0];
        //armazena o tipo de dado da variavel $dado dentro do array tipo

        $expressao[count($expressao) -1] = '?';
        //o array expressao recebe esse valor na posição correspondente [número de elementos do array subtraindo 1, pois um array começa do elemento zero]

        $coringa_criterio[] = $expressao;
        //o array $coringa_criterio recebe o valor armazenado na variavel $expressão

        $nome_campo = (count($expressao) < 4) ? $expressao[0] : $expressao[1];
        //Operador ternário: versão compacta do if.
        //Primeiro declaramos a condição; logo após o sinal de interrogação (?), 
        //o código a ser executado caso a condição seja verdadeira; 
        //e depois dos dois pontos ':', o código a ser executado caso contrário.
        //a variavel nome_campo recebe, $expressao na posição 0 se o numero de elementos da $variavel for menor que 4
        //se não recebe $expressão na posição 1;

        if(isset($nome_campo)) {
            //se a variavel campo existir e tiver valor diferente de null;
            $nome_campo = $nome_campo . '_' . rand();
            //o valor da variavel da variavel $nome_campo é concatenado com '_' e depois com o valor gerado pela função rand();
            //rand() = Gera um inteiro aleatório
            //possui parametros min e max opcionais
            //rand(int $min, int $max), o número inteiro gerado está entre ou é igual a esses dois números
        }

        $campos_criterio[] = $nome_campo;
        //o array recebe o valor da variavel $nome_campo

        $$nome_campo = $dado;
        //nome_campo tem nome variavel
    }
    
    $instrucao = update($entidade, $coringa_dados, $coringa_criterio);
    //A variavel $intrução recebe o valor da função update do sql.php com os parametros entre parenteses()
    //function update(string $entidade, array $dados, array $criterio = []): string
   
    $conexao = conecta();
    //$conexao recebe a conexão para banco de dados

    $stmt = mysqli_prepare($conexao, $instrucao);
    //prepara a intrução

    if(isset($tipo)) {
        //isset: se a variavel existir e for diferente de null

        $comando = 'mysqli_stmt_bind_param($stmt, ';
        $comando .= "'" . implode('', $tipo). "'";
        $comando .= ', $' . implode(', $', array_keys($dados));
        $comando .= ', $' . implode(', $', $campos_criterio);
        $comando .= ');';
        //junta a intrução sql com os dados do formulario
        //array_keys($dados) ira receber o nome dos campos da tabela, que também são as chaves dos arrays
        //depois vai concatenar com o array $campos_criterio

        eval($comando);
        //le comando como uma instrução php
    }

    mysqli_stmt_execute($stmt);
    //executa uma instrução preparada

    $retorno = (boolean) mysqli_stmt_affected_rows($stmt);
    //retorna uma variavel bollean ?

    $_SESSION ['errors'] = mysqli_stmt_error_list($stmt);
    //mostra apenas o erro 'errors'

    mysqli_stmt_close($stmt);
    //fecha uma instrução

    desconecta($conexao);

    return $retorno;
}

function deleta(string $entidade, array $criterio = []) : bool
{
    $retorno = false;

    $coringa_criterio = [];

    foreach ($criterio as $expressao) {
        $dado = $expressao[count($expressao) -1];

        $tipo[] = gettype($dado) [0];
        $expressao[count($expressao) -1] = '?';
        $coringa_criterio[] = $expressao;

        $nome_campo = (count($expressao) < 4) ? $expressao[0] : $expressao[1];

        $campos_criterio[] = $nome_campo;

        $$nome_campo = $dado;
    }
    $instrucao = delete($entidade, $coringa_criterio);

    $conexao = conecta();

    $stmt = mysqli_prepare($conexao, $instrucao);

    if(isset($tipo)) {
        $comando = 'mysqli_stmt_bind_param($stmt, ';
        $comando .= "'" . implode('', $tipo). "'";
        $comando .= ', $' . implode(', $', $campos_criterio);
        $comando .= ');';

        eval($comando);
    }

    mysqli_stmt_execute($stmt);

    $retorno = (boolean) mysqli_stmt_affected_rows($stmt);

    $_SESSION ['errors'] = mysqli_stmt_error_list($stmt);

    mysqli_stmt_close($stmt);

    desconecta($conexao);

    return $retorno;
    }

    function buscar(string $entidade, array $campos = ['*'], array $criterio = [], string $ordem = null ) : array
    {
        $retorno = false;
    
        $coringa_criterio = [];
        
        foreach ($criterio as $expressao) {
            $dado = $expressao[count($expressao) -1];
            
            $tipo[] = gettype($dado) [0];
            $expressao[count($expressao) - 1] = '?';
            $coringa_criterio[] = $expressao;
    
            $nome_campo = (count($expressao) < 4) ? $expressao[0] : $expressao[1];

            if(isset($nome_campo)) {
                $nome_campo = $nome_campo . '_' . rand();
            }
    
            $campos_criterio[] = $nome_campo;
    
            $$nome_campo = $dado;
        }
        $instrucao = select($entidade, $campos, $coringa_criterio, $ordem);
        
        $conexao = conecta();
    
        $stmt = mysqli_prepare($conexao, $instrucao);
    
        if(isset($tipo)) {
            $comando = 'mysqli_stmt_bind_param($stmt, ';
            $comando .= "'" . implode('', $tipo). "'";
            $comando .= ', $' . implode(', $', $campos_criterio);
            $comando .= ');';
    
            eval($comando);
        }
    
        mysqli_stmt_execute($stmt);

     if($result = mysqli_stmt_get_result($stmt)){
         //armazena recebe:
         //A função PHP mysqli_stmt_get_result() retorna um conjunto de resultados se a instrução executada for SELECT e se for bem-sucedida. 
         //Em outros cenários esta função retorna FALSE.

        $retorno = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //Busque todas as linhas e retorne o conjunto de resultados como uma matriz associativa:


        mysqli_free_result($result);
        //Libera a memória associada ao resultado
     }
        $_SESSION ['errors'] = mysqli_stmt_error_list($stmt);
    
        mysqli_stmt_close($stmt);
    
        desconecta($conexao);

        $retorno = $retorno;
    
        return $retorno;
        }

?>