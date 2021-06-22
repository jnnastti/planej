<?php

function redireciona(string $url): void
{
    header("Location: $url");
    die();
}