<?php

    session_start();

    require('../../../server/config/database.php');
    
    include('../../../server/src/Orcamento.php');
    include('../../../server/redirect.php');

    if(!empty($_GET['id'])) {
        $_SESSION['projAtivo'] = $_GET['id'];
    }

    $orcamento = new Orcamento($db);
    $itemOrcamento = $orcamento->listarOrcamento($_SESSION['projAtivo']);

    $action = (isset($_REQUEST['action'] )) ? $_REQUEST['action']  : '';

    $contador = 0;
    
    switch($action) {
        case 'deletar': {
            $orcamento->deletarOrcamento($_POST['id']);
            redireciona('./index.php?id=' . $_SESSION['projAtivo']);
            break;
        }
        case 'editar': {
            $orcamentoDados = (object) array (
                'idorc' => $_POST['idorc'],
                'valorF' => $_POST['valorF'],
                'valorR' => $_POST['valorR']
            );

            $orcamento->editarOrcamento($orcamentoDados);
            redireciona('./index.php?id=' . $orcamentoDados->idorc);
            break;
        }
        case 'cadastrar': {
            $orcamentoDados = (object) array (
                'destino' => $_POST['obs'],
                'valorR' => $_POST['valorRecebido'],
                'valorT' => $_POST['valorTotal'],
                'dataRegistro' => $_POST['dataorcamento']
            );
            // var_dump($orcamentoDados);

            
            $orcamento->cadastrarOrcamento($orcamentoDados);
            redireciona('./index.php?id=' . $orcamentoDados->idorc);
            break;
        }
    }

?>