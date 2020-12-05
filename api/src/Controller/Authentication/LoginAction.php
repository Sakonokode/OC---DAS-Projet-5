<?php

declare(strict_types=1);

namespace App\Controller\Authentication;

use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LoginAction extends AbstractController
{
    public function __invoke(): Response
    {
        $form = $this->createForm(LoginType::class);

        return new Response($this->renderView('auth/login.html.twig', ['form' => $form->createView()]), Response::HTTP_OK);
    }
}