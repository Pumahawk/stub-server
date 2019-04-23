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
}