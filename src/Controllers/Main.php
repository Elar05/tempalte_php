<?php

namespace Template\Controllers;

use Template\Libs\Session;

class Main extends Session
{
  public function __construct()
  {
    parent::__construct("main");
  }

  public function render()
  {
    $this->view('main/index', [
      "controller" => "main",
      "view" => "main",
    ]);
  }
}
