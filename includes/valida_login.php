<?php

    $_SESSION['url_retorno'] = $_SERVER['PHP_SELF'];
    //PHP_SELF: O nome do arquivo do script atualmente em execução, relativo à raiz do documento(caminho).
    if(!isset($_SESSION['login'])) {
        //se login não existir
        header('Location: login_formulario.php');
        exit;
    }
?>
