<?php

    session_start();
    require_once('../../../server/controller/EmpresaController.php');

    if(empty($_SESSION['usuarioLogin'])) {
        redireciona('../login/login.php');
    }
?>

<html>
    <head>
        <?php require('../../assets/cmp/headInfo.php'); ?>

        <link href="../../assets/styles/formStyle.css" rel="stylesheet" />
        <link href="./stylePopup.css" rel="stylesheet" />

        <title> Planej | Suas empresas </title>
    </head>

    <body>
        <?php require('../../assets/cmp/header.php'); ?>

        <main class="container">
            <section class="msg grid-8">
                <h1> Verifique suas empresas </h1>
                <p> 
                    Selecione a empresa registrada para ver seus projetos e editar suas informações 
                    ou cadastre uma nova e organize de uma forma mais simples seu desenvolvimento.
                </p>
            </section>

            <section class="empresas grid-12">

                <?php while($emp = $itemEmpresa->fetchArray()) : ?>

                <div class="emp grid-3" id="emp<?php echo $contador; ?>">
                    <a href="?id=<?php echo $emp['idemp']; ?>#deletarModal">
                        <div class="close-container">
                            <div class="leftright"></div>
                            <div class="rightleft"></div>
                        </div>
                    </a>

                    <div class="nome">
                        <span> <?php echo $emp['nome'][0]; ?> </span>
                        <h2> <?php echo $emp['nome']; ?> </h2>
                    </div>

                    <div>
                        <a href="?id=<?php echo $emp['idemp']; ?>#editarModal"><button class="grid-6"> Editar </button></a>
                        
                        <form class="btnSelecionar" action="./index.php?action=selecionar" method="POST">
                            <input type="hidden" name="id" value="<?php echo $emp['idemp']; ?>">
                            <button class="grid-6" type="submit"> Selecionar </button>
                        </form>
                    </div>
                </div>

                <?php $contador++; endwhile; ?>

            </section>

            <?php require('./popups.php'); ?>

            <div>
                <a href="#cadastrarModal">
                    <button type="button" class="adicionar">
                        <img src="../../assets/imgs/add.svg">
                    </button>
                </a>
            </div>
        </main>

        <?php require('../../assets/cmp/footer.php'); ?>
    </body>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="./main.js"></script>
</html>