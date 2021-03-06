<?php

use App\Controllers\HomeController;

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/config.php';

if (session_status() == 1) {
    session_start();
}

// Verifica se recebeu algum parametro
if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);

    foreach ($url as $key => $str) {
        $url[$key] = str_replace('-', '', $str);
    }

    $file = __DIR__ . '/app/Controllers/' . ucfirst($url[0]) . 'Controller.php';

    // Verifica se a controller existe
    if (file_exists($file)) {
        // Caso exista, carrega o arquivo;
        require_once $file;

        $controller_name = ucfirst($url[0]) .  'Controller';

        $controller_name = "App\\Controllers\\" . $controller_name;

        // Cria um objeto da controller
        $controller = new $controller_name();

        // Verifica se está chamando um método em específico
        if (isset($url[1]) && $url[1] != '' && $url[1] != 'null') {
            $function = $url[1];

            $function = explode('-', $function);

            foreach ($function as $key => $string) {
                $function[$key] = ucfirst($string);
            }

            $function = implode("", $function);

            // Verifica se o método existe
            if (method_exists($controller, $function)) {
                // Caso o método exista, chama ele
                $controller->$function();
            } else {
                // Caso o contrário exibe a página de erro
                require_once __DIR__ . '/404.php';
            }
        } else {
            // Caso não esteja chamando um função carrega o index
            $controller->index();
        }
    } else {
        // Caso não exista a controller carrega a página de erro
        require_once __DIR__ . '/404.php';
    }
} else {
    // Caso não tenha recebido carrega a home
    require_once __DIR__ . '/app/Controllers/HomeController.php';
    $home = new HomeController();
    $home->index();
}
