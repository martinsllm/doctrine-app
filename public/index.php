<?php

require 'bootstrap.php';

try {
    $router = new App\Router\Router();
    $router->router();
} catch (Exception $e) {
    echo $e->getMessage();
}