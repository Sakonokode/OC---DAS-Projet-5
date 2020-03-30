<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class HomeController extends AbstractController
{
    /** @var SerializerInterface */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function index(): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();
        $data = null;
        if ($user !== null) {
            $userClone = clone $user;
            $data = $this->serializer->serialize($userClone, JsonEncoder::FORMAT);
        }

        return $this->render('base.html.twig', [
            'isAuthenticated' => json_encode($user !== null),
            'user' => $data ?? json_encode($data),
        ]);
    }
}