<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Safe\Exceptions\JsonException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Client;
use function \json_decode;
use function \json_encode;

abstract class AbstractControllerWebTestCase extends WebTestCase
{
    protected const URL = 'https://projet5.sakonokode.dev/api/login_check';

    protected function createAuthenticatedClient(string $username = 'admin', string $password = 'm3p'): Client
    {
        $client = static::createClient();
        $client->request(
        'POST',
        self::URL,
        [
            '_username' => $username,
            '_password' => $password,
        ]
        );

        $data = json_decode($client->getResponse()->getContent(), true);
dd($client->getRequest(), $client->getResponse()->getStatusCode(), $data);

        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));
        $client->setServerParameter('CONTENT_TYPE', 'application/json');

        return $client;
    }
}