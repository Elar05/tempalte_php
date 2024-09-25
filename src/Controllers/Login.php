<?php

namespace Template\Controllers;

use Template\Libs\Session;
use Template\Models\User;

class Login extends Session
{
  public function __construct()
  {
    parent::__construct("login");
  }

  public function render()
  {
    $this->view('login/index');
  }

  public function auth()
  {
    $data = $this->validate([
      'email' => "required|email",
      'password' => "required"
    ]);

    $login = new User();
    $user = $login->login($data["email"], $data["password"]);
    if (isset($user["id"])) {
      $this->initialize($user);
    }

    $this->response($user);
  }
}
