<?php

class Usuario
{
    private $sqlite;

    public function __construct(MyDB $sqlite)
    {
        $this->sqlite = $sqlite;
    }

    public function login(string $email, string $senha)
    {
        $selecionaLogin = $this->sqlite->prepare("SELECT * FROM usuario WHERE email = :email AND SENHA = :senha");
        $selecionaLogin->bindParam(':email', $email);
        $selecionaLogin->bindParam(':senha', $senha);

        $login = $selecionaLogin->execute()->fetchArray();

        return $login;
        
    }
}

?>