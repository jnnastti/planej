<?php

    session_start();
    require_once('../../../server/controller/EtapaController.php');

    if(empty($_SESSION['usuarioLogin'])) {
        redireciona('../login/login.php');
    }

    if(empty($_SESSION['empAtiva'])) {
        redireciona('../empresas/index.php');
    }

    // if(empty($_SESSION['projAtivo'])) {
    //     redireciona('../projetos/index.php');
    // }
?>

<html>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&family=Parisienne&family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <link href='https://css.gg/add.css' rel='stylesheet'>

        <link href="../../assets/styles/grid.css" rel="stylesheet" />
        <link href="../../assets/styles/formStyle.css" rel="stylesheet" />
        <link href="../../assets/styles/padrao.css" rel="stylesheet" />
        <link href="../../assets/styles/headAndFooter.css" rel="stylesheet" />

        <link href="./stylePopup.css" rel="stylesheet" />
        <link href="./styles.css" rel="stylesheet" />

        <link rel="icon" href="../../assets/imgs/logo.png" type="image/svg" />

        <meta charset="utf-8">
        <meta name="author" content="Jannaina">
        <meta name="description" content="Organização de projetos com o sistema Planej">
    </head>
    <body>
        <header>
            <div class="header-bar">
                <h1 class="logo"> Planej </h1>
                <ul class="slider-menu">
                    <li> Início </li>
                    <li> Empresas </li>
                    <li> Projetos </li>
                    <li> Relatórios </li>
                    <li> Suporte </li>
                    <li> Login </li>
                </ul>
            </div>
        </header>

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
                    <input type="date" value="<?php echo $etp['data_inicio']?>"/>
                    <p> - </p>
                    <input type="date" value="<?php echo $etp['data_final']?>"/>
                    
                    <button type="button" class="btnPrincipal" onclick="onMostraSubEtapas(<?php echo $etp['idetapa']; ?>)"> v </button>

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
                            
                            <?php
                                if($etp['situacao'] == 'F' || $subEtp['situacao'] == 'F') {
                                    echo "checked";
                                }
                            ?>>
                        <label for="<?php echo $subEtp['idetapa']; ?>" class="sec">
                            <?php echo $subEtp['descricao']; ?>
                        </label>

                        <label> <?php echo $subEtp['responsavel'];?></label>
                        <input type="date" value="<?php echo $subEtp['data_inicio']?>"/>
                        <p> - </p>
                        <input type="date" value="<?php echo $subEtp['data_final']?>"/>

                        <?php endwhile; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </section>

            
            <!-- popup de cadastrar -->
            <div id="cadastrarModal" class="modalDialog">
                <div>
                    <a href="#" title="Close" class="close">
                        <div class="close-container">
                            <div class="leftright"></div>
                            <div class="rightleft"></div>
                        </div>
                    </a>
                    <h2>Cadastrar etapa</h2>

                    <form method="POST" action="./index.php?action=cadastrar">
                        <fieldset>
                            <input type="text" name="descricao" placeholder="Etapa" />
                        </fieldset>
                        <fieldset>
                            <select name="etapaPrincipal">
                                <option value="0"> Etapa principal </option>
                                <?php while($etp = $etapas->fetchArray()) : ?>
                                    <option value="<?php echo $etp[ 'idetapa']?>">
                                        <?php echo $etp['descricao']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </fieldset>
                        <fieldset class="btn">
                            <a href="#"><button type="button" class="btnSecundario"> Cancelar </button></a>
                            <button type="submit" class="btnPrincipal"> Cadastrar </button>
                        </fieldset>
                    </form>
                </div>
            </div>

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
    <script src="./main.js"></script>
</html>