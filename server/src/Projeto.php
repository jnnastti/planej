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

    public function listarPrjAndamento(string $id)
    {
        $selectPrjAndamento = $this->sqlite->prepare('SELECT * FROM projeto WHERE idemp = :id AND situacao = "a"');
        $selectPrjAndamento->bindParam(':id', $id);
        
        $prjAndamento = $selectPrjAndamento->execute();

        return $prjAndamento;
    } 

    public function listarPrjConcluido(string $id)
    {
        $selectPrjConcluido = $this->sqlite->prepare('SELECT * FROM projeto WHERE idemp = :id AND situacao = "c"');
        $selectPrjConcluido->bindParam(':id', $id);
        
        $prjConcluido = $selectPrjConcluido->execute();

        return $prjConcluido;
    } 

    public function listarPrjOrcamento(string $id)
    {
        $selectPrjOrcamento = $this->sqlite->prepare('SELECT * FROM projeto WHERE idemp = :id AND situacao = "o"');
        $selectPrjOrcamento->bindParam(':id', $id);
        
        $prjOrcamento = $selectPrjOrcamento->execute();

        return $prjOrcamento;
    } 
}

?>