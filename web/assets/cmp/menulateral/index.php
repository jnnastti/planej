<!DOCTYPE html>
<html class="menu">
<html>

<head>
<meta charset="utf-8"/>

<link href='https://css.gg/profile.css' rel='stylesheet'>
<link href='https://css.gg/toolbox.css' rel='stylesheet'>
<link href='https://css.gg/trello.css' rel='stylesheet'>
<link href='https://css.gg/file.css' rel='stylesheet'>
<link href='https://css.gg/calculator.css' rel='stylesheet'>
<link href='https://css.gg/album.css' rel='stylesheet'>
<link href='https://css.gg/calendar-today.css' rel='stylesheet'>
<link href='https://css.gg/image.css' rel='stylesheet'>
<link href='https://css.gg/terminal.css' rel='stylesheet'>
<link href='https://css.gg/organisation.css' rel='stylesheet'>
<link href='https://css.gg/list.css' rel='stylesheet'>

</head>
<body>

<nav class="main-menu">
    <ul>
        <li class="logo">
            <h2> PLANEJ </h2>
        </li>   
   
        <li>                                 
            <a href="../../empresa/editar/index.php">
                <i class="fa gg-organisation"></i>
                <span class="nav-text"> Empresa: 
                    <?php
                        session_start();
                        echo $_SESSION['nomeEmpAtivo'];
                    ?> 
                </span>
            </a>
        </li>    

        <li class="darkerlishadow">
            <a href="">
                <i class="fa gg-trello"></i>
                <span class="nav-text">Dashboards</span>
            </a>
        </li>
        
        <li class="darkerli">
            <a href="">
                <i class="fa gg-file"></i>
                <span class="nav-text">Relatórios</span>
            </a>
        </li>

        
        <li class="darkerli">
            <a href="../../empresa/listar/index.php">
                <i class="fa gg-organisation"></i>
                <span class="nav-text">Empresas</span>
            </a>
        </li>

        <li class="darkerli">
            <a href="../../projetos/listar/index.php">
                <i class="fa gg-album"></i>
                <span class="nav-text">Projetos</span>
            </a>
        </li>


    </ul>

</nav>

</body>
</html>