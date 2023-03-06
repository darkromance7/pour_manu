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
 * @Route("/api/user", name="user_")
 */
class UserController extends AbstractController
{

	function __construct(EntityManagerInterface $mysql)
	{
		$this->mysql = $mysql;
	}

	/**
	 * @Route("/create", name="create")
	 */
	public function create(Request $request): Response
	{
		$data = json_decode($request->getContent(), true);
		$user = new User();

		// Check if username or password is empty
		if (empty($data['username']) || empty($data['password'])) {
			return new Response(Response::HTTP_BAD_REQUEST);
		}

		// Check if username already exists
		$existingUser = $this->mysql->getRepository(User::class)->findOneBy(['username' => $data['username']]);
		if ($existingUser) {
			return new Response(Response::HTTP_CONFLICT);
		}

		$user->setPassword(hash('sha256', $data['password']));
		$user->setUsername($data['username']);

		$this->mysql->persist($user);
		$this->mysql->flush();

		return new Response(Response::HTTP_OK);
	}

}
