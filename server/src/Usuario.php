<?php

class Usuario
{
    private $sqlite;

    public function __construct(MyDB $sqlite)
    {
        $this->sqlite = $sqlite;
    }

    public function login(string $email, string $senha): array
    {
        $selecionaLogin = $this->sqlite->prepare('SELECT * FROM usuario WHERE email = ? AND senha = ? LIMIT 0,1');
        $selecionaLogin->bindParam ('ss', $email, $senha);

        $login = $selecionaLogin->execute()->fetchArray();

        return $login;
    }

    public function verificacao(string $usuarioLogado): bool
    {
        if(empty(($_SESSION['usuarioLogin'])) || ($usuarioLogado !== $_SESSION['usuarioLogin'])) {
            return true;
        }

        return false;
    }
}

?>