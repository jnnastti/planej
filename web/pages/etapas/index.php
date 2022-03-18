<?php

    include('../../../server/redirect.php');

    session_start();
    
    if(!isset($_SESSION['usuarioLogin'])) {
        redireciona('../login/login.php');
    }
    
    if(!isset($_SESSION['empAtiva'])) {
        redireciona('../empresas/index.php');
    }

    if(!isset($_GET['id'])) {
        redireciona('../projetos/index.php');
    }
    
    require_once('../../../server/controller/EtapaController.php');
?>

<html>
    <head>
        <?php require('../../assets/cmp/headInfo.php'); ?>

        <link href="../../assets/styles/formStyle.css" rel="stylesheet" />
        <link href="./stylePopup.css" rel="stylesheet" />

        <title> Planej | Etapas do projeto </title>
    </head>
    <body>
        <?php require('../../assets/cmp/header.php'); ?>

        <main class="container">
            <section class="msg grid-8">
                <h1> Etapas do projeto </h1>
                <p> 
                    Deixe seu projeto ainda mais organizado e deixe todas as etapas 
                    registradas aqui para poder acompanhar seu desempenho até sua conclusão.
                </p>
            </section>

            <section class="grid-12">
                <h3> Etapas registradas </h3>

                <?php while($etp = $etapas->fetchArray()) : ?>

                <div id="checklist" class="grid-12">
                    <input 
                        class="pri" 
                        id="<?php echo $etp['idetapa'];?>" 
                        type="checkbox" 
                        name="r" 
                        value="<?php echo $etp['idetapa'];?>" 
                        onchange="onCheckEtapa(<?php echo $_GET['id'] ?>, <?php echo $etp['idetapa'];?>)"
                        
                        <?php
                            if($etp['situacao'] == 'F') {
                                echo "checked";
                            }
                        ?>
                    >

                    <label for="<?php echo $etp['idetapa'];?>" class="pri">
                        <? echo $etp['descricao']; ?>
                    </label>
                        
                    <label> <?php echo $etp['responsavel'];?></label>
                    <input type="date" value="<?php echo $etp['data_inicio']?>" readonly />
                    <p> - </p>
                    <input type="date" value="<?php echo $etp['data_final']?>" readonly />
                    
                    <button type="button" class="btnPrincipal" onclick="onMostraSubEtapas(<?php echo $etp['idetapa']; ?>)"> v </button>
                    
                    <a href="?id=<?php echo $_GET['id']; ?>&idetapa=<?php echo $etp['idetapa']; ?>#deletarModal" title="Close" class="close">
                        <div class="close-container">
                            <div class="leftright"></div>
                            <div class="rightleft"></div>
                        </div>
                    </a>

                    <div id="collapse<?php echo $etp['idetapa']; ?>" class="collapse">
                        <?php 
                        $subEtapas = $etapa->listarSubEtapas($etp['idetapa'], $idproj);

                        while($subEtp = $subEtapas->fetchArray()) : ?>
                        <input 
                            class="sec"
                            id="<?php echo $subEtp['idetapa']; ?>" 
                            type="checkbox" 
                            name="r" 
                            value="<?php echo $subEtp['idetapa']; ?>" 
                            onchange="onCheckEtapa(<?php echo $_GET['id'] ?>, <?php echo $subEtp['idetapa'];?>)"

                            
                            <?php
                                if($etp['situacao'] == 'F' || $subEtp['situacao'] == 'F') {
                                    echo "checked";
                                }
                            ?>>
                        <label for="<?php echo $subEtp['idetapa']; ?>" class="sec">
                            <?php echo $subEtp['descricao']; ?>
                        </label>

                        <label> <?php echo $subEtp['responsavel'];?></label>
                        <input type="date" value="<?php echo $subEtp['data_inicio']?>" readonly />
                        <p> - </p>
                        <input type="date" value="<?php echo $subEtp['data_final']?>" readonly />

                        <?php endwhile; ?>
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

        <footer>
            <div>
                <p> Desenvolvido por: jnnastti </p>
            </div>
        </footer>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="./main.js"></script>
</html>