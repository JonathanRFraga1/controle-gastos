<?php

namespace App\Models;

use PDO;
use App\Classes\Database;
use App\Models\EntradasModel;
use Throwable;

class ResumoMensalModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function retornaResumo()
    {
        $entradasModel = new EntradasModel();

        $limite = $this->db->query(
            "SELECT 
                valor
            FROM
                configuracoes
            WHERE
                id = 1"
        )->fetch(PDO::FETCH_COLUMN);

        $entradas = [];

        $entradas['credito'] = $entradasModel->retornaEntradasCredito();
        $entradas['debito'] = $entradasModel->retornaEntradasTipo('debito');
        $entradas['crediario'] = $entradasModel->retornaEntradasTipo('crediario');
        $entradas['salario'] = $entradasModel->retornaEntradasTipo('salario');
        $entradas['rascunho'] = $entradasModel->retornaEntradasTipo();

        var_dump($entradas);


    }
}
