<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'; // vendor/autoload.php';

$rutas  = file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "routes.json");
$rutas = json_decode($rutas, true);

$requestURI = $_SERVER['REQUEST_URI']; // Obtenemos la URI solicitada a trevés del navegador
$requestURI = explode('/', $_SERVER['REQUEST_URI']); // Pasamos los paths de la URI a un array
$requestURI = array_values(array_filter($requestURI)); // Eliminamos del array cualquier posición vacía

/* echo "<pre>";
print_r($requestURI);
echo "</pre>"; */

/*
URI's aceptadas:
/
/listaProductos
/listaClientes
/departamentos
/empleados
/pedidos
/detalleCliente/id
*/

$largo = count($requestURI);

if ($largo === 0) { // Cargamos el controlador Home
    $controllerFile = dirname(__DIR__) . "/src/Controllers/Home.php";
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controllerInstanceName = 'src\\Controllers\\Home';
        $controller = new $controllerInstanceName();
    } else require_once dirname(__DIR__) . "/templates/404.php";
} else if ($largo === 1) { // Cargamos cualquier controlador válido menos detalleCliente
    if (!array_key_exists($requestURI[0], $rutas)) require_once dirname(__DIR__) . "/templates/404.php"; // Comprobamos si el controlador está definido entre las rutas aceptadas
    if ($requestURI[0] === 'detalleCliente') require_once dirname(__DIR__) . "/templates/404.php"; // detallecliente debe de ir seguido de un segundo parámetro
    else {
        $controllerName = ucwords($rutas[$requestURI[0]]);
        $controllerFile = dirname(__DIR__) . "/src/Controllers/" . $controllerName;
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerInstanceName = 'src\\Controllers\\' . pathinfo($controllerFile, PATHINFO_FILENAME);
            $controller = new $controllerInstanceName();
            $controller->{strtolower(pathinfo($controllerFile, PATHINFO_FILENAME))}();
        } else require_once dirname(__DIR__) . "/templates/404.php";
    }
} else if ($largo === 2) { // Cargamos el controlador detalleCliente siempre que recibamos también el dato que lo identifique
    if (!array_key_exists($requestURI[0], $rutas)) require_once dirname(__DIR__) . "/templates/404.php"; // Comprobamos si el controlador está definido entre las rutas aceptadas
    if ($requestURI[0] !== 'detalleCliente') require_once dirname(__DIR__) . "/templates/404.php"; // solo detallecliente puede de ir seguido de un segundo parámetro
    if ($requestURI[0] === 'detalleCliente' && !isset($requestURI[1]))  require_once dirname(__DIR__) . "/templates/404.php";// No recibimos el identificador necesario
    if ($requestURI[0] === 'detalleCliente' && isset($requestURI[1])) { // Si recibimos el identificador necesario
        $param = $requestURI[1];
        $controllerName = ucwords($rutas[$requestURI[0]]);
        $controllerFile = dirname(__DIR__) . "/src/Controllers/" . $controllerName;
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerInstanceName = 'src\\Controllers\\' . pathinfo($controllerFile, PATHINFO_FILENAME);
            $controller = new $controllerInstanceName();
            $controller->getDetalleCliente($param);
            // pasamos el param a un método de la clase
        } else require_once dirname(__DIR__) . "/templates/404.php";
    }else{
        require_once dirname(__DIR__) . "/templates/404.php";
    }
} else {
    require_once dirname(__DIR__) . "/templates/404.php";
}
