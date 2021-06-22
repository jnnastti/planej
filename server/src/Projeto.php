<?php

class Projeto
{
    private $sqlite;

    public function __construct(MyDB $sqlite)
    {
        $this->sqlite = $sqlite;
    }

    function cadastrarProjeto(string $nome, string $situacao, string $nomeProp, string $cpfCnpj, string $tell, string $tipo, string $descricao, string $valorIni, string $dataContrato, string $prazo, string $dataLim): void
    {
        $idEmp = $_SESSION['idEmpAtivo'];

        $insertProjeto = $this->sqlite->prepare('INSERT INTO projeto(idemp, nome, situacao, nome_proprietario, cpf_proprietario, telefone_proprietario, tipo, descricao, valor_inicial, data_contrato, prazo, data_limite) 
                                                 VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
        $insertProjeto->bindParam('ssssssssssss', $idEmp, $nome, $situacao, $nomeProp, $cpfCnpj, $tell, $tipo, $descricao, $valorIni, $dataContrato, $prazo, $dataLim);
        $insertProjeto->execute();
    }

    function editarProjeto(string $id, string $nome, string $situacao, string $nomeProp, string $cpfCnpj, string $tell, string $tipo, string $descricao, string $valorIni, string $dataContrato, string $prazo, string $dataLim): void
    {

        $updateProjeto = $this->sqlite->prepare('UPDATE projeto SET 
                                                    nome = ?, 
                                                    situacao = ?, 
                                                    nome_proprietario = ?, 
                                                    cpf_proprietario = ?, 
                                                    telefone_proprietario = ?,
                                                    tipo = ?, 
                                                    descricao = ?, 
                                                    valor_inicial = ?, 
                                                    data_contrato = ?, 
                                                    prazo = ?, 
                                                    data_limite = ?
                                                WHERE idproj = ?');
        $updateProjeto->bindParam('ssssssssssss', $nome, $situacao, $nomeProp, $cpfCnpj, $tell, $tipo, $descricao, $valorIni, $dataContrato, $prazo, $dataLim, $id);
        $updateProjeto->execute();
    }

    public function deletarProjeto(string $id): void
    {
        $deleteProjeto = $this->sqlite->prepare('DELETE FROM projeto WHERE idproj = ?');
        $deleteProjeto->bindParam('s', $id);
        $deleteProjeto->execute();
    }

    public function selecionarProjeto(string $id): array
    {
        $selectProjetoEspecifico = $this->sqlite->prepare('SELECT * FROM projeto WHERE id = ?');
        $selectProjetoEspecifico->bindParam('s', $id);
        
        $projetoSelecionado = $selectProjetoEspecifico->execute()->fetchArray();

        return $projetoSelecionado;
    }

    public function listarPrjAndamento(string $id): array
    {
        $selectPrjAndamento = $this->sqlite->prepare('SELECT * FROM projeto WHERE idemp = ? AND situacao = "a"');
        $selectPrjAndamento->bindParam('s', $id);
        
        $prjAndamento = $selectPrjAndamento->execute()->fetchArray();

        return $prjAndamento;
    } 

    public function listarPrjConcluido(string $id): array
    {
        $selectPrjConcluido = $this->sqlite->prepare('SELECT * FROM projeto WHERE idemp = ? AND situacao = "c"');
        $selectPrjConcluido->bindParam('s', $id);
        
        $prjConcluido = $selectPrjConcluido->execute()->fetchArray();

        return $prjConcluido;
    } 

    public function listarPrjOrcamento(string $id): array
    {
        $selectPrjOrcamento = $this->sqlite->prepare('SELECT * FROM projeto WHERE idemp = ? AND situacao = "o"');
        $selectPrjOrcamento->bindParam('s', $id);
        
        $prjOrcamento = $selectPrjOrcamento->execute()->fetchArray();

        return $prjOrcamento;
    } 
}

?>