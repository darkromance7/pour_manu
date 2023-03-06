<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Service\Outils;

class Constructeur
{
  // Construit une réponse avec une erreur
  public function erreur($code, $message) {
    $response = new JsonResponse();
    $response->setStatusCode($code);
    $response->setContent($message);
    return $response;
  }
}