<?php

$router = $di->getRouter();

// Define your routes here
$router->add(
    "/nmap/scan",
    [
        "controller" => "nmap",
        "action"     => "scan", 
    ]
    );
$router->handle();
