<?php

namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class UsersController extends FOSRestController
{
    /**
     * Creates an Article resource
     * @Rest\Get("/users")
     * @param Request $request
     * @return View
     */
    public function getUsers(Request $request): View
    {
        //TODO
        return View::create([], Response::HTTP_CREATED);
    }
}