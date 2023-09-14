<?php

class Session extends Controller
{
  public $sites;
  public $defaultSite;
  public $user;
  public $userId;
  public $userType;
  public $url;

  public function __construct($url)
  {
    parent::__construct();
    if (session_status() == PHP_SESSION_NONE) session_start();

    $this->url = $url;

    $this->defaultSite = "main";
    $this->sites = $this->sites();

    $this->userType = $_SESSION["userType"] ?? 0;
    $this->userId = $_SESSION["userId"] ?? "";
    $this->user = $_SESSION["user"] ?? "";

    $this->validateSession();
  }

  public function sites()
  {
    return [
      "0" => [
        'login'
      ],
      "1" => [
        "default" => 'admin',
        'main', 'logout', 'usuario'
      ],
      "2" => [
        "default" => 'secretaria',
        'main', 'logout',
      ],
      "3" => [
        "default" => 'tecnico',
        'main', 'logout',
      ],
    ];
  }

  public function validateSession()
  {
    if ($this->existsSession()) {
      if ($this->isAuthorized($this->url, $this->userType)) {
      } else {
        $this->redirect($this->sites[$this->userType]['default']);
      }
    } else {
      if ($this->isAuthorized($this->url, $this->userType)) {
      } else {
        new Errores;
      }
    }
  }

  public function existsSession()
  {
    return isset($_SESSION["userId"]);
  }

  public function initialize($user)
  {
    $_SESSION["userId"] = $user['id'];
    $_SESSION["userType"] = $user['idtipo_usuario'];
    $_SESSION["user"] = $user['nombres'];

    $this->redirect($this->defaultSite);
    // $this->redirect($this->sites[$_SESSION["userType"]]['default']);
  }

  public function isAuthorized($view, $tipo)
  {
    return in_array($view, $this->sites[$tipo]);
  }

  public function logout()
  {
    session_unset();
    session_destroy();
  }
}
