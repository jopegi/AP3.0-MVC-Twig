<?php

require_once __DIR__  . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; // vendor/autoload.php';

$rutas  = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "routes.json");
$rutas = json_decode($rutas, true);

$requestURI = $_SERVER['REQUEST_URI'];
$requestURI = explode('/', $_SERVER['REQUEST_URI']);
$requestURI = array_values(array_filter($requestURI));

echo "<pre>";
print_r($requestURI);
echo "</pre>";

if (!isset($requestURI[1])) {
    $controllerFile = __DIR__ . "/src/Controllers/Home.php";
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controllerInstanceName = 'src\\Controllers\\Home';
        $controller = new $controllerInstanceName();
    } else require_once __DIR__ . "/templates/404.html";
} 

else if(!array_key_exists($requestURI[1], $rutas)) require_once __DIR__ . "/templates/404.html";

else if ($requestURI[1] === 'detalleCliente' && !isset($requestURI[2])) require_once __DIR__ . "/templates/404.html";

else if ($requestURI[1] === 'detalleCliente' && isset($requestURI[2])) {
    if(isset($requestURI[3])) require_once __DIR__ . "/templates/404.html";
    $param = $requestURI[2];
    $controllerName = ucwords($requestURI[1]);
    $controllerFile = __DIR__ . "/src/Controllers/" . $controllerName . ".php";
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controllerInstanceName = 'src\\Controllers\\' . $controllerName;
        $controller = new $controllerInstanceName();
        // pasamos el param a un método de la clase
    } else require_once __DIR__ . "/templates/404.html";

} else {
    $controllerName = ucwords($requestURI[1]);
    $controllerFile = __DIR__ . "/src/Controllers/" . $controllerName . ".php";
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controllerInstanceName = 'src\\Controllers\\' . $controllerName;
        $controller = new $controllerInstanceName();
    } else require_once __DIR__ . "/templates/404.html";
}

