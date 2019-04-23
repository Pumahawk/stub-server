<?php

namespace App\Stub\Loader;

use App\Stub\Stub;
use Symfony\Component\Config\Loader\FileLoader;

/**
 * Loader per file stub
 */
class StubLoader extends FileLoader {
  
  public function load($resource, $type = null) {
      $path = $this -> locator -> locate($resource);
      $configValues = json_decode(file_get_contents($path), true);
      $stubList = [];
      foreach($configValues['stubs'] as $stub) {
        $stubList[] = new Stub($stub['url'], $stub['method'], $stub['response']);
      }
      return $stubList;
  }

  public function supports($resource, $type = null) {
      return is_string($resource) && 'json' === pathinfo(
          $resource,
          PATHINFO_EXTENSION
      );
  }
}
