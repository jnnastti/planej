<?php

    session_start();

    require('../../../../server/config.php');

    include('../../../../server/src/Projeto.php');
    include('../../../../server/redirect.php');

    if(empty($_SESSION['usuarioLogin'])) {
        redireciona('../../login/login.php');
    }

    if(empty($_SESSION['empAtiva'])) {
        redireciona('../../empresas/index.php');
    }

    $projeto = new Projeto($db);

    $existeProjeto = false;

    if(isset($_GET['id'])) {
        $projetoInfo = $projeto->selecionarProjeto($_GET['id']);
        $existeProjeto = true;
    }

    function verificaSituacao($situacao, $valor) {
       return $situacao == $valor;
    }
?>

<html>
    <head>
        <?php require('../../../assets/cmp/subpages/headInfo.php'); ?>

        <link href="../../../assets/styles/formStyle.css" rel="stylesheet" />

        <title> Planej | Configure seu projeto </title>
    </head>

    <body>

        <?php require('../../../assets/cmp/subpages/header.php'); ?>

        <main class="container">
            <h2>Configure seu projeto</h2>
            <p>É de extrema importância que os dados de seu projeto estejam sempre em dia para que você 
                possa acompanhar seu crescimento.
            </p>

            <form>
                <fieldset>
                    <label> Nome do projeto: </label>
                    <input type="text" placeholder="Nome" value="<?php echo $existeProjeto ? $projetoInfo['nome'] : ""; ?>"/>
                </fieldset>
                <fieldset>
                    <label> Nome do proprietário: </label>
                    <input type="text" placeholder="Nome do proprietário" value="<?php echo $existeProjeto ? $projetoInfo['nome_proprietario'] : ""; ?>"/>
                </fieldset>

                <div class='items'>
                    <div class='item'>
                        <fieldset>
                            <label> CPF/CNPJ do proprietário: </label>
                            <input type='text' name='cpfcnpj' placeholder="CPF ou CNPJ do proprietário" value="<?php echo $existeProjeto ? $projetoInfo['cpf_proprietario'] : ""; ?>"/>
                        </fieldset>
                    </div>
                    <div class='item'>    
                        <fieldset>
                            <label> Contato do proprietário: </label>
                            <input type='text' name='contato' placeholder="Contato do proprietário" value="<?php echo $existeProjeto ? $projetoInfo['telefone_proprietario'] : ""; ?>"/>
                        </fieldset>
                    </div>
                    <div class='item'>
                        <fieldset>
                            <label> Tipo de projeto: </label>
                            <input type='text' name='tipo' placeholder="Tipo de projeto" value="<?php echo $existeProjeto ? $projetoInfo['tipo'] : ""; ?>" />
                        </fieldset>
                    </div>
                    <div class='item'>    
                        <fieldset>
                            <label> Situação do projeto: </label>
                            <select name="situacao">
                                <option 
                                    value="a" 
                                    <? echo $existeProjeto ? (verificaSituacao($projetoInfo['situacao'], "a") ? "checked" : "") : ""; ?> 
                                > Andamento </option>
                                <option 
                                    value="c"
                                    <? echo $existeProjeto ? (verificaSituacao($projetoInfo['situacao'], "c") ? "checked" : "") : ""; ?> 
                                > Concluido </option>
                                <option 
                                    value="o"
                                    <? echo $existeProjeto ? (verificaSituacao($projetoInfo['situacao'], "o") ? "checked" : "") : ""; ?> 
                                > Orçamento ou negociação </option>
                            </select>
                        </fieldset>
                    </div>
                </div>

                <div class='items'>
                    <div class='item'>
                        <fieldset>
                            <label> Data do contrato: </label>
                            <input type='date' name='datacontrato' value="<?php echo $existeProjeto ? $projetoInfo['data_contrato'] : ""; ?>" />
                            
                        </fieldset>
                    </div>
                    <div class='item'>    
                        <fieldset>
                            <label> Data limite: </label>
                            <input type='date' onchange="calcularPrazo()" name='datalimite' id="datalimite" value="<?php echo $existeProjeto ? $projetoInfo['data_limite'] : ""; ?>" />
                        </fieldset>
                    </div>
                    <div class='item'>
                        <fieldset>
                            <label> Prazo estimado: </label>
                            <input type='text' name='prazo' placeholder="Prazo" value="<?php echo $existeProjeto ? $projetoInfo['prazo'] : ""; ?>"/>
                        </fieldset>
                    </div>
                    <div class='item'>    
                        <fieldset>
                            <label> Valor global: </label>
                            <input type='text' name='vg' placeholder="Valor global" value="<?php echo $existeProjeto ? $projetoInfo['valor_inicial'] : ""; ?>" />
                        </fieldset>
                    </div>
                </div>

                <fieldset>
                    <label> Descrição: </label>
                    <textarea> <?php echo $existeProjeto ? $projetoInfo['descricao'] : ""; ?> </textarea>
                </fieldset>
        
                <fieldset class="btn">
                    <a href="#"><button type="button" class="btnSecundario"> Cancelar </button></a>
                    <button type="submit" class="btnPrincipal"> Cadastrar </button>
                </fieldset>
            </form>
        </main>

        <?php require('../../assets/cmp/footer.php'); ?>
        
    </body>
   
</html>