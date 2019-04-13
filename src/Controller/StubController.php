<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Service\StubRepoManager;

class StubController {
  public function stubRequest(StubRepoManager $stubManager) {
    
    $stubManager -> getStubRepo() -> getStub();
    
    return new JsonResponse([
      'title' => 'rispsota in json'
    ]);
  }
}