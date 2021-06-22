<?php

class Orcamento
{
    private $sqlite;

    public function __construct(MyDB $sqlite)
    {
        $this->sqlite = $sqlite;
    }

    public function cadastrarOrcamento(string $valor, string $destino, string $receber): void
    {
        $idproj = $_SESSION['idProjAtivo'];

        $insertOrcamento = $this->sqlite->prepare('INSERT INTO orcamento(valor, destino, receber, idproj) VALUES(?, ?, ?, ?);');
        $insertOrcamento->bindParam('ssss', $valor, $destino, $receber, $idproj);
        $insertOrcamento->execute();

        $this->cadastrarHistorico();
    }

    public function cadastrarHistorico(): void
    {
        // pegar ultimo insert
        $selectOrcamento = $this->sqlite->query('SELECT * FROM historico LIMIT 0, 1');
        $orcamento = $selectOrcamento->fetchArray();

        $insertHistorico = $this->sqlite->prepare('INSERT INTO historico(destino, valor, datarecebimento, idorc) VALUES(?, ?, ?);');
        $insertHistorico->bindParam('ssss', $orcamento['destino'], $orcamento['valor'], $orcamento['datarecebimento'], $orcamento['idorc']);
        $insertHistorico->execute();
    }

    public function listarOrcamento(string $id): array
    {
        $selectOrcamento = $this->sqlite->prepare('SELECT * FROM orcamento WHERE idproj = ?');
        $selectOrcamento->bindParam('s', $id);
        
        $orcamento = $selectOrcamento->execute()->fetchArray();

        return $orcamento;
    }

    public function listarHistorico(string $id): array
    {
        $selectHistorico = $this->sqlite->prepare('SELECT historico.*, orcamento.destino FROM historico 
                                                   INNER JOIN orcamento ON orcamento.idorc = historico.idorc 
                                                   WHERE orcamento.idproj = ? ORDER BY historico.datarecebimento DESC');
        $selectHistorico->bindParam('s', $id);
        
        $historico = $selectHistorico->execute()->fetchArray();

        return $historico;
    }

    public function deletarOrcamento(string $id): void
    {
        $deleteOrcamento = $this->sqlite->prepare('DELETE FROM orcamento WHERE idorc = ?');
        $deleteOrcamento->bindParam('s', $id);
        $deleteOrcamento->execute();
    }

    public function deletarHistorico(string $id): void
    {
        $deleteHistorico = $this->sqlite->prepare('DELETE FROM historico WHERE idorc = ?');
        $deleteHistorico->bindParam('s', $id);
        $deleteHistorico->execute();

        $this->deletarOrcamento($id);
    }

    public function editarOrcamento(string $id, string $destino, string $valor, string $receber): void
    {
        $updateOrcamento = $this->sqlite->prepare('UPDATE orcamento SET receber = ?, destino = ?, valor = ? WHERE idorc = ?');
        $updateOrcamento->bindParam('ssss', $receber, $destino, $valor, $id);
        $updateOrcamento->execute();

        $selectOrcamentoEditado = $this->sqlite->prepare('SELECT * FROM orcamento WHERE idorc = ?');
        $selectOrcamentoEditado->bindParam('s', $id);
        
        $orcamentoEditado = $selectOrcamentoEditado->execute()->fetchArray();

        $this->editarHistorico($orcamentoEditado);
    }

    public function editarHistorico(array $orcamentoEditado): void
    {
        $updateHistorico = $this->sqlite->prepare('INSERT INTO historico(destino, valor, datarecebimento, idorc) VALUES(?, ?, ?);');
        $updateHistorico->bindParam('ssss', $orcamentoEditado['destino'], $orcamentoEditado['valor'], $orcamentoEditado['datarecebimento'], $orcamentoEditado['idorc']);
        $updateHistorico->execute();
    }
}
?>