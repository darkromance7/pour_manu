<?php

namespace App\Controller;

use App\Service\Constructeur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/eat", name="eat_")
 */
class EatController extends AbstractController
{

	function __construct(EntityManagerInterface $mysql, Constructeur $construct)
	{
		$this->mysql = $mysql;
		$this->construct = $construct;
	}

	/**
	 * @Route("/{location}", name="get", methods={"GET"})
	 */
	public function Eat(): Response
	{
		return new JsonResponse('ok', 200);
	}


}
