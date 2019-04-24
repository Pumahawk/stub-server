<?php

namespace App\Service;
use App\Stub\StubRepository;

class StubRepoManager {
  protected $stubRepo;
  public function __construct() {
    $this -> stubRepo = StubRepository::loadFromDirectory($_ENV['STUB_FOLDER']);
  }
  public function getStubRepo() {
    return $this -> stubRepo;
  }
}