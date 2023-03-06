<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/session", name="session_")
 */
class SessionController extends AbstractController
{

	function __construct(EntityManagerInterface $mysql)
	{
		$this->mysql = $mysql;
	}

	/**
	 * @Route("/login", name="login", methods={"POST"})
	 */
	function login(Request $request): Response
	{
		$data = json_decode($request->getContent(), true);

		// Check if username or password is empty
		if (empty($data['username']) || empty($data['password'])) {
			return new Response(Response::HTTP_BAD_REQUEST);
		}

		// Check if username exists
		$user = $this->mysql->getRepository(User::class)->findOneBy(['username' => $data['username']]);
		if (!$user) {
			return new Response(Response::HTTP_NOT_FOUND);
		}

		// Check if password is correct
		if ($user->getPassword() !== hash('sha256', $data['password'])) {
			return new Response(Response::HTTP_UNAUTHORIZED);
		} else {
			return new Response(Response::HTTP_OK);
		}
	}
}
