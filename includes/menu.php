<div class="card">
    <div class="card-header">
        Menu
    </div>
    <div class="card-body">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav flex-column">
                <a class="nav-link" href="usuario_formulario.php">Cadastre-se</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login_formulario.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="post_formulario.php">Incluir Post</a>
            </li>
            <?php if ((isset($_SESSION['login']))
                    && ($_SESSION['login']['usuario']['adm'] === 1)) : 
            //Uma sessão é iniciada com a session_start() função. 

            //As variáveis ​​de sessão são definidas com a variável global do PHP: $_SESSION 

            //Quando você utiliza um aplicativo, faz algumas alterações e depois o fecha. Isso é muito parecido com uma Sessão. O computador sabe quem você é. Ele sabe quando você inicia o aplicativo e quando você termina. Mas na internet há um problema: o servidor web não sabe quem você é ou o que você faz, porque o endereço HTTP não mantém o estado. 

            //As variáveis ​​de sessão resolvem esse problema armazenando informações do usuário para serem usadas em várias páginas (por exemplo, nome de usuário, cor favorita etc.). Por padrão, as variáveis ​​de sessão duram até que o usuário feche o navegador. 

            //Então; As variáveis ​​de sessão contêm informações sobre um único usuário e estão disponíveis para todas as páginas em um aplicativo.
            //$_SESSION['login'] = contem o login do usuario 

            //$_SESSION['login']['usuario']['adm'] === 1 se o login do usuário, logado, o id e o adm for igual a 1; ?>
            <li class="nav-item">
                <a class="nav-link" href="usuarios.php">Usuários</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
