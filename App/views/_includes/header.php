<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jonathan Rossetto de Fraga">
    <meta name="description" content="Painel de controle de Gastos">
    <meta namm="keywords" content="Painel, controle, painel de controle de gastos">
    <meta http-equiv="content-language" content="pt-br">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="<?= $this->robots?>">
    <title><?= $this->title?></title>
    <link rel="stylesheet" href="<?= HOME_URI?>/app/views/_includes/fontAwesome/css/all.min.css">
    <link rel="stylesheet" href="<?= HOME_URI?>/app/views/_includes/css/styles.css">
    <script src="<?= HOME_URI?>/app/views/_includes/js/jquery-3.6.0.min.js"></script>
    <script src="<?= HOME_URI?>/app/views/_includes/js/jquery.mask.min.js"></script>
</head>
<body>
    <header>
        <button id="bt-main-menu" aria-label="clique para exibir o menu do sistema">
            <i class="fas fa-bars"></i>
        </button>

        <h2>Gerenciamento Financeiro</h2>
    </header>

    <nav role="navigation" id="main-menu">
        <ul>
            <li>
                <a href="<?= HOME_URI?>">
                    <i class="fas fa-home"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="<?= HOME_URI?>/entradas">
                    <i class="fas fa-money-bill-wave-alt"></i>
                    Entradas
                </a>
            </li>
            <li>
                <a href="<?= HOME_URI?>/resumo-mensal">
                    <i class="fas fa-calendar"></i>
                    Resumo Mensal
                </a>
            </li>
            <li>
                <a href="<?= HOME_URI?>/usuarios">
                    <i class="fas fa-users"></i>
                    Usuários
                </a>
            </li>
            <li>
                <a href="<?= HOME_URI?>/configuracoes">
                    <i class="fas fa-sliders-h"></i>
                    Configurações
                </a>
            </li>
        </ul>
    </nav>

    <div id="notification-panel" class="notification-panel"></div>
