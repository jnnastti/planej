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

    public function deletarSubEtapas(string $id) 
    {
        $deletarSubEtapa = $this->sqlite->prepare('DELETE FROM etapas WHERE subetapa = :id');
        $deletarSubEtapa->bindParam(':id', $id);
        $deletarSubEtapa->execute();
    }

    public function deletarEtapa(string $id)
    {
        $this->deletarSubEtapas($id);

        $deleteEtapa = $this->sqlite->prepare('DELETE FROM etapas WHERE idetapa = :id');
        $deleteEtapa->bindParam(':id', $id);
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

    public function finalizarEtapa(object $dados)
    {

        $checkEtapa = $this->sqlite->prepare('UPDATE etapas SET situacao = :situacao WHERE idetapa = :id');
        $checkEtapa->bindParam(':id', $dados->id);
        $checkEtapa->bindParam(':situacao', $dados->situacao);
        $checkEtapa->execute();

        if($dados->subetapa === '0') {
            $this->finalizarSubEtapas($dados->id, $dados->situacao);
        }

    }

    public function finalizarSubEtapas(string $id, string $situacao)
    {
        $checkSubEtapas = $this->sqlite->prepare('UPDATE etapas SET situacao = :situacao WHERE subetapa = :id');
        $checkSubEtapas->bindParam(':id', $id);
        $checkSubEtapas->bindParam(':situacao', $situacao);
        $checkSubEtapas->execute();
    }
}

?>