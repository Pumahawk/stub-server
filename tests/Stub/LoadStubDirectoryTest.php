<?php

namespace Tests\Stub;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use App\Stub\Stub;
use App\Stub\Loader\StubLoader;
use App\Stub\StubRepository;

function getStubList($directory) {
  $stubPath = [];
  $files = \scandir($directory);
  foreach ($files as $file) {
    if(is_file($directory.'/'.$file) && 'json' == \pathinfo($file, PATHINFO_EXTENSION)) {
      $stubPath[] = $directory.'/'.$file;
    } else if($file != '..' && $file != '.') {
      foreach(getStubList($directory.'/'.$file) as $stubP) {
        $stubPath[] = $stubP;
      }
    }
  }
  return $stubPath;
}

class LoadStubDirectoryTest extends TestCase {
  public function testRecursiveDirectory() {
    $directory = 'resources/recursive';
    $stubPath = [
      'resources/recursive/stub0.json',
      'resources/recursive/stub1.json',
      'resources/recursive/sub/stub2.json'
    ];
    $stubResp = getStubList($directory);
    
    $this -> assertEquals($stubPath, $stubResp);
    
    $stubRepo = new StubRepository();
    $locator = new FileLocator(['.']);
    $stubLoader = new StubLoader($locator);
    
    foreach ($stubResp as $stubFile) {
      foreach($stubLoader -> load($stubFile) as $stub) {
        $stubRepo -> addStub($stub);
      }
    }
    
    $expectedStub = [
      new Stub('/stub/0', ['name' => 'stub0']),
      new Stub('/stub/1', ['name' => 'stub1']),
      new Stub('/stub/2', ['name' => 'stub2']),
    ];
    $expectedStub[0] -> setFile('./resources/recursive/stub0.json');
    $expectedStub[1] -> setFile('./resources/recursive/stub1.json');
    $expectedStub[2] -> setFile('./resources/recursive/sub/stub2.json');
    
    $this -> assertEquals($expectedStub, $stubRepo -> listStub);
  }
}