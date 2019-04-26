<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Service\StubRepoManager;

class StubController {
  public function stubRequest($path, StubRepoManager $stubManager) {
    
    $stub = $stubManager -> getStubRepo() -> getByUrl($path);
    
    return $stub ? new JsonResponse($stub -> getResponse()) : new Response(null, Response::HTTP_NOT_FOUND);
  }
}