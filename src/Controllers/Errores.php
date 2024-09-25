<?php

namespace Template\Controllers;

use Template\Libs\Controller;

class Errores extends Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->view('errores/index');
  }
}
