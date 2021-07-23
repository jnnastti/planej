<?php
    session_start();

    require('../../../server/config.php');
    
    include('../../../server/src/Empresa.php');
    include('../../../server/redirect.php');

    if(empty($_SESSION['usuarioLogin'])) {
        redireciona('../login/login.php');
    }

    $empresa = new Empresa($db);
    $itemEmpresa = $empresa->listarEmpresas($_SESSION['usuarioLogin']);

    $action = (isset($_REQUEST['action'] )) ? $_REQUEST['action']  : '';

    switch($action) {
        case 'deletar': {
            $empresa->deletarEmpresa($_POST['id']);
            redireciona('./index.php');
            break;
        }
        case 'editar': {
            $empresa->editarEmpresa($_POST['nome'], $_POST['id']);
            redireciona('./index.php');
            break;
        }
        case 'cadastrar': {
            $empresa->cadastrarEmpresa($_POST['nome'], $_SESSION['usuarioLogin']);
            redireciona('./index.php');
            break;
        }
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

                <?php while($emp = $itemEmpresa->fetchArray()) : ?>

                <div class="emp grid-4" id="emp0">
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
                        <button class="grid-6" onclick="selecionarEmpresa(<?php echo $emp['idemp']; ?>)"> Selecionar </button>
                    </div>
                </div>

                <?php endwhile; ?>

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