<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersControllerTest extends WebTestCase
{
    public function testGetUsers()
    {
        $client = static::createClient();
        $client->request('GET', '/users');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
    }

    public function testGetUser()
    {
        $client = static::createClient();
        $client->request('GET', '/users/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
    }

    public function testNewUser()
    {
        $client = static::createClient();
        $client->request('POST', '/users/', array('name' => 'Mateo', 'email' => 'mateo@hotmail.com'));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('correctamente', $client->getResponse()->getContent());
        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
    }

    public function testUpdateUser()
    {
        $client = static::createClient();
        $client->request('PUT', '/users/1', array('name' => 'Marcos', 'email' => 'marquitos@gmail.com'));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('correctamente', $client->getResponse()->getContent());
        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
    }

    public function testDeleteUser()
    {
        $client = static::createClient();
        $client->request('DELETE', '/users/2');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('correctamente', $client->getResponse()->getContent());
        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
    }
}
