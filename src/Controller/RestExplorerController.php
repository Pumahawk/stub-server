<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;


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
  
  public function getByUrl(RequestStack $requestStack, StubRepoManager $stubManager) {
    $stub = $stubManager -> getStubRepo() -> getByUrl($requestStack -> getCurrentRequest() -> query -> get('url'));
    
    if($stub) {
      $ret = [
        'file' => $stub -> getFile(),
        'url' => $stub -> getUrl(),
        'response' => $stub -> getResponse()
      ];
    } else {
      $ret = [
        'error' => 'Stub not found'
      ];
    }
    return new JsonResponse($ret);
  }
}