<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/city", name="city_")
 */
class CityController extends AbstractController
{
	/**
	 * @Route("/info", name="info", methods={"GET"})
	 */
	public function info(): Response
	{
		return new Response('Hello World : CityController/info');
	}
}
