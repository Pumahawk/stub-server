<?php

namespace App\Stub;

use App\Exceptions\StubHttpUrlException;
use App\Exceptions\StubHttpMethodException;
use App\Exceptions\StubHttpResponseException;

class Stub {
  
  public $url;
  public $method;
  public $response;
  
  public function __construct($url = null, $method = null, $response = null) {
    if($url != null) {
      $this -> setUrl($url);
    } else {
      $this -> url = $url;
    }
    if ($method != null) {
      $this -> setMethod($method);
    } else {
      $this -> method = $method;
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
  
  public function setMethod($method) {
    if(!is_string($method)) {
      throw new StubHttpMethodException("Il metodo deve essere una stringa", 1);
    }
    
    switch ($method) {
      case 'GET':
      case 'POST':
        $this -> method = $method;
        break;
      default:
        throw new StubHttpMethodException("Metodo $method non supportato", 1);
        break;
    }
  }
  
  
  public function setResponse($response) {
    if(is_array($response)) {
      $this -> response = $response;
    } else {
      throw new StubHttpResponseException("La richiesta inserita deve essere un array", 1);
      
    }
  }

}