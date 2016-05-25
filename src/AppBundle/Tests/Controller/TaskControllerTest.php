<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tasks');
    }

    public function testStore()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tasks/store');
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tasks/update');
    }

    public function testComplete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tasks/complete');
    }

    public function testIncomplete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tasks/incomplete');
    }

}
