<?php

    session_start();

    require('../../../server/config/database.php');

    include('../../../server/src/Projeto.php');
    include('../../../server/redirect.php');

    $projeto = new Projeto($db);

    $projetoAndamento = $projeto->listarPrjAndamento($_SESSION['empAtiva']);
    $projetoFinalizado = $projeto->listarPrjConcluido($_SESSION['empAtiva']);
    $projetoOrcamento = $projeto->listarPrjOrcamento($_SESSION['empAtiva']);

    $contador = 0;

    $action = (isset($_REQUEST['action'] )) ? $_REQUEST['action']  : '';

    switch($action) {
        case 'deletar': {
            $projeto->deletarProjeto($_POST['id']);
            redireciona('./index.php');
            break;
        }
    }
?>