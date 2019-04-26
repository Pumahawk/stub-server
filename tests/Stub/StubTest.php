<?php

namespace Tests\Stub;

use PHPUnit\Framework\TestCase;
use App\Stub\Stub;
use App\Exceptions\StubHttpUrlException;
use App\Exceptions\StubHttpMethodException;
use App\Exceptions\StubHttpResponseException;

class StubTest extends TestCase {
  public function testIstance() {
    $stub = new Stub();
    $this -> assertEquals(null, $stub -> getUrl());
    $this -> assertEquals(null, $stub -> getResponse());
  }
  
  public function testSetUrl() {
    $stub = new Stub();
    $stub -> setUrl('/request/stub.json');
    $this -> assertEquals('/request/stub.json', $stub -> getUrl());
    try {
      $stub -> setUrl(null);
      $this -> assertTrue(false);
    } catch(StubHttpUrlException $exception) {
      $this -> assertTrue(true);
    }
    try {
      $stub -> setUrl(new Stub());
      $this -> assertTrue(false);
    } catch (StubHttpUrlException $exception) {
      $this -> assertTrue(true);
    }
  }
  
  public function testSetResponse() {
    $stub = new Stub();
    $stub -> setResponse(['test']);
    $this -> assertEquals(['test'], $stub -> getResponse());
    try {
      $stub -> setResponse(null);
      $this -> assertTrue(false);
    } catch(StubHttpResponseException $exception) {
      $this -> assertTrue(true);
    }
    try {
      $stub -> setResponse('string');
      $this -> assertTrue(false);
    } catch (StubHttpResponseException $exception) {
      $this -> assertTrue(true);
    }
  }
  
}