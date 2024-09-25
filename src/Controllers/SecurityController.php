<?php

namespace Template\Controllers;

use Template\Libs\Session;

class SecurityController extends Session
{
  public function __construct()
  {
    parent::__construct("usertype");
  }

  public function UserTypes()
  {
    $this->view("user-types/index", [
      "controller" => "security",
      "view" => "user-types"
    ]);
  }

  public function UserActions()
  {
    $this->view("user-actions/index", [
      "controller" => "security",
      "view" => "user-actions"
    ]);
  }
}
