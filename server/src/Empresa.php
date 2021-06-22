<?php

class Empresa
{
    private $sqlite;

    public function __construct(MyDB $sqlite)
    {
        $this->sqlite = $sqlite;
    }

    public function cadastrarEmpresa(string $nome, string $idusu): void
    {
        $insertEmpresa = $this->sqlite->prepare('INSERT INTO empresa(nome, idusu) VALUES(?, ?);');
        $insertEmpresa->bindParam('ss', $nome, $idusu);
        $insertEmpresa->execute();
    }

    public function editarEmpresa(string $nome, string $idemp): void
    {
        $updateEmpresa = $this->sqlite->prepare('UPDATE empresa SET nome = ? WHERE idemp = ?');
        $updateEmpresa->bindParam('ss', $nome, $idemp);
        $updateEmpresa->execute();
    }

    public function deletarEmpresa(string $idemp): void
    {
        $deleteEmpresa = $this->sqlite->prepare('DELETE FROM empresa WHERE idemp = ?');
        $deleteEmpresa->bindParam('s', $idemp);
        $deleteEmpresa->execute();
    }

    public function listarEmpresas(string $idusu): array
    {
        $selectEmpresa = $this->sqlite->prepare('SELECT * FROM empresa WHERE idusu = ?');
        $selectEmpresa->bindParam('s', $idusu);
        
        $empresa = $selectEmpresa->execute()->fetchArray();

        return $empresa;
    }

    public function selecionarEmpresa(string $idemp): array
    {
        $selectEmpresaEspecifica = $this->sqlite->prepare('SELECT * FROM empresa WHERE idemp = ?');
        $selectEmpresaEspecifica->bindParam('s', $idemp);
        
        $empresaSelecionada = $selectEmpresaEspecifica->execute()->fetchArray();

        return $empresaSelecionada;
    }
}


?>