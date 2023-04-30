<?php

$app->before(
    function () use ($app) {

        $origin = $app->request->getHeader("ORIGIN") ? $app->request->getHeader("ORIGIN") : '*';

        $app->response->setHeader("Access-Control-Allow-Origin", $origin)
            ->setHeader("Access-Control-Allow-Origin", '*')
            ->setHeader("Access-Control-Allow-Methods", 'GET,PUT,POST,DELETE,OPTIONS')
            ->setHeader("Access-Control-Allow-Headers", 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization')
            ->setHeader("Access-Control-Allow-Credentials", true);

        $app->response->sendHeaders();
        return true;
    }
);

$router = $di->getRouter();

$router->add("/api/v1/get", "patient::get", ["GET"]);
$router->add("/api/v1/get/{id}", "patient::getById", ["GET"]);
$router->add("/api/v1/post", "patient::post", ["POST"]);
$router->add("/api/v1/put/{id}", "patient::put", ["PUT"]);
$router->add("/api/v1/delete/{id}", "patient::delete", ["DELETE"]);

$router->handle($_SERVER['REQUEST_URI']);