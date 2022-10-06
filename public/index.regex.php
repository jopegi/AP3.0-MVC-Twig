<?php

/**
 * Enrutador basado en REGEX
 */

require_once dirname(__DIR__)  . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; // vendor/autoload.php';

$rootDir = dirname(__DIR__);

$rutas  = file_get_contents($rootDir . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "routes.json");
$rutas = json_decode($rutas, true);

$requestURI = $_SERVER['REQUEST_URI'];
/* echo "<pre>";
print_r($requestURI);
echo "</pre>"; */

$regex = '/(?<=\/)(?:\w|\W^|[^\/])+/';
preg_match_all($regex, $requestURI, $matches, PREG_SET_ORDER, 0);

$largo = count($matches);

if ($largo > 2) require_once $rootDir . "/templates/404.html";

if ($largo  === 0 && array_key_exists('', $rutas)) {
    $controllerFile = ucwords($rutas['']);
    $controllerFilePath = $rootDir . "/src/Controllers/" . $controllerFile;
    if (file_exists($controllerFilePath)) {
        require_once $controllerFilePath;
        $controllerInstanceName = 'src\\Controllers\\' . pathinfo($controllerFile, PATHINFO_FILENAME);
        $controller = new $controllerInstanceName();
    } else require_once $rootDir . "/templates/404.html";
} else if ($largo  === 1 && $matches[0][0] != 'detalleCliente' && array_key_exists($matches[0][0], $rutas)) {
    $controllerFile = ucwords($rutas[$matches[0][0]]);
    $controllerFilePath = $rootDir . "/src/Controllers/" . $controllerFile;
    if (file_exists($controllerFilePath)) {
        require_once $controllerFilePath;
        $controllerInstanceName = 'src\\Controllers\\' . pathinfo($controllerFile, PATHINFO_FILENAME);
        $controller = new $controllerInstanceName();
    } else require_once $rootDir . "/templates/404.html";
} else if ($largo  === 2 && $matches[0][0] == 'detalleCliente' && array_key_exists($matches[0][0], $rutas)) {
    $match = preg_match('/(\d)+/', $matches[1][0]);
    if($match == 0) require_once $rootDir . "/templates/404.html";
    $urlParam = $matches[1][0];
    $controllerFile = ucwords($rutas[$matches[0][0]]);
    $controllerFilePath = $rootDir . "/src/Controllers/" . $controllerFile;
    if (file_exists($controllerFilePath)) {
        require_once $controllerFilePath;
        $controllerInstanceName = 'src\\Controllers\\' . pathinfo($controllerFile, PATHINFO_FILENAME);
        $controller = new $controllerInstanceName();
        // Pasamos el urlParam a un método de clase
    } else require_once $rootDir . "/templates/404.html";
} else require_once $rootDir . "/templates/404.html";
