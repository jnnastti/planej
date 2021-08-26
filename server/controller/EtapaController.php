<?php

session_start();

require('../../../server/config/database.php');

include('../../../server/src/Etapa.php');
include('../../../server/redirect.php');

$etapa = new Etapa($db);

$idetapa = 0;
$idproj = 6;

$etapas = $etapa->listarEtapas("6");

?>