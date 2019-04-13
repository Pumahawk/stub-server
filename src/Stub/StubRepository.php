<?php

namespace App\Stub;

class StubRepository {
  
  public $pathFolder;
  public $listStub;
  
  public function __construct($pathFolder = null) {
    if (\is_dir($pathFolder)) {
      $this -> pathFolder = $pathFolder;
    } else {
      throw new \Exception("Impossibile trovare la cartella $pathFolder", 1);
    }
  }
  
  public function addStub(Stub $stub) {
    $this -> listStub($stub);
  }
  
  public function getStub($url) {
    
  }
}