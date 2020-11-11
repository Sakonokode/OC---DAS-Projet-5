<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use function \json_decode;
use function \json_encode;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

abstract class AbstractControllerWebTestCase extends WebTestCase
{
    protected const BASE_URI = 'https://projet5.sakonokode.dev';
    protected const BASE_LOCALHOST_URI = 'https://localhost';

    protected UrlGeneratorInterface $urlGenerator;
    protected HttpClientInterface $client;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->client = self::$container->get(HttpClientInterface::class);
        $this->urlGenerator = self::$container->get(UrlGeneratorInterface::class);
    }

    protected function getToken(string $username = 'admin', string $password = 'm3p'): ?string
    {
        $url = $this->urlGenerator->generate('api_login_check');
        
        $response = $this->request('POST', $url, [
            'username' => $username,
            'password' => $password,
        ]);

        $token = json_decode($response->getContent(), true)['token'] ?? null;

        if ($token === null) {
            return null;
        }

        return $token;
    }

    protected function request(string $method, string $url, ?array $data = [], array $headers = []): ResponseInterface
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
            ] + $headers,
            'base_uri' => self::BASE_URI,
            'body' => json_encode($data),
        ];

        return $this->client->request($method, $url, $options);
    }
}