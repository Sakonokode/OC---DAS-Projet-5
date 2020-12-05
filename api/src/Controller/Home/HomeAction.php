<?php

declare(strict_types=1);

namespace App\Controller\Home;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeAction extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('base.html.twig', []);
    }
}