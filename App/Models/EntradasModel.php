<?php

namespace App\Models;

use PDO;
use Throwable;
use App\Classes\Database;
use DateTime;

class EntradasModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insereEntradas()
    {
        $values = $_POST;
        unset($_POST);

        try {
            $this->db->insert(
                'entradas',
                $values
            );
        } catch (Throwable $th) {
            return "Erro ao salvar a entrada!";
        }

        return true;
    }

    /**
     * Função responsável por retornar as entradas cadastradas por tipo
     *
     * @param string $tipo
     * @param Date $inicioMes
     * @param Date $fimMes
     * @return Array|boolean
     */
    public function retornaEntradasTipo(string $tipo = 'rascunho', $inicioMes = false, $fimMes = false): Array|bool
    {
        if ($inicioMes == false) {
            $inicioMes = date('Y-m-01', strtotime('now'));
        }

        if ($fimMes == false) {
            $fimMes = date('Y-m-t', strtotime('now'));
        }

        $result = $this->db->query(
            "SELECT
                *
            FROM
                entradas
            WHERE
                tipo = ?
                AND data BETWEEN ? AND ?",
            [$tipo, $inicioMes, $fimMes]
        )->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Função responsavel pelo retorno das entradas do tipo credito
     *
     * @return Array|boolean
     */
    public function retornaEntradasCredito(): Array|bool
    {
        $results = $this->db->query(
            "SELECT
                *
            FROM
                entradas
            WHERE
                tipo = 'credito'"
        )->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            return false;
        }

        $mesAt = date('Y-m', strtotime('now'));

        foreach ($results as $key => $result) {
            $strMeses = '+ ' . $result['parcelas'] . ' months';
            $mesFim = date('Y-m', strtotime($strMeses, strtotime($result['data'])));

            if ($mesAt > $mesFim) {
                unset($results[$key]);
            }
        }

        if (empty($results)) {
            return false;
        }

        return array_values($results);
    }
}
