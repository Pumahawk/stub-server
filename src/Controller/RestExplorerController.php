<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

use App\Service\StubRepoManager;

class RestExplorerController {
  public function getAllStub(StubRepoManager $stubManager) {
    foreach($stubManager -> getStubRepo() -> listStub as $stub){
      $stubList[] = [
        'file' => $stub -> getFile(),
        'url' => $stub -> getUrl(),
        'response' => $stub -> getResponse()
      ];
    }
    return new JsonResponse($stubList);
  }
}