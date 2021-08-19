<?php

    session_start();
    // require_once('../../../server/controller/ProjetoController.php');

    if(empty($_SESSION['usuarioLogin'])) {
        redireciona('../login/login.php');
    }

    if(empty($_SESSION['empAtiva'])) {
        redireciona('../empresas/index.php');
    }

    if(empty($_SESSION['projAtivo'])) {
        redireciona('../projetos/index.php');
    }
?>

<html>
    <head>
        <?php require('../../assets/cmp/headInfo.php'); ?>

        <!-- <link href="./stylePopup.css" rel="stylesheet" /> -->

        <title> Planej | Orçamento </title>
    </head>

    <body>
        <?php require('../../assets/cmp/header.php'); ?>

        <main>
            <section class="msg grid-8">
                <h1> Orçamento do projeto </h1>
            </section>
        </main>

        <?php require('../../assets/cmp/footer.php'); ?>
    </body>

</html>