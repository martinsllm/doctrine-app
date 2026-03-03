<?php

namespace App\Router;

use App\Core\Controller;
use Exception;

class Router
{
    function routes()
    {
        return require __DIR__ . '/Routes.php';
    }

    function exactMatchUriInArrayRoutes($uri, $routes)
    {
        if(array_key_exists($uri, $routes)) {
            return [$uri => $routes[$uri]];
        }

        return [];
    }

    function regularExpressionMatchUriInArrayRoutes($uri, $routes)
    {
        return array_filter(
        $routes,
        function ($route) use ($uri) {
            $regex = str_replace('/', '\/', ltrim($route, '/'));
            return preg_match("/^$regex$/", ltrim($uri, '/'));
        },
        ARRAY_FILTER_USE_KEY
        );
    }

    function params($uri, $matchedUri)
    {
        if (!empty($matchedUri)) {
            $matchedToGetParams = array_keys($matchedUri)[0];
            return array_diff(
                $uri,
                explode('/', ltrim($matchedToGetParams, '/'))
            );
        }
        return [];
    }

    function paramsFormat($uri, $params)
    {
        $paramsData = [];
        foreach ($params as $index => $param) {
            $paramsData[$uri[$index - 1]] = $param;
        }

        return $paramsData;
    }

    function router()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        $routes = $this->routes();

        $matchedUri = $this->exactMatchUriInArrayRoutes($uri, $routes);
        
        $params = [];
        if(empty($matchedUri)) {
            $matchedUri = $this->regularExpressionMatchUriInArrayRoutes($uri, $routes);
            $uri = explode('/', ltrim($uri, '/'));
            $params = $this->params($uri, $matchedUri);
            $params = $this->paramsFormat($uri, $params);
        }

        if(!empty($matchedUri)) {
            $controller = new Controller($matchedUri, $params);
            $controller->index();
            return;
        }

        throw new Exception('Failed');
        
    }
}