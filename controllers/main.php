<?php

class Main extends Session
{
  public $model;
  public $view;

  function __construct($url)
  {
    parent::__construct($url);
  }

  function render()
  {
    $this->view->render('main/index');
  }
}
