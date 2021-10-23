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
        $idproj = $_SESSION['idProjAtivo'];

        $insertOrcamento = $this->sqlite->prepare('INSERT INTO orcamento(iddestino, valor_recebido, valor_faltante, idproj) 
                                                    VALUES(:iddestino, :valorR, :valorF, :proj);');
        $insertOrcamento->bindParam(':iddestino', $orcamento->destino);
        $insertOrcamento->bindParam(':valorR', $orcamento->valorR);
        $insertOrcamento->bindParam(':valorF', $orcamento->valorF);
        $insertOrcamento->bindParam(':proj', $idproj);

        $insertOrcamento->execute();
    }

    public function listarOrcamento(string $id)
    {
        $selectOrcamento = $this->sqlite->prepare('SELECT * FROM orcamento WHERE idproj = :projeto');
        $selectOrcamento->bindParam(':projeto', $id);
        
        $orcamento = $selectOrcamento->execute();

        return $orcamento;
    }

    public function deletarOrcamento(string $id)
    {
        $deleteOrcamento = $this->sqlite->prepare('DELETE FROM orcamento WHERE idorc = :id');
        $deleteOrcamento->bindParam(':id', $id);

        $deleteOrcamento->execute();
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
}
?>