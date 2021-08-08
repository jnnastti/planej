<?php

    session_start();

    require('../../../../server/config/databaseSubpage.php');

    include('../../../../server/src/Projeto.php');
    include('../../../../server/redirect.php');

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