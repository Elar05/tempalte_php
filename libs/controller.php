<?php

class Controller
{
  public $model;
  public $view;
  public $sites;

  public function __construct()
  {
    $this->view = new View();
    $this->sites = $this->sites();
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

  public function sites()
  {
    return [
      "0" => [
        'login'
      ],
      "1" => [
        'main', 'logout'
      ],
      "2" => [
        'main', 'logout'
      ],
      "3" => [
        'main', 'logout'
      ],
    ];
  }

  public function hasAccess($view, $tipo)
  {
    return in_array($view, $this->sites[$tipo]);
  }

  function redirect($url, $mensajes = [])
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
  }
}
