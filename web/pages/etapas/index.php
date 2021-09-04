<?php

    session_start();
    require_once('../../../server/controller/EtapaController.php');

    if(empty($_SESSION['usuarioLogin'])) {
        redireciona('../login/login.php');
    }

    if(empty($_SESSION['empAtiva'])) {
        redireciona('../empresas/index.php');
    }

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
                        <input type="hidden" name="projeto" value="<?php echo $_GET['id']; ?>">
                        <fieldset>
                            <input type="text" name="descricao" placeholder="Etapa" />
                        </fieldset>
                        <fieldset>
                            <select name="subetapa">
                                <option value="0" selected> Etapa principal </option>
                                <?php while($etp = $etapas->fetchArray()) : ?>
                                    <option value="<?php echo $etp['idetapa']?>">
                                        <?php echo $etp['descricao']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </fieldset>
                        
                        <fieldset>
                            <input type="text" name="responsavel" placeholder="Responsável" />
                        </fieldset>

                        <div class="items">
                            <div class="item">
                                <fieldset>
                                    <label> Início: </label>
                                    <input type="date" name="dataini" />
                                </fieldset>
                            </div>
                            <div class="item">
                                <fieldset>
                                <label> Fim: </label>
                                    <input type="date" name="datafim" />
                                </fieldset>
                            </div>
                        </div>

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