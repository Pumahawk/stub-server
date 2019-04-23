<?php

namespace App\Stub;

class StubRepository {
  
  public $listStub;
  
  public function addStub(Stub $stub) {
    $this -> listStub[] = $stub;
  }
  
  public function getByUrl($url) {
    foreach ($this -> listStub as $stub) {
      if ($stub -> getUrl() == $url) {
        return $stub;
      }
    }
    return false;
  }
}