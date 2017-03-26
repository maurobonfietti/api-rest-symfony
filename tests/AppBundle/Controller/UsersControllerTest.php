<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersControllerTest extends WebTestCase
{
    public function testGetVersion()
    {
        $client = static::createClient();
        $client->request('GET', '/version');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Version', $client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type', 'application/json'
        ));
    }

    public function testGetCountUsers()
    {
        $client = static::createClient();
        $client->request('GET', '/users/count');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Cantidad', $client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type', 'application/json'
        ));
    }

    public function testGetUsers()
    {
        $client = static::createClient();
        $client->request('GET', '/users');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('id', $client->getResponse()->getContent());
        $this->assertContains('name', $client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type', 'application/json'
        ));
    }

    public function testGetUser()
    {
        $client = static::createClient();
        $client->request('GET', '/users/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('id', $client->getResponse()->getContent());
        $this->assertContains('name', $client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type', 'application/json'
        ));
    }

    public function testGetUserNotFound()
    {
        $client = static::createClient();
        $client->request('GET', '/users/123');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
        $this->assertNotContains('id', $client->getResponse()->getContent());
        $this->assertNotContains('name', $client->getResponse()->getContent());
        $this->assertContains('no existe', $client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type', 'application/json'
        ));
    }

    public function testCreateUser()
    {
        $client = static::createClient();
        $client->request('POST', '/users/', array('name' => 'Matías'));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('correctamente', $client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type', 'application/json'
        ));
    }

    public function testCreateUserWithoutName()
    {
        $client = static::createClient();
        $client->request('POST', '/users/', array());

        $this->assertEquals(406, $client->getResponse()->getStatusCode());
        $this->assertNotContains('correctamente', $client->getResponse()->getContent());
        $this->assertContains('Ingrese', $client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type', 'application/json'
        ));
    }

    public function testUpdateUser()
    {
        $client = static::createClient();
        $client->request(
            'PUT', '/users/1', array('name' => 'Mago', 'email' => 'mago@hotmail.com')
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('correctamente', $client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type', 'application/json'
        ));
    }

    public function testUpdateUserWithoutName()
    {
        $client = static::createClient();
        $client->request('PUT', '/users/1', array());

        $this->assertEquals(406, $client->getResponse()->getStatusCode());
        $this->assertNotContains('correctamente', $client->getResponse()->getContent());
        $this->assertContains('Ingrese', $client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type', 'application/json'
        ));
    }

    public function testUpdateUserNotFound()
    {
        $client = static::createClient();
        $client->request('PUT', '/users/123456789', array());

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
        $this->assertNotContains('correctamente', $client->getResponse()->getContent());
        $this->assertContains('no existe', $client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type', 'application/json'
        ));
    }

    public function testDeleteUser()
    {
        $client = static::createClient();
        $client->request('DELETE', '/users/2');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('correctamente', $client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type', 'application/json'
        ));
    }

    public function testDeleteUserNotFound()
    {
        $client = static::createClient();
        $client->request('DELETE', '/users/123456789');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
        $this->assertNotContains('correctamente', $client->getResponse()->getContent());
        $this->assertContains('no existe', $client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type', 'application/json'
        ));
    }
}
