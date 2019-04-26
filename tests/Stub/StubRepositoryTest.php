<?php

namespace Tests\Stub;

use PHPUnit\Framework\TestCase;
use App\Stub\Stub;
use App\Stub\StubRepository;

class StubRepositoryTest extends TestCase {
  public function testAddStub() {
    $repo = new StubRepository();
    $repo -> addStub(new Stub());
    
    $expected = [new Stub()];
    $this -> assertEquals($expected, $repo -> listStub);
  } 
  
  public function testGetStub() {
    $repo = new StubRepository();
    $repo -> addStub(new Stub('/path/url'));
    $resp = $repo -> getByUrl('/path/url');
    $expected = new Stub('/path/url');
    
    $this -> assertEquals($expected, $resp);
  }
  
  public function testLoadFromDirectory() {
    $directory = 'resources/recursive';
    $repo = StubRepository::loadFromDirectory($directory);
    
    $expected = new StubRepository();
    $stub = new Stub('/stub/0', 'GET', ['name' => 'stub0']);
    $stub -> setFile('resources/recursive/stub0.json');
    $expected -> addStub($stub);
    $stub = new Stub('/stub/1', 'GET', ['name' => 'stub1']);
    $stub -> setFile('resources/recursive/stub1.json');
    $expected -> addStub($stub);
    $stub = new Stub('/stub/2', 'GET', ['name' => 'stub2']);
    $stub -> setFile('resources/recursive/sub/stub2.json');
    $expected -> addStub($stub);
    
    $this -> assertEquals($expected, $repo);
  }
}