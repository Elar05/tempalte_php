<?php

use Template\Controllers\Main;
use Template\Controllers\Logout;
use Template\Controllers\Errores;
use Template\Controllers\GeneralController;
use Template\Controllers\Login;
use Template\Controllers\SecurityController;

$router = new \Bramus\Router\Router();

$router->get("/", function () {
  $main = new Main();
  $main->render();
});

$router->get("/main", function () {
  $main = new Main();
  $main->render();
});

$router->mount("/login", function () use ($router) {
  $router->get("/", function () {
    $login = new Login();
    $login->render();
  });

  $router->post("/auth", function () {
    $login = new Login();
    $login->auth();
  });
});

$router->mount("/security/user-types", function () use ($router) {
  $router->get("/", function () {
    $controller = new SecurityController();
    $controller->UserTypes();
  });

  $router->get("/list", function () {
    $controller = new GeneralController();
    $controller->list();
  });

  $router->get("/edit", function () {
    $controller = new GeneralController();
    $controller->edit();
  });

  $router->post("/save", function () {
    $controller = new GeneralController();
    $controller->store();
  });

  $router->post("/delete", function () {
    $controller = new GeneralController();
    $controller->destroy();
  });
});

$router->mount("/security/user-actions", function () use ($router) {
  $router->get("/", function () {
    $controller = new SecurityController();
    $controller->UserActions();
  });

  $router->get("/list", function () {
    $controller = new GeneralController();
    $controller->list();
  });

  $router->get("/edit", function () {
    $controller = new GeneralController();
    $controller->edit();
  });

  $router->post("/save", function () {
    $controller = new GeneralController();
    $controller->store();
  });

  $router->post("/delete", function () {
    $controller = new GeneralController();
    $controller->destroy();
  });
});

$router->get("/logout", function () {
  new Logout("logout");
});

$router->set404(function () {
  new Errores();
});

$router->run();
