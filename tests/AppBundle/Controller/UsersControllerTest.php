<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        $client->request('POST', '/users/', array('name' => 'Mateo'));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('correctamente', $client->getResponse()->getContent());
        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
    }

    public function testUpdateUser()
    {
        $client = static::createClient();
        $client->request('PUT', '/users/1', array('name' => 'Juan'));

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

    public function testUploadImage()
    {
        $photo = new UploadedFile(
            'sw.jpg', 'sw.jpg', 'image/jpeg', 123
        );
        $client = static::createClient();
        $client->request(
            'POST', '/users/upload/1', array('file' => $photo), array('file' => $photo)
        );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('correctamente', $client->getResponse()->getContent());
        $this->assertTrue(
            $client->getResponse()->headers->contains('Content-Type', 'application/json')
        );
    }
}
