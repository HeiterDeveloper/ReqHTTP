<?php

/**
*@author Heiter Developer <dev@heiterdeveloper.com>
*@link https://github.com/HeiterDeveloper/ReqHTTP
*@copyright 2021 Heiter Developer
*@license Aapache License 2.0
*@license https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
**/

class ReqHTTP {

  private static $paramGet;
  private static $paramPost;
  private static $method;
  private static $status;
  private static $instance;

  public static function init(){
    self::$instance = new ReqHTTP();
    self::$paramGet = $_GET;
    self::$paramPost = $_POST;
    self::$method = $_SERVER['REQUEST_METHOD'];
    self::$status = true;
    return self::$instance;
  }

  private function setStatus(){
    self::$status = false;
  }

  public static function checkGet($nameParam){

    if(self::$status === true){

      $typeObj = gettype($nameParam);

      if($typeObj == "array"){

          $keys = array_keys($nameParam);
          $vals = array_values($nameParam);

          if(!isset(self::$paramGet[$keys[0]]) || self::$paramGet[$keys[0]] !== $vals[0]){
            self::setStatus();
          }

      }
      else if($typeObj == "string"){

        if(!isset(self::$paramGet[$nameParam])){
          self::setStatus();
        }
      }
    }
    return self::$instance;
  }

  public static function checkPost($nameParam){


    if(self::$status === true){

      $typeObj = gettype($nameParam);

      if($typeObj == "array"){

          $keys = array_keys($nameParam);
          $vals = array_values($nameParam);

          if(!isset(self::$paramPost[$keys[0]]) || self::$paramPost[$keys[0]] !== $vals[0]){
            self::setStatus();
          }
      }
      else if($typeObj == "string"){

        if(!isset(self::$paramPost[$nameParam])){
          self::setStatus();
        }
      }
    }
    return self::$instance;
  }

  public static function isGet(){

    if(self::$method !== "GET"){
      self::setStatus();
    }
    return self::$instance;
  }

  public static function isPost(){

    if(self::$method !== "POST"){
      self::setStatus();
    }
    return self::$instance;
  }

  public static function exec($task=false, $method, $params=false, $exitAfterRun=false){

    if(self::$status === true){

      if(is_callable(array($task, $method))){
        $task->$method($params);
      }

      if($exitAfterRun === true){
        exit;
      }
    }
  }
}


?>
