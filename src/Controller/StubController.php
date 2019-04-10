<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

use App\Service\StubRepoManager;

class StubController {
  public function stubRequest(StubRepoManager $stubManager) {
    return new Response("Prima funzione stub!");
  }
}