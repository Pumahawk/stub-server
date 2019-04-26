<?php

namespace App\Stub;

use App\Exceptions\StubHttpUrlException;
use App\Exceptions\StubHttpMethodException;
use App\Exceptions\StubHttpResponseException;

class Stub {
  
  private $url;
  private $response;
  private $file;
  
  public function __construct($url = null, $response = null) {
    if($url != null) {
      $this -> setUrl($url);
    } else {
      $this -> url = $url;
    }
    if($response != null) {
      $this -> setResponse($response);
    } else {
      $this -> response = $response;
    }
  }
  
  public function setUrl($url) {
    if (!is_string($url)) {
      throw new StubHttpUrlException("L'url inserito deve essere una stringa", 1);
    } else {
      $this -> url = $url;
    }
  }
  
  
  public function setResponse($response) {
    if(is_array($response)) {
      $this -> response = $response;
    } else {
      throw new StubHttpResponseException("La richiesta inserita deve essere un array", 1);
      
    }
  }
  
  public function getUrl() {
    return $this -> url;
  }
  
  public function getResponse() {
    return $this -> response;
  }
  
  public function setFile($file) {
    $this -> file = $file;
  }
  
  public function getFile() {
    return $this -> file;
  }

}