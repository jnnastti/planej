<?php

class Etapa
{
    private $sqlite;

    public function __construct(MyDB $sqlite)
    {
        $this->sqlite = $sqlite;
    }

    public function cadastrarEtapa(object $etapa)
    {
        $insertEtapa = $this->sqlite->prepare('INSERT INTO etapas(descricao, situacao, data_inicio, data_final, responsavel,  idproj, subetapa) 
                                                 VALUES(:descricao, :sit, :dataIni, :dataFim, :responsavel, :projeto, :subetapa);');
        $insertEtapa->bindParam(':descricao', $etapa->descricao);
        $insertEtapa->bindParam(':sit', $etapa->situacao);
        $insertEtapa->bindParam(':dataIni', $etapa->data_inicio);
        $insertEtapa->bindParam(':dataFim', $etapa->data_final);
        $insertEtapa->bindParam(':responsavel', $etapa->responsavel);
        $insertEtapa->bindParam(':projeto', $etapa->projeto);
        $insertEtapa->bindParam(':subetapa', $etapa->subetapa);
        
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