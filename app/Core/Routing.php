<?php

namespace Core;

use Core\Exception\LogicException;
use Core\Exception\NotFoundException;
use Core\Response\HttpResponse;

class Routing
{
    /**
     * @var array
     */
    private $routes;

    /**
     * @param array $server
     */
    public function runApplication(array $server)
    {
        $routes = $this->getRoutes();

        $routeConfig = $this->findRoute($routes, $server['REQUEST_URI']);

        $response = $this->runRoute($routeConfig);
        $response->send();
    }

    /**
     * @param array $routeConfig
     * @return HttpResponse
     * @throws \Exception
     */
    private function runRoute(array $routeConfig)
    {
        $controller = new $routeConfig['controller']();
        $actionCallback = [$controller, $routeConfig['action']];

        if (!is_callable($actionCallback)) {
            throw new \Exception(
                'Unable to run '.$routeConfig['controller'].'::'.$routeConfig['action']
            );
        }

        $response = call_user_func_array($actionCallback, []);
        if (!($response instanceof HttpResponse)) {
            throw new LogicException(
                "action {$routeConfig['controller']}::{$routeConfig['action']} must return an instance of HttpResponse"
            );
        }

        return $response;
    }

    /**
     * @param array $routes
     * @param string $url
     * @return array
     * @throws NotFoundException
     */
    private function findRoute(array $routes, $url)
    {
        foreach ($routes as $route) {
            if (strnatcasecmp($route['url'], $url) === 0) {
                return $route;
            }
        }

        throw new NotFoundException('route not found for url: '.$url);
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function getRoutes()
    {
        if (is_null($this->routes)) {
            $routesPath = ROOT_DIR.'/config/routes.php';
            if (!file_exists($routesPath)) {
                throw new NotFoundException('Routing file does not exist: '.$routesPath);
            }

            $this->routes = require_once $routesPath;
        }

        return $this->routes;
    }
}