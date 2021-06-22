<?php

class Etapa
{
    public function cadastrarEtapa(string $descricao, string $dataIni, string $dataFinal, string $responsavel): void
    {
        $idproj = $_SESSION['idProjAtivo'];;

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

    public function listarEtapas(string $id): array
    {
        $selectEtapa = $this->sqlite->prepare('SELECT * FROM etapas WHERE idproj = ?');
        $selectEtapa->bindParam('s', $id);
        
        $etapa = $selectEtapa->execute()->fetchArray();

        return $etapa;
    }
}

?>