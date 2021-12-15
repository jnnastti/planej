<?php

class Orcamento
{
    private $sqlite;

    public function __construct(MyDB $sqlite)
    {
        $this->sqlite = $sqlite;
    }

    public function cadastrarOrcamento(object $orcamento)
    {
        $idproj = $_SESSION['projAtivo'];

        if(empty($orcamento->dataRegistro)) {
            $orcamento->dataRegistro = date('Y-m-d');
        }

        $insertOrcamento = $this->sqlite->prepare('INSERT INTO orcamento(destino, valor, receber, data_registro, idproj) 
                                                    VALUES(:iddestino, :valorR, :valorT, :dataR, :proj);');
        $insertOrcamento->bindParam(':iddestino', $orcamento->destino);
        $insertOrcamento->bindParam(':valorR', $orcamento->valorR);
        $insertOrcamento->bindParam(':valorT', $orcamento->valorT);
        $insertOrcamento->bindParam(':dataR', $orcamento->dataRegistro);
        $insertOrcamento->bindParam(':proj', $idproj);

        $insertOrcamento->execute();
    }

    public function listarOrcamento(string $id)
    {
        $selectOrcamento = $this->sqlite->prepare('SELECT orcamento.*, SUM(orcamento_historico.valor) AS soma
                                                    FROM orcamento, orcamento_historico 
                                                    WHERE orcamento.idproj = :projeto
                                                    AND orcamento.destino = orcamento_historico.destino
                                                    GROUP BY orcamento.destino');
        $selectOrcamento->bindParam(':projeto', $id);
        
        $orcamento = $selectOrcamento->execute();

        return $orcamento;
    }

    public function deletarOrcamento(string $id)
    {
        $this->deletarOrcamentoHistorico($id);

        $deleteOrcamento = $this->sqlite->prepare('DELETE FROM orcamento WHERE idorc = :id');
        $deleteOrcamento->bindParam(':id', $id);

        $deleteOrcamento->execute();
    }

    private function deletarOrcamentoHistorico(string $id)
    {
        $orcamento = $this->selecionarOrcamento($id);

        $deleteOrcamento = $this->sqlite->prepare('DELETE FROM orcamento_historico 
                                                    WHERE destino = :destino
                                                      AND idproj = :projeto');

        $deleteOrcamento->bindParam(':destino', $orcamento['destino']);
        $deleteOrcamento->bindParam(':projeto', $orcamento['idproj']);

        $deleteOrcamento->execute();
    }

    private function selecionarOrcamento( int $id)
    {
        $selectOrcamento = $this->sqlite->prepare('SELECT * FROM orcamento
                                                    WHERE idorc = :id');
        $selectOrcamento->bindParam(':id', $id);
        
        $orcamento = $selectOrcamento->execute()->fetchArray();

        return $orcamento;
    }

    public function editarOrcamento(object $orcamento)
    {
        $updateOrcamento = $this->sqlite->prepare('UPDATE orcamento SET 
                                                    valor_recebido = :valorR, 
                                                    valor_faltante = :valorF 
                                                   WHERE idorc = ?');

        $updateOrcamento->bindParam(':idorc', $orcamento->idorc);
        $updateOrcamento->bindParam(':valorR', $orcamento->valorR);
        $updateOrcamento->bindParam(':valorF', $orcamento->valorF);

        $updateOrcamento->execute();
    }

    public function listarHistorico(string $Nome, int $projeto)
    {
        $selectOrcamentoHistorico = $this->sqlite->prepare('SELECT * FROM orcamento_historico 
                                                            WHERE idproj = :projeto
                                                            AND   destino = :nome
                                                            ORDER BY data_registro DESC');

        $selectOrcamentoHistorico->bindParam(':projeto', $projeto);
        $selectOrcamentoHistorico->bindParam(':nome', $Nome);
        
        $orcamento = $selectOrcamentoHistorico->execute();

        return $orcamento;
    }
}
?>