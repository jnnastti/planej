<?php

    session_start();

    require('../../../server/config/database.php');
    
    include('../../../server/src/Orcamento.php');
    include('../../../server/redirect.php');

    $orcamento = new Orcamento($db);
    $itemOrcamento = $orcamento->listarOrcamento($_SESSION['idProjAtivo']);

    $action = (isset($_REQUEST['action'] )) ? $_REQUEST['action']  : '';

    $contador = 0;
    
    switch($action) {
        case 'deletar': {
            $orcamento->deletarOrcamento($_POST['id']);
            redireciona('./index.php?id=' . $_SESSION['idProjAtivo']);
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
                'destino' => $_POST['destino'],
                'valorF' => $_POST['valorF'],
                'valorR' => $_POST['valorR']
            );

            $orcamento->cadastrarOrcamento($orcamentoDados);
            redireciona('./index.php?id=' . $orcamentoDados->idorc);
            break;
        }
    }

?>