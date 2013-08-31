<?php
$router = new \Phalcon\Mvc\Router();

// Custom routes

$router->add("/login",
    array(
        "controller" => "auth",
        "action"     => "login",
    )
);


return $router;
