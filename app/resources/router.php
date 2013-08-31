<?php
$router = new \Phalcon\Mvc\Router();

// Custom routes

$router->add("/login",
    array(
        "controller" => "auth",
        "action"     => "login",
    )
);

// TODO : change it to authController::registerAction
$router->add("/register",
    array(
        "controller" => "auth",
        "action"     => "register",
    )
);


return $router;
