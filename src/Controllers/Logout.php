<?php

namespace Template\Controllers;

use Template\Libs\Session;

class Logout extends Session
{
  public function __construct($url)
  {
    parent::__construct($url);
    $this->logout();
    $this->redirect('');
  }
}
