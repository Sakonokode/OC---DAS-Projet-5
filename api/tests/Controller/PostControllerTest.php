<?php

declare(strict_types=1);

namespace App\Tests\Controller;

final class PostControllerTest extends AbstractControllerWebTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testGetIndex(): void
    {
        $token = $this->getToken();
        $url = $this->urlGenerator->generate('index');

        $headers = [
            'Authorization' => sprintf('Bearer %s', $token),
        ];

        $response = $this->request('GET', $url, null, $headers);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetDocumentation(): void
    {
        $token = $this->getToken();
        $url = $this->urlGenerator->generate('swagger_ui');

        $headers = [
            'Authorization' => sprintf('Bearer %s', $token),
        ];

        $response = $this->request('GET', $url, null, $headers);

        $this->assertEquals(200, $response->getStatusCode());
    }
}