<?php

class Empresa
{
    private $sqlite;

    public function __construct(MyDB $sqlite)
    {
        $this->sqlite = $sqlite;
    }

    public function gerarIdEmpresa()
    {
        $generateEmpresa = $this->sqlite->query('SELECT max(idemp) as UltimoId FROM empresa');
        $ultimoId = $generateEmpresa->fetchArray();

        return $ultimoId['UltimoId'] + 1;
    }

    public function gerarIdEmpresaUsuario()
    {
        $generateEmpresaUsuario = $this->sqlite->query('SELECT max(idempusu) as UltimoId FROM empresa_usuario');
        $ultimoId = $generateEmpresaUsuario->fetchArray();

        return $ultimoId['UltimoId'] + 1;
    }

    public function cadastrarEmpresa(string $nome, string $idusu)
    {
        $idEmpresa = $this->gerarIdEmpresa();

        $insertEmpresa = $this->sqlite->prepare('INSERT INTO empresa(idemp, nome) VALUES(:id, :nome);');
        $insertEmpresa->bindParam(':id', $idEmpresa);
        $insertEmpresa->bindParam(':nome', $nome);
        $insertEmpresa->execute();

        $this->cadastrarEmpresaUsuario($idEmpresa, $idusu);
    }

    public function cadastrarEmpresaUsuario(string $idemp, string $idusu)
    {
        $insertEmpresaUsuario = $this->sqlite->prepare('INSERT INTO empresa_usuario(idemp, idusuario) 
                                    VALUES(:idemp, :idusu);');
        $insertEmpresaUsuario->bindParam(':idemp', $idemp);
        $insertEmpresaUsuario->bindParam(':idusu', $idusu);
        $insertEmpresaUsuario->execute();
    }

    public function editarEmpresa(string $nome, string $idemp)
    {
        $updateEmpresa = $this->sqlite->prepare('UPDATE empresa SET nome = :nome WHERE idemp = :id');
        $updateEmpresa->bindParam(':nome', $nome);
        $updateEmpresa->bindParam(':id', $idemp);
        $updateEmpresa->execute();
    }

    public function deletarEmpresa(string $idemp, string $idusu)
    {
        $deleteEmpresa = $this->sqlite->prepare('DELETE FROM empresa_usuario 
                            WHERE idemp = :idemp AND idusuario = :idusu');
        $deleteEmpresa->bindParam(':idemp', $idemp);
        $deleteEmpresa->bindParam(':idusu', $idusu);
        $deleteEmpresa->execute();
    }

    public function listarEmpresas(string $idusu)
    {
        $selectEmpresa = $this->sqlite->prepare("SELECT empresa.* FROM empresa 
                            INNER JOIN empresa_usuario ON (empresa.idemp = empresa_usuario.idemp) 
                            INNER JOIN usuario ON (empresa_usuario.idusuario = usuario.idusuario) 
                            WHERE usuario.idusuario = :id");
        $selectEmpresa->bindParam(':id', $idusu);
        
        $empresa = $selectEmpresa->execute();

        return $empresa;
    }

    public function selecionarEmpresa(string $idemp, string $acao)
    {
        $selectEmpresaEspecifica = $this->sqlite->prepare('SELECT * FROM empresa WHERE idemp = :id');
        $selectEmpresaEspecifica->bindParam(':id', $idemp);
        
        $empresaSelecionada = $selectEmpresaEspecifica->execute()->fetchArray();

        if($acao === 'editar') {
            return $empresaSelecionada;
        } else {
            $_SESSION['empAtiva'] = $empresaSelecionada['idemp'];
        }
    }
}


?>