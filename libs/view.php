<?php

namespace Libs;

class View
{
  public $d;
  public $user;
  public $userType;

  public function __construct($user, $userType)
  {
    $this->user = $user;
    $this->userType = $userType;
  }

  public function render($nombre, $data = [])
  {
    $this->d = $data;
    $this->handleMessages();
    require 'views/' . $nombre . '.php';
    exit;
  }

  private function handleMessages()
  {
    if (isset($_GET['success']) && isset($_GET['error'])) {
      // no se muestra nada porque no puede haber un error y success al mismo tiempo
    } elseif (isset($_GET['success'])) {
      $this->handleSuccess();
    } elseif (isset($_GET['error'])) {
      $this->handleError();
    } elseif (isset($_GET['message'])) {
      $this->handleMessage();
    }
  }

  private function handleError()
  {
    if (isset($_GET['error'])) {
      $hash = $_GET['error'];
      $errors = new Errors();

      if ($errors->existsKey($hash)) {
        // error_log('View::handleError() existsKey =>' . $errors->get($hash));
        $this->d['error'] = $errors->get($hash);
      } else {
        $this->d['error'] = NULL;
      }
    }
  }

  private function handleSuccess()
  {
    if (isset($_GET['success'])) {
      $hash = $_GET['success'];
      $success = new Success();

      if ($success->existsKey($hash)) {
        // error_log('View::handleError() existsKey =>' . $success->existsKey($hash));
        $this->d['success'] = $success->get($hash);
      } else {
        $this->d['success'] = NULL;
      }
    }
  }

  private function handleMessage()
  {
    if (isset($_GET['message'])) {
      $this->d['message'] = $_GET['message'];
    }
  }

  public function showMessages()
  {
    $this->showError();
    $this->showSuccess();
    $this->showMessage();
  }

  public function showError()
  {
    if (array_key_exists('error', $this->d)) {
      echo '<div class="alert alert-danger">' . $this->d['error'] . '</div>';
    }
  }

  public function showSuccess()
  {
    if (array_key_exists('success', $this->d)) {
      echo '<div class="alert alert-success">' . $this->d['success'] . '</div>';
    }
  }

  public function showMessage()
  {
    if (array_key_exists('message', $this->d)) {
      echo '<div class="alert alert-info">' . $this->decrypt($this->d['message']) . '</div>';
    }
  }

  public function decrypt($value)
  {
    return base64_decode($value);
  }
}
