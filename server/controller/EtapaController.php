<?php

    session_start();

    require('../../../server/config/database.php');

    include('../../../server/src/Etapa.php');
    include('../../../server/redirect.php');

    $etapa = new Etapa($db);

    $action = (isset($_REQUEST['action'] )) ? $_REQUEST['action']  : '';
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $subetapa = ($_POST['subetapa'] !== NULL) ? $_POST['subetapa']  : '0';

        $etapaDados = (object) array (
            'descricao' => $_POST['descricao'],
            'situacao' => 'A',
            'responsavel' => $_POST['responsavel'],
            'data_inicio' => $_POST['dataini'],
            'data_final' => $_POST['datafim'],
            'subetapa' => $subetapa,
            'projeto' => $_POST['projeto']
        );
    } else {
        $idproj = $_GET['id'];
    
        $etapas = $etapa->listarEtapas($idproj);
    }

    switch($action) {
        case 'deletar': {
            $etapa->deletarEtapa($_POST['id']);
            redireciona('./index.php?id=' . $_POST['idproj']);
            break;
        }
        case 'cadastrar': {
            $etapa->cadastrarEtapa($etapaDados);
            redireciona('./index.php?id=' . $etapaDados->projeto);
            break;
        }   
        case 'atualizar': {
           
            $dados = json_decode($_POST['data']);

            $etapa->finalizarEtapa($dados);
            redireciona('./index.php?id=' . $dado->projeto);
            break;
        }   
    }

?>