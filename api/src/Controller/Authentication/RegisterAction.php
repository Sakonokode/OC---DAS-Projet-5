<?php

declare(strict_types=1);

namespace App\Controller\Authentication;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterAction extends AbstractController
{
    public function __invoke(
        Request $request,
        UserPasswordEncoderInterface $encoder
    ): Response {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(RegisterType::class);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted()) {
            $username = (string) $form->get('username')->getData();
            $user = $em->getRepository(User::class)->findOneBy(['email' => $username]);

            if ($user !== null) {
                $form->get('username')->addError(new FormError(sprintf('app.errors.email_already_taken')));
            } else if ($form->isValid()) {
                $password = (string) $form->get('password')->getData();
                $user = new User($username);
                $user->setPassword($encoder->encodePassword($user, $password));
                $em->persist($user);
                $em->flush();

                return new JsonResponse([
                    'success' => sprintf('User %s successfully created', $user->getUsername()),
                ], Response::HTTP_CREATED);
            }

            return new JsonResponse([
                'error' => sprintf('Registration failed with error : %s', (string) $form->getErrors(true)),
            ], Response::HTTP_BAD_REQUEST);
        }

        return new Response($this->renderView('auth/register.html.twig', ['form' => $form->createView()]), Response::HTTP_OK);
    }
}