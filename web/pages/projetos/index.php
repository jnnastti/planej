<?php

    include('../../../server/redirect.php');

    session_start();
    
    if(!isset($_SESSION['usuarioLogin'])) {
        redireciona('../login/login.php');
    }

    if(!isset($_SESSION['empAtiva'])) {
        redireciona('../empresas/index.php');
    }

    require_once('../../../server/controller/ProjetoController.php');

?>

<html>
    <head>
        <?php require('../../assets/cmp/headInfo.php'); ?>

        <link href="./stylePopup.css" rel="stylesheet" />

        <title> Planej | Seus projetos </title>
    </head>

    <body>
        <?php require('../../assets/cmp/header.php'); ?>

        <main class="container">
            <section class="msg grid-8">
                <h1> Atualize seus projetos </h1>
                <p> 
                    Sempre é um bom dia para novos negócios. Mantenha as informações dos seus projetos atualizadas ou
                    cadastre um novo e organize de uma forma mais simples seu desenvolvimento.
                </p>
            </section>

            <section class="projetos grid-12">
                <div> 
                    <h3> Projetos em andamento </h3>
                    <?php 
                    
                        while($proj = $projetoAndamento->fetchArray()) {

                            include('./projetoInfo.php');
                            $contador++;
                        }
                    ?>
                </div>

                <div> 
                    <h3> Projetos finalizados </h3>
                    <?php 
                    
                        while($proj = $projetoFinalizado->fetchArray()) {

                            include('./projetoInfo.php');
                            $contador++;
                        }
                    ?>
                </div>

                <div> 
                    <h3> Projetos em orçamento </h3>

                    <?php 
                    
                        while($proj = $projetoOrcamento->fetchArray()) {

                            include('./projetoInfo.php');
                            $contador++;
                        }
                    ?>
                </div>
            </section>

            <?php require('./popups.php'); ?>

            <div>
                <a href="./formulario/index.php">
                    <button type="button" class="adicionar">
                        <img src="../../assets/imgs/add.svg">
                    </button>
                </a>
            </div>
        </main>

        <?php require('../../assets/cmp/footer.php'); ?>
    </body>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="main.js"></script>
</html>