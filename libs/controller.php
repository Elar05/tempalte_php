<?php

class Controller
{
  public $model;
  public $view;

  public function __construct($user, $userType)
  {
    $this->view = new View($user, $userType);
  }

  public function loadModel($name)
  {
    $url = "models/{$name}Model.php";

    if (file_exists($url)) {
      require $url;
      $model = "{$name}Model";
      $this->model = new $model();
    }
  }

  public function redirect($url, $mensajes = [])
  {
    $data = [];
    $params = '';

    foreach ($mensajes as $key => $value) {
      array_push($data, $key . '=' . $value);
    }
    $params = join('&', $data);

    if ($params != '') {
      $params = '?' . $params;
    }
    header('Location: ' . constant('URL') . $url . $params);
    exit();
  }

  public function response($data)
  {
    echo json_encode($data);
    exit();
  }
}
