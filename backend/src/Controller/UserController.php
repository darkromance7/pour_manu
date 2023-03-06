<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\Constructeur;
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

	function __construct(EntityManagerInterface $mysql, Constructeur $construct)
	{
		$this->mysql = $mysql;
		$this->construct = $construct;
	}

	/**
	 * @Route("/create", name="create", methods={"POST"})
	 */
	public function create(Request $request): Response
	{
		$data = json_decode($request->getContent(), true);
		$user = new User();

		// Check if username or password is empty
		if (empty($data['username']) || empty($data['password'])) {
			return $this->construct->erreur(Response::HTTP_BAD_REQUEST, 'Merci de remplir tous les champs !');
		}

		// Check if password and passwordConfirm are the same
		if ($data['password'] !== $data['passwordConfirm']) {
			return $this->construct->erreur(Response::HTTP_BAD_REQUEST, 'Les mots de passe ne correspondent pas !');
		}

		// Check if username already exists
		$existingUser = $this->mysql->getRepository(User::class)->findOneBy(['username' => $data['username']]);
		if ($existingUser) {
			return $this->construct->erreur(Response::HTTP_CONFLICT, 'Ce nom d\'utilisateur est déjà utilisé !');
		}

		$user->setPassword(hash('sha256', $data['password']));
		$user->setUsername($data['username']);

		$this->mysql->persist($user);
		$this->mysql->flush();

		return new Response(Response::HTTP_OK);
	}

}
