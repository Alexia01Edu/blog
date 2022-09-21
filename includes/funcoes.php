<?php
    function limparDados(string $dado) : string
    {
       $tags = '<p><strong><i><ul><ol><li><h1><h2><h3>';
       $retorno = htmlentities(strip_tags($dado, $tags));
       return $retorno;
    }
//A função strip_tags() retira uma string de dentro das tags HTML, XML e PHP. Especificada pela variavel $tags;
//A função htmlentities() converte caracteres em entidades HTML.
//A conversão de caracteres em entidades costuma ser usada para impedir que os navegadores o usem como um elemento HTML. 
?>