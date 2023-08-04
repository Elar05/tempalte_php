<?php

class Login extends Controller
{
  public $model;
  public $view;

  public function __construct()
  {
    parent::__construct();
  }

  public function render()
  {
    $this->view->render('login/index', ["message" => ""]);
  }

  public function auth()
  {
    if (empty($_POST['email']) || empty($_POST['password'])) {
      $this->redirect('', ["error" => Errors::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
      return;
    }

    $user = $this->model->login($_POST['email']);

    if (isset($user['email']) && ($user["email"] == $_POST["email"])) {
      if (password_verify($_POST["password"], $user["password"])) {
        $_SESSION['session'] = 'init';
        $_SESSION['usuario'] = $user['id'];
        $_SESSION['tipo'] = $user['idtipo_usuario'];
        $_SESSION['nombres'] = $user['nombres'];

        $this->redirect('');
      } else {
        $this->redirect('', ["error" => Errors::ERROR_LOGIN_AUTHENTICATE_DATA]);
        return;
      }
    } else {
      $this->redirect('', ["error" => Errors::ERROR_LOGIN_AUTHENTICATE_DATA]);
      return;
    }
  }
}
