<?php

namespace Template\Controllers;

use Template\Libs\Session;
use Template\Models\GeneralModel;

class GeneralController extends Session
{
  public function __construct()
  {
    parent::__construct("main");
  }

  public function list()
  {
    $data = $_GET["data"] ?? "";
    $sp = $this->getSP();
    $data = rtrim(GeneralModel::getAll($sp, $data), "¬");
    $this->response(["data" => $data]);
  }

  public function edit()
  {
    $sp = $this->getSP();
    $data = GeneralModel::get($sp, $_GET["id"]);
    $this->response(["data" => $data]);
  }

  public function store()
  {
    $sp = $this->getSP();
    $data = GeneralModel::save($sp, $_POST["data"]);
    $this->response(["data" => $data]);
  }

  public function destroy()
  {
    $sp = $this->getSP();
    $data = GeneralModel::delete($sp, $_POST["data"]);
    $this->response(["data" => $data]);
  }

  public function getSP(): string
  {
    $controller = ucfirst($_GET["controller"]);
    $view = str_replace(" ", "", ucwords(str_replace("-", " ", $_GET["view"])));
    return "{$controller}{$view}";
  }
}
