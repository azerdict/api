<?php

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class ApiTestCase extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        parent::setUp();
        parent::bootKernel();

        $this->client = parent::createClient([], [
            'HTTP_X_AUTH_TOKEN' => parent::$container->getParameter('api_key'),
        ]);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->client);
    }

    /**
     * @param int $statusCode
     */
    protected function assertStatusCode(int $statusCode)
    {
        $this->assertEquals($statusCode, $this->client->getResponse()->getStatusCode());
    }

    /**
     * @return array
     */
    protected function getContentAsArray()
    {
        return json_decode($this->client->getResponse()->getContent(), true);
    }
}
