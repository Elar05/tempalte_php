<?php

namespace Template\Libs;

class View
{
  public function __construct(
    private array $user
  ) {}

  public function render($name, $data = [])
  {
    foreach ($data as $key => $value) {
      $$key = $value;
    }

    if (file_exists("src/views/$name.php"))
      require "src/views/$name.php";
    else
      require "src/views/errores/index.php";

    exit;
  }
}
