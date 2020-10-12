<?php

try {
    include __DIR__ . '/../includes/autoload.php';

    $route = rtrim(ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/'), '/');

    $entryPoint = new \Generic\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \Merkar\MerkarRoutes());
    $entryPoint->run();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in '
    . $e->getFile() . ':' . $e->getLine();
}