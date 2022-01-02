<?php

namespace App\Controllers;

use App\Classes\GlobalFunctions;

class EntradasController extends GlobalFunctions
{
    private $model;

    public function __construct()
    {
        if (!$this->isLogged()) {
            header('Location:' . HOME_URI . '/login');
        }

        $this->model = $this->loadModel('EntradasModel');
    }

    public function index()
    {
        $this->title = "Entradas";
        require_once ABSPATH . '/app/views/_includes/header.php';
        require_once ABSPATH . '/app/views/entradas/entradas-view.php';
        require_once ABSPATH . '/app/views/_includes/footer.php';
    }

    public function inserir()
    {
        $this->title = "Inserir Entradas";

        if ($this->isPost()) {
            $result = $this->model->insereEntradas();

            if ($result !== true) {
                $this->notification = [
                   'title' => 'Erro!',
                   'content' => $result,
                   'type' => 'error',
                ];
            } else {
                $this->notification = [
                    'title' => 'Sucesso!',
                    'content' => 'Entrada cadastrada com sucesso.',
                    'type' => 'success',
                 ]; 
            }
        }
        require_once ABSPATH . '/app/views/_includes/header.php';
        require_once ABSPATH . '/app/views/entradas/entradas-cadastro.php';
        require_once ABSPATH . '/app/views/_includes/footer.php';
    }
}
