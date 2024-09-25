<?php

namespace Template\Models;

use PDOException;
use Template\Libs\Model;
use PDO;

class GeneralModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  static public function getAll($sp, $data)
  {
    try {
      $pdo = new Model();
      $query = $pdo->prepare("CALL {$sp}List('$data')");
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC)["data"];
    } catch (PDOException $e) {
      error_log("GeneralModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  static public function get($sp, $data)
  {
    try {
      $pdo = new Model();
      $query = $pdo->prepare("CALL {$sp}Edit('$data')");
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC)["data"];
    } catch (PDOException $e) {
      error_log("GeneralModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  static public function save($sp, $data)
  {
    try {
      $pdo = new Model();
      $query = $pdo->prepare("CALL {$sp}Save('$data')");
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC)["data"];
    } catch (PDOException $e) {
      error_log("GeneralModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  static public function delete($sp, $data)
  {
    try {
      $pdo = new Model();
      $query = $pdo->prepare("CALL {$sp}Delete('$data')");
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC)["data"];
    } catch (PDOException $e) {
      error_log("GeneralModel::delete() -> " . $e->getMessage());
      return false;
    }
  }
}