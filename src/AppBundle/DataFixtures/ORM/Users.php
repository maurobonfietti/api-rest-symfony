<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Users implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 30; ++$i) {
            $data = new \AppBundle\Entity\Users();
            $name = $this->getRandomName();
            $data->setName($name);
            $data->setEmail($this->getRandomEmail(strtolower($name)));
            $manager->persist($data);
            $manager->flush();
        }
    }

    private function getRandomName()
    {
        $firstName = array(
            'Luis', 'Silvia', 'Mauro', 'Mateo', 'Gisela', 'Cesar', 'Laura',
            'Ignacio', 'Angel', 'Mirta', 'Antonio', 'Yolanda', 'Ana', 'Elso',
            'Erondina', 'Jorge', 'Jose Manuel', 'Francisco', 'Juan', 'David',
            'Alejandra', 'Luciana', 'Maria', 'Fernanda', 'Pablo', 'Nicolas',
        );

        $lastName = array(
            'Garcia', 'Gonzalez', 'Rodriguez', 'Fernandez', 'Lopez', 'Sanchez',
            'Martinez', 'Perez', 'Gomez', 'Diaz', 'Dominguez', 'Ortiz',
        );

        return $firstName[array_rand($firstName)].' '.$lastName[array_rand($lastName)];
    }

    private function getRandomEmail($name)
    {
        $names = explode(' ', $name);

        $emails = array(
            'gmail.com', 'hotmail.com', 'arnet.com.ar', $names[1].'.com', $names[1].'.com.ar',
        );

        switch (mt_rand(1, 10)) {
            case 1:
                return sprintf('%s@%s', str_replace(' ', '', $name), $emails[array_rand($emails)]);
            case 2:
                return sprintf('%s@%s', str_replace(' ', '_', $name), $emails[array_rand($emails)]);
            case 3:
                return sprintf('%s@%s', str_replace(' ', '.', $name), $emails[array_rand($emails)]);
            case 4:
                return sprintf('%s%02s@%s', str_replace(' ', '', $name), mt_rand(0, 99), $emails[array_rand($emails)]);
            case 5:
                return sprintf('%s.%s@%s', $names[1], $names[0], $emails[array_rand($emails)]);
            case 6:
                return sprintf('%s%s@%s', $names[0][0], $names[1], $emails[array_rand($emails)]);
            default:
                return null;
        }
    }
}
