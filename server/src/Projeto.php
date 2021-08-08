<?php

class Projeto
{
    private $sqlite;

    public function __construct(MyDB $sqlite)
    {
        $this->sqlite = $sqlite;
    }

    function cadastrarProjeto(object $projeto)
    {
        $idEmp = $_SESSION['empAtiva'];

        $insertProjeto = $this->sqlite->prepare('INSERT INTO projeto(idemp, nome, nome_proprietario, cpf_proprietario, telefone_proprietario, tipo, descricao, valor_inicial, data_contrato, prazo, data_limite, situacao)  
                                                  VALUES(:idemp, :nome, :nomeProp, :cpfProp, :contatoProp, :tipo, :descricao, :valorIni, :dataContrato, :prazo, :dataLimite, :situacao);');
        $insertProjeto->bindParam(':idemp', $idEmp);
        $insertProjeto->bindParam(':nome', $projeto->nome);
        $insertProjeto->bindParam(':nomeProp', $projeto->nome_proprietario);
        $insertProjeto->bindParam(':cpfProp', $projeto->cpf_proprietario);
        $insertProjeto->bindParam(':contatoProp', $projeto->telefone_proprietario);
        $insertProjeto->bindParam(':tipo', $projeto->tipo);
        $insertProjeto->bindParam(':descricao', $projeto->descricao);
        $insertProjeto->bindParam(':valorIni', $projeto->valor_inicial);
        $insertProjeto->bindParam(':dataContrato', $projeto->data_contrato);
        $insertProjeto->bindParam(':prazo', $projeto->prazo);
        $insertProjeto->bindParam(':dataLimite', $projeto->data_limite);
        $insertProjeto->bindParam(':situacao', $projeto->situacao);
        $insertProjeto->execute();
    }

    function editarProjeto(object $projeto)
    {
        $updateProjeto = $this->sqlite->prepare('UPDATE projeto SET 
                                                    nome = :nome,  
                                                    nome_proprietario = :nomeProp, 
                                                    cpf_proprietario = :cpfProp, 
                                                    telefone_proprietario = :contatoProp,
                                                    tipo = :tipo, 
                                                    descricao = :descricao, 
                                                    valor_inicial = :valorIni, 
                                                    data_contrato = :dataContrato, 
                                                    prazo = :prazo, 
                                                    data_limite = :dataLimite,
                                                    situacao = :situacao 
                                                WHERE idproj = :idproj');
        $updateProjeto->bindParam(':idproj', $projeto->idproj);
        $updateProjeto->bindParam(':nome', $projeto->nome);
        $updateProjeto->bindParam(':nomeProp', $projeto->nome_proprietario);
        $updateProjeto->bindParam(':cpfProp', $projeto->cpf_proprietario);
        $updateProjeto->bindParam(':contatoProp', $projeto->telefone_proprietario);
        $updateProjeto->bindParam(':tipo', $projeto->tipo);
        $updateProjeto->bindParam(':descricao', $projeto->descricao);
        $updateProjeto->bindParam(':valorIni', $projeto->valor_inicial);
        $updateProjeto->bindParam(':dataContrato', $projeto->data_contrato);
        $updateProjeto->bindParam(':prazo', $projeto->prazo);
        $updateProjeto->bindParam(':dataLimite', $projeto->data_limite);
        $updateProjeto->bindParam(':situacao', $projeto->situacao);

        $updateProjeto->execute();
    }

    public function deletarProjeto(string $id)
    {
        $deleteProjeto = $this->sqlite->prepare('DELETE FROM projeto WHERE idproj = :id');
        $deleteProjeto->bindParam(':id', $id);
        $deleteProjeto->execute();
    }

    public function selecionarProjeto(string $id)
    {
        $selectProjetoEspecifico = $this->sqlite->prepare('SELECT * FROM projeto WHERE idproj = :id');
        $selectProjetoEspecifico->bindParam(':id', $id);
        
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