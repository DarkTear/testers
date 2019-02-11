<?php

namespace App\Controller;

use App\Repository\UserRepository;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class UsersController extends FOSRestController
{
    const DEFAULT_LIMIT  = 10;

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Rest\Get("/users")
     *
     * @param Request $request
     * @return View
     */
    public function getUsers(Request $request): View
    {
        $offset = (int)$request->get('offset');
        $limit  = (int)$request->get('limit');
        $filter = $request->get('filter');

        if (!$limit) {
            $limit = self::DEFAULT_LIMIT;
        }

        $users = $this->userRepository->get($offset, $limit, $filter);

        return View::create($users, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Get("/user/{id}", requirements={"id": "\d+"})
     *
     * @param int $id
     * @return View
     */
    public function getRestUser(int $id): View
    {
        $user = $this->userRepository->getByID($id);

        return View::create($user, Response::HTTP_CREATED);
    }
}