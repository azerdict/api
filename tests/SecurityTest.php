<?php

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace App\Tests;

use App\Tests\Controller\ApiTestCase;

class SecurityTest extends ApiTestCase
{
    public function testRequestWithoutKey()
    {
        $client = parent::createClient();
        $client->request('GET', '/dictionary/english', [
            'term' => 'lorem ipsum',
        ]);

        $response = $client->getResponse();
        $this->assertSame(401, $response->getStatusCode());
        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);
        $this->assertSame('Authentication Required', $content['message']);
    }

    public function testInvalidKey()
    {
        $client = parent::createClient([], [
            'HTTP_X_AUTH_TOKEN' => 'key_does_not_exist',
        ]);
        $client->request('GET', '/dictionary/english', [
            'term' => 'lorem ipsum',
        ]);

        $response = $client->getResponse();
        $this->assertSame(403, $response->getStatusCode());
        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);
        $this->assertSame('API Key doesn\'t exist!', $content['message']);
    }
}
