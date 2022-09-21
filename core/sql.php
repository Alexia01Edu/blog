<?php
function insert (string $entidade, array $dados) : string
{
    //a $entidade é a tabela que essas informações serão inseriras

    $instrucao = "INSERT INTO {$entidade}";
    
    //INSERT INTO: inserir na tabela $entidade

    //implode = Retorna uma string contendo os elementos do array, na mesma ordem com uma ligação entre cada elemento.
    //www.php.net/manual/pt_BR/function.implode.php

    $campos = implode(', ', array_keys($dados));
    
    //CAMPOS que serão inseridos os valores

    //função implode() retorna uma string dos elementos de um array.
    //www.w3schools.com/php/func_string_implode.asp
    //array_keys: Retorna um array de todas as chaves em um array. 
    //ex: www.php.net/manual/pt_BR/function.array-keys.php

    $valores = implode(', ', array_values($dados));
    
    // VALORES que serão inseridos nos campos

    //função implode() retorna uma string dos elementos de um array.
    //array_values: Retorna todos os valores do array num array indexado 'indice' numericamente. 
    //www.php.net/manual/pt_BR/function.array-values.php

    $instrucao .= "({$campos})";
    //a variavel $campos contem todas os campos da tabela do banco de dados que serão preenchidos, armazenados em uma string;
    //ex: Tabela: usuario (dataNasc, nome, email, senha, cpf, telefone);
    //.= Concatenação e Atribuição:'Primeiro concatene $instrução e $campos, depois atribua a string concatenada a $instrução, por exemplo, $a = $a . $b'
    //www.javatpoint.com/php-operators#:~:text=PHP%20Operator%20is%20a%20symbol,and%2010%2C20%20are%20operands

    $instrucao .= "VALUES ({$valores})";
    //para inserir dados no banco de dados é necessario colocar os valores /a variavel: $valores/ contem todos os valores que serão inseridos;
    //VALUES ('".$dataNasc."', '".$nome."','".$email."','".$senha."','".$cpf."','".$telefone."')";
    
    return $instrucao;
    //POR FIM ESSA FUNÇÃO RETORNA A VARIAVEL $instrução QUE SE ENCONTRA ASSIM:
    //INSERT INTO $entidade(string)
    //$campos(string)
    //VALUES $valores(string)
}

function update(string $entidade, array $dados, array $criterio = []): string
{
    $instrucao = "UPDATE {$entidade}";
    //UPDATE: Atuliza dados da tabela $entidade

    foreach($dados as $campo => $dado){
        $set[] = "{$campo} = {$dado}";
        //$campo(chave), campo do banco de dados que sera alterado
        //$dado, o novo valor que sera inserido
    }

    //Foreach: laço de repetição que realiza uma iteração dentro de uma array. 
    //o termo Iteração significa a repetição de uma ou mais ações.

    //www.homehost.com.br/blog/tutoriais/php/php-foreach

    //para cada iteração do laço de repetição, o valor atual da variavel $dados do Array é atribuído ao valor $dado. 
    //enquanto percorremos o array, vamos também estar pegando o valor da sua chave $campo.
    //ex: <?php  foreach ($array as $key => $value) {#codigo}>

    //$set[] é um arraY que utiliza o valor da variavel $campo como chave, para o valor da variavel $dado, eles mudam a cada iteração;
    
    $instrucao .= ' SET ' . implode(', ', $set);
    //O SET comando é usado com UPDATE para especificar quais COLUNAS e VALORES devem ser atualizados em uma tabela.
    //concatenado com o implode: Que retorna uma string dos elementos do array, e os junta com uma outra string ', ' separando eles.
    //O array é o: $set[].

    //www.w3schools.com/sql/sql_ref_set.asp

    if(!empty($criterio)) {
        
    //se a variavel $criterio não estiver vazia

    //celke.com.br/artigo/como-usar-funcao-empty-e-isset-no-php
    // empty serve para saber se uma variável é vazia. 
    //A função empty retornará true (verdadeiro) quando uma variável for vazia 
    //e false (falso) quando uma variável não for vazia.
    //A adição de ! - ponto de exclamação no inicio, significa que a variavel tem que ser DIFERENTE de vazio;
    //Logo ela retornara true (verdadeiro) quando uma variável estiver preenchida 
    //e false (falso) quando uma variável for vazia.
    //só entrara nessa condição se a variavel estiver preenchida;

        $instrucao .= ' WHERE ';
        //ONDE

    //WHERE : comando que filtra um conjunto de resultados que atendem a uma condição especificada.
    //ex: a seguinte instrução SQL seleciona todos os clientes de "México" na tabela "Clientes":
    //SELECT * FROM Clientes
    //WHERE pais ='México';
    //A cláusula WHERE é usada nas instruões SELECT, UPDATE, DELETE, etc.!
    //e utiliza os resultados filtrados para executar alguma das intruções citadas anteriormente.

    //www.w3schools.com/sql/sql_ref_where.asp

        foreach($criterio as $expressao) {
            $instrucao .= ' '. implode(' ', $expressao);
            //condições para o comando where
        }
        //para cada iteração do laço de repetição foreach(), o valor do elemento atual $criterio do array é atribuído ao valor $expressão. 
        //esse valor, nessa variavel, é tranformado em uma string pela função implode e concatenado com um espaço
        //depois concatenado e atribuido a variavel instrução;
    }
    return $instrucao;
    // POR FIM ESSA FUNÇÃO RETORNA A VARIAVEL $instrução QUE SE ENCONTRA ASSIM:
    //UPDATE $entidade
    //SET Colunas = NovosValores;
    //WHERE condições;
}

function delete(string $entidade, array $criterio = []) : string
{
    $instrucao = "DELETE {$entidade}";
    //DELETE: deleta os dados da tabela $entidade
    if(!empty($criterio)) {
    //se a variavel $criterio não estiver vazia
        $instrucao .= ' WHERE ';
    //WHERE = ONDE:
        foreach($criterio as $expressao) {
            $instrucao .= ' ' . implode(' ', $expressao);
            //condições para o comando where
        }
    }
    return $instrucao;
    //POR FIM ESSA FUNÇÃO RETORNA A VARIAVEL $nstrução QUE SE ENCONTRA ASSIM:
    //DELETA $entidade(string)
    //WHERE condições(string);
}

function select(string $entidade, array $campos, array $criterio = [], string $ordem = null) : string
{
    $instrucao = "SELECT " . implode(', ', $campos);
    //SELECT: seleciona o/os campos
    //mostra os valores contidos nos campos
    $instrucao .= " FROM {$entidade}";
    //FROM = Da: tabela $entidade
    if(!empty($criterio)) {
        //se a variavel $criterio não estiver vazia
        $instrucao .= ' WHERE ';
        //ONDE
        foreach($criterio as $expressao){
            $instrucao .= ' ' . implode(' ', $expressao);
            //condições para o comando where
        }
    }
    if(!empty($ordem)) {
        //se a variavel $ordem não estiver vazia
    $instrucao .= " ORDER BY $ordem ";
    //esse comando vai agrupar os valores de $ordem em ordem crescente
    //O ORDER BY : comando é usado para classificar o conjunto de resultados em ordem crescente ou decrescente.
    //Esse comando classifica o conjunto de resultados em ordem crescente (ASC) por padrão. Para classificar os registros em ordem decrescente, use a palavra DESC.
    //ORDER BY $ordem DESC;
    //www.w3schools.com/sql/sql_ref_order_by.asp

}
    return $instrucao;
    //POR FIM ESSA FUNÇÃO RETORNA A VARIAVEL $nstrução QUE SE ENCONTRA ASSIM:
    //SELECT campos(string)
    //FROM $entidade(string)
    //WHERE condições(string);
} 

?>