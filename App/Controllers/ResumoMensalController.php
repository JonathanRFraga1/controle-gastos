<?php

namespace App\Controllers;

use App\Classes\GlobalFunctions;

class ResumoMensalController extends GlobalFunctions
{
    private $model;

    public function __construct()
    {
        if (!$this->isLogged()) {
            header('Location:' . HOME_URI . '/login');
        }

        $this->model = $this->loadModel('ResumoMensalModel');
    }

    public function index()
    {
        $this->title = 'Resumo Mensal';

        $this->jogadores = $this->model->retornaResumo();

        require_once ABSPATH . '/app/views/_includes/header.php';
        require_once ABSPATH . '/app/views/resumo-mensal/resumo-mensal-view.php';
        require_once ABSPATH . '/app/views/_includes/footer.php';
    }
}
