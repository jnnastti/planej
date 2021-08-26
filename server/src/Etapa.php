<?php

class Etapa
{
    private $sqlite;

    public function __construct(MyDB $sqlite)
    {
        $this->sqlite = $sqlite;
    }

    public function cadastrarEtapa(string $descricao, string $dataIni, string $dataFinal, string $responsavel): void
    {
        $idproj = $_SESSION['idProjAtivo'];

        $insertEtapa = $this->sqlite->prepare('INSERT INTO etapas(descricao, data_inicio, data_final, responsavel,  idproj) 
                                                 VALUES(?, ?, ?, ?, ?);');
        $insertEtapa->bindParam('sssss', $descricao, $dataIni, $dataFinal, $responsavel, $idproj);
        $insertEtapa->execute();
    }

    public function editarEtapa(string $id, string $descricao, string $dataIni, string $dataFinal, string $responsavel, string $situacao): void
    {
        $updateEtapa = $this->sqlite->prepare('UPDATE etapas SET 
                                                    descricao = ?,
                                                    data_inicio = ?,
                                                    responsavel = ?,
                                                    situacao = ?,
                                                    data_final = ?
                                                 WHERE idetapa = ?');
        $updateEtapa->bindParam('ssssss', $descricao, $dataIni, $responsavel, $situacao, $dataFinal, $id);
        $updateEtapa->execute();
    }

    public function deletarEtapa(string $id): void
    {
        $deleteEtapa = $this->sqlite->prepare('DELETE FROM etapas WHERE idetapa = ?');
        $deleteEtapa->bindParam('s', $id);
        $deleteEtapa->execute();
    }

    public function listarEtapas(string $id)
    {
        $selectEtapa = $this->sqlite->prepare('SELECT * FROM etapas WHERE idproj = :id AND subetapa = 0');
        $selectEtapa->bindParam(':id', $id);
        
        $etapa = $selectEtapa->execute();

        return $etapa;
    }

    public function listarSubEtapas(string $id, string $proj)
    {
        $selectSubEtapa = $this->sqlite->prepare('SELECT * FROM etapas WHERE subetapa = :id AND idproj = :proj');
        $selectSubEtapa->bindParam(':id', $id);
        $selectSubEtapa->bindParam(':proj', $proj);

        $subEtapa = $selectSubEtapa->execute();

        return $subEtapa;
    }
}

?>