<?php

    session_start();

    require('../../../server/config.php');
    require('../../../server/src/Usuario.php');
    
    include('../../../server/src/Empresa.php');
    include('../../../server/redirect.php');

    $usuario = new Usuario($db);

    if(!$usuario->verificacao($_SESSION['loginUsuario'])) {
        $empresa = new Empresa($db);

        $itemEmpresa = $empresa->listarEmpresas($_SESSION['LoginUsuario']);
    } else {
        redireciona('../login/login.php');
    }
?>

<html>
    <head>
        <?php require('../../assets/cmp/headInfo.php'); ?>

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

                <?php foreach($itemEmpresa as $emp) : ?>

                <div class="emp grid-4" id="emp0">
                    <a href="#deletarModal?id=<?php echo $emp['idemp']; ?>">
                        <div class="close-container">
                            <div class="leftright"></div>
                            <div class="rightleft"></div>
                        </div>
                    </a>

                    <div class="nome">
                        <span> <?php echo $emp['nome'][0]; ?> </span>
                        <h2> <?php echo $emp['nome']; ?> </h2>
                    </div>

                    <p> Porcentagem de conclusão </p>
                    <div class="porcentagem">
                        <div class="total"></div>
                    </div>

                    <div>
                        <a href="#editarModal?id=<?php echo $emp['idemp']; ?>"><button class="grid-6"> Editar </button></a>
                        <button class="grid-6" onclick="selecionarEmpresa(<?php echo $emp['idemp']; ?>)"> Selecionar </button>
                    </div>
                </div>

                <?php endforeach; ?>

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