<?php

namespace Generic;
class EntryPoint
{
    private $route;
    private $method;
    private $routes;

    public function __construct(string $route, string $method, \Generic\Routes $routes)
    {
        $this->route = $route;
        $this->method = $method;
        $this->routes = $routes;
        $this->checkUrl();
    }

    private function checkUrl()
    {
        if ($this->route !== strtolower($this->route)) {
            http_response_code(301);
            header('location: ' . strtolower($this->route));
        }
    }

    private function loadTemplate($templateFileName, $variables = [])
    {
        extract($variables);
        ob_start();
        include __DIR__ . '/../../templates/' . $templateFileName;
        return ob_get_clean();
    }

    public function run()
    {
        $routes = $this->routes->getRoutes();
        $controller = $routes[$this->route][$this->method]['controller'];
        $action = $routes[$this->route][$this->method]['action'];
    
        $page = $controller->$action();
        $title = $page['title'] ?? 'Sistema de Usuarios';

        if (isset($page['variables']))
        {
            $output = $this->loadTemplate($page['template'], $page['variables']);
        } else {
            $output = $this->loadTemplate($page['template']);
        }

        echo $this->loadTemplate('layout.html.php', ['output' => $output, 'title' => $title]);

    }
}