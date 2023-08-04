<?php

class Logout extends Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function render()
  {
    session_unset();
    session_destroy();
    $this->redirect('');
  }
}
