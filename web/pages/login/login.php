<?php
    session_start();

    require('../../../server/config.php');
    
    include('../../../server/src/Usuario.php');
    include('../../../server/redirect.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = new Usuario($db);
        $user = $usuario->login($_POST['email'], $_POST['senha']);

        if(is_array($user)) {
            $_SESSION['usuarioLogin'] = $user['codusuario'];
            redireciona('../empresas/index.php');
        }
    }
?>

<html>
    <head>
        <?php require('../../assets/cmp/headInfo.php'); ?>

        <title> Planej | Login </title>

    </head>

    <body>

        <?php require('../../assets/cmp/header.php'); ?>

        <main class="container">
            <section class="msg grid-9">
                <h1> Acesse sua conta </h1>
                <p> Junte-se a mais 130 usuários e deixe seus negócios ainda mais organizados com a ajuda do Planej</p>
            </section>

            <section class="login grid-4">
                <form method="POST" action="./login.php">
                    <fieldset>
                        <input name="email" type="email" placeholder="seu@email.com" autofocus />
                    </fieldset>
                    <fieldset>
                        <input name="senha" type="password" placeholder="senha" />
                    </fieldset>

                    <div>
                        <button type="submit" class="btnPrincipal"> Acessar </button>
                    </div>
                </form>
            </section>

            <section class="grid-4">
                <div class="line"></div>
            </section>

            <section class="redes grid-4">
                <a href="https://instagram.com/jnnastti"><div class="gradient-border">Instagram</div></a>
                <a href="https://twitter.com/jnnastti"><div class="gradient-border">Twitter</div></a>
                <a href="https://github.com/jnnastti"><div class="gradient-border">Github</div></a>
                
                <h1> Siga-nos nas redes sociais </h1>
            </section>
        </main>
    
        <?php require('../../assets/cmp/footer.php'); ?>
    </body>

</html>