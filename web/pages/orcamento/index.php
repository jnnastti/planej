<?php

    include('../../../server/redirect.php');

    session_start();
    
    if(!isset($_SESSION['usuarioLogin'])) {
        redireciona('../login/login.php');
    }
    
    if(!isset($_SESSION['empAtiva'])) {
        redireciona('../empresas/index.php');
    }
    
    if(!isset($_SESSION['projAtivo'])) {
        redireciona('../projetos/index.php');
    }
    
    require_once('../../../server/controller/OrcamentoController.php');
?>

<html>
    <head>
        <?php require('../../assets/cmp/headInfo.php'); ?>

        <link href="./stylePopup.css" rel="stylesheet" />

        <title> Planej | Orçamento </title>
    </head>

    <body>
        <?php require('../../assets/cmp/header.php'); ?>

        <main>
            <section class="msg grid-8">
                <h1> Orçamento do projeto </h1>
                <p> 
                    Atualize o orçamento e gastos do seu projeto para ter um controle financeiro mais exato.
                </p>
            </section>
            <section  class="grid-12">
                <div>
                    <h3> últimos orçamentos </h3>
                    <?php 
                        while($orc = $itemOrcamento->fetchArray()) {

                            include('./orcamentoInfo.php');
                            $contador++;
                        }
                    ?>
                </div>

                
            </section>

            <!-- popup de deletar -->
            <div id="deletarModal" class="modalDialog">
                <div>
                    <a href="#" title="Close" class="close">
                        <div class="close-container">
                            <div class="leftright"></div>
                            <div class="rightleft"></div>
                        </div>
                    </a>
                    <h2>Deseja excluir esse orçamento?</h2>
                    <p>Uma vez deletado, todos os dados relacionados ao mesmo serão apagados e não poderão mais ser recuperados.</p>

                    <form method="POST" action="./index.php?action=deletar">
                        <fieldset class="btn">
                            <input type="hidden" name="id" value="<?= $_GET['idorc']; ?>">
                            <a href="#"><button type="button" class="btnSecundario"> Cancelar </button></a>
                            <button type="submit"> Deletar </button>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div id="cadastrarModal" class="modalDialog">
                <div>
                    <a href="#" title="Close" class="close">
                        <div class="close-container">
                            <div class="leftright"></div>
                            <div class="rightleft"></div>
                        </div>
                    </a>
                    <h2>Cadastrar orçamento</h2>

                    <form method="POST" action="./index.php?action=cadastrar">
                        <div class="items">
                            <div class="item obs">
                                <fieldset>
                                    <label> Observação: </label>
                                    <input list="observacao" name="obs" id="obs" />
                                    <datalist id="observacao">
                                        <?php while($op = $itemOrcamento->fetchArray()) : ?>
                                            <option value="<?= $op['destino']; ?>">
                                                <?= $op['destino']; ?> - 
                                                <span id="<?= $op['destino']; ?>">
                                                    R$ <?= $op['receber'];?>
                                                </span>
                                            </option>
                                        <?php endwhile; ?>
                                    </datalist>
                                </fieldset>
                            </div>
                            <div class="item">
                                <fieldset>
                                
                                    <label> Data: </label>
                                    <input type="date" name="dataorcamento" />
                                </fieldset>
                            </div>
                        </div>

                        <div class="items">
                            <div class="item">
                                <fieldset>
                                    <label> Valor total: </label>
                                    <input type="text" name="valorTotal" id="valorTotal" />
                                </fieldset>
                            </div>
                            <div class="item">
                                <fieldset>
                                <label> Valor recebido: </label>
                                    <input type="text" id="valorRecebido" name="valorRecebido" onchange="calculaValorFaltante()" />
                                </fieldset>
                            </div>
                            <div class="item">
                                <fieldset>
                                <label> Valor faltante: </label>
                                    <input type="text" id="valorFaltante" name="valorFaltante" readonly/>
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

        <?php require('../../assets/cmp/footer.php'); ?>
    </body>
    <script src="./main.js"></script>
</html>