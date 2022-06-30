<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ApplicationTest extends WebTestCase
{
    private KernelBrowser $client;

    const GET_URL = '/api/long_job/';
    const POST_URL = '/api/long_job/add';

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testSearchingAJobWithNonUuidGivesBadRequest(): void
    {
        $notAnUuid = 'bla-bla';

        $crawler = $this->client->request('GET',  self::GET_URL . $notAnUuid);

        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }

    public function testSearchingAJobWithNonExistentUuidGivesNotFound(): void
    {
        $nonExistentUuid = '9b240acb-f92e-4810-ad96-7be4807178ca';

        $crawler = $this->client->request('GET', self::GET_URL . $nonExistentUuid);

        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }

    public function testInsertingANewJobGivesAcceptedAndReturnsTheJobId(): void
    {
        $nonExistentUuid = '9b240acb-f92e-4810-ad96-7be4807178ca';

        $crawler = $this->client->request('POST', self::POST_URL, [], [], [], json_encode(['data' => 'some random data']));

        $this->assertResponseStatusCodeSame(Response::HTTP_ACCEPTED);
    }
}
