<?php

namespace Tests\Stub\Loader;

use PHPUnit\Framework\TestCase;
use App\Stub\Loader\StubLoader;
use App\Stub\Stub;
use Symfony\Component\Config\FileLocator;

class StubTest extends TestCase {
  public function testLoadResource() {
    $resourceDirectory = 'resources/stub';
    $pathResource = "stub.json";
    $locator = new FileLocator([$resourceDirectory]);
    $loader = new StubLoader($locator);
    $stub = $loader -> load($pathResource);
    
    $expected = [new Stub('/api/login', ['token' => '12345token54321'])];
    $expected[0] -> setFile('resources/stub/stub.json');
    
    $this -> assertEquals($expected, $stub);
  }
}