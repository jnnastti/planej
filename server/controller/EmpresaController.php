<?php

    session_start();

    require('../../../server/config.php');
    
    include('../../../server/src/Empresa.php');
    include('../../../server/redirect.php');

    $empresa = new Empresa($db);
    $itemEmpresa = $empresa->listarEmpresas($_SESSION['usuarioLogin']);

    $action = (isset($_REQUEST['action'] )) ? $_REQUEST['action']  : '';
    $nomeEmpresa = (isset($_GET['id'])) ? $empresa->selecionarEmpresa($_GET['id'], 'editar') : '';

    $contador = 0;
    
    switch($action) {
        case 'deletar': {
            $empresa->deletarEmpresa($_POST['id'], $_SESSION['usuarioLogin']);
            redireciona('./index.php');
            break;
        }
        case 'editar': {
            $empresa->editarEmpresa($_POST['nome'], $_POST['id']);
            redireciona('./index.php');
            break;
        }
        case 'cadastrar': {
            $empresa->cadastrarEmpresa($_POST['nome'], $_SESSION['usuarioLogin']);
            redireciona('./index.php');
            break;
        }
        case 'selecionar': {
            $empresa->selecionarEmpresa($_POST['id'], 'selecionar');
            redireciona('../projetos/index.php');
        }
    }

?>