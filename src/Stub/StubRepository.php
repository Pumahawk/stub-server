<?php

namespace App\Stub;

use Symfony\Component\Config\FileLocator;
use App\Stub\Loader\StubLoader;

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
  
  public static function loadFromDirectory($directory) {
    $stubs  = StubRepository::recursiveLoadDirectory($directory);
    $newStubs = [];
    foreach ($stubs as $stub) {
      $newStubs[] = \substr($stub, \strlen($directory)+1);
    }
    
    $stubRepo = new StubRepository();
    $locator = new FileLocator([$directory]);
    $stubLoader = new StubLoader($locator);
    
    foreach ($newStubs as $stubFile) {
      foreach($stubLoader -> load($stubFile) as $stub) {
        $stubRepo -> addStub($stub);
      }
    }
    return $stubRepo;
  }
  
  private static function recursiveLoadDirectory($directory) {
    $stubPath = [];
    $files = \scandir($directory);
    foreach ($files as $file) {
      if(is_file($directory.'/'.$file) && 'json' == \pathinfo($file, PATHINFO_EXTENSION)) {
        $stubPath[] = $directory.'/'.$file;
      } else if($file != '..' && $file != '.') {
        foreach(StubRepository::recursiveLoadDirectory($directory.'/'.$file) as $stubP) {
          $stubPath[] = $stubP;
        }
      }
    }
    return $stubPath;
  }
}