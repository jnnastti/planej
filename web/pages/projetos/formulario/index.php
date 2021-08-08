<?php

    session_start();

    require('../../../../server/config/databaseSubpage.php');

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

    $action = (isset($_REQUEST['action'] )) ? $_REQUEST['action']  : '';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $projetoDados = (object) array (
            'nome' => $_POST['nome'],
            'nome_proprietario' => $_POST['nome_proprietario'],
            'cpf_proprietario' => $_POST['cpfcnpj'],
            'telefone_proprietario' => $_POST['contato'],
            'tipo' => $_POST['tipo'],
            'descricao' => $_POST['descricao'],
            'valor_inicial' => $_POST['valor_inicial'],
            'data_contrato' => $_POST['datacontrato'],
            'prazo' => $_POST['prazo'],
            'data_limite' => $_POST['datalimite'],
            'situacao' => $_POST['situacao'],
            'idproj' => $_POST['id']
        );
    }
    switch($action) {
        case 'editar': {
            $projeto->editarProjeto($projetoDados);
            redireciona('./index.php?id=' . $_POST['id']);
            break;
        }
        case 'cadastrar': {
            $projeto->cadastrarProjeto($projetoDados);
            redireciona('../index.php');
            break;
        }   
    }
?>

<html>
    <head>
        <link href="../../../assets/styles/formStyle.css" rel="stylesheet" />

        <?php require('../../../assets/cmp/subpages/headInfo.php'); ?>

        <title> Planej | Configure seu projeto </title>
    </head>

    <body>

        <?php require('../../../assets/cmp/subpages/header.php'); ?>

        <main class="container">
            <h2>Configure seu projeto</h2>
            <p>É de extrema importância que os dados de seu projeto estejam sempre em dia para que você 
                possa acompanhar seu crescimento.
            </p>

            <form action="./index.php?action=<?php echo $existeProjeto ? "editar" : "cadastrar" ?>" method="POST">
                <input type="hidden" name="id" value="<?php echo $existeProjeto ? $projetoInfo['idproj'] : ""; ?>"/>
            
                <fieldset>
                    <label> Nome do projeto: </label>
                    <input type="text" name="nome" placeholder="Nome" value="<?php echo $existeProjeto ? $projetoInfo['nome'] : ""; ?>"/>
                </fieldset>
                <fieldset>
                    <label> Nome do proprietário: </label>
                    <input type="text" name="nome_proprietario" placeholder="Nome do proprietário" value="<?php echo $existeProjeto ? $projetoInfo['nome_proprietario'] : ""; ?>"/>
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
                                    <? echo $existeProjeto ? (verificaSituacao($projetoInfo['situacao'], "a") ? "selected" : "") : ""; ?> 
                                > Andamento </option>
                                <option 
                                    value="c"
                                    <? echo $existeProjeto ? (verificaSituacao($projetoInfo['situacao'], "c") ? "selected" : "") : ""; ?> 
                                > Concluido </option>
                                <option 
                                    value="o"
                                    <? echo $existeProjeto ? (verificaSituacao($projetoInfo['situacao'], "o") ? "selected" : "") : ""; ?> 
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
                            <input type='text' name='valor_inicial' placeholder="Valor global" value="<?php echo $existeProjeto ? number_format($projetoInfo['valor_inicial'], 2, ',', '') : ""; ?>" />
                        </fieldset>
                    </div>
                </div>

                <fieldset>
                    <label> Descrição: </label>
                    <textarea name="descricao"> <?php echo $existeProjeto ? $projetoInfo['descricao'] : ""; ?> </textarea>
                </fieldset>
        
                <fieldset class="btn">
                    <a href="../index.php"><button type="button" class="btnSecundario"> Cancelar </button></a>
                    <button type="submit" class="btnPrincipal"> <?php echo $existeProjeto ? "Editar" : "Cadastrar" ?> </button>
                </fieldset>
            </form>
        </main>

        <?php require('../../assets/cmp/footer.php'); ?>
        
    </body>
   
</html>