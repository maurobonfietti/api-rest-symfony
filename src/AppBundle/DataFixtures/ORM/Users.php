<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Users implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 25; ++$i) {
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
        $names = array(
            'Luis', 'Silvia', 'Mauro', 'Mateo', 'Gisela', 'Cesar',
            'Laura', 'Ignacio', 'Angel', 'Mirta', 'Antonio',
            'Yolanda', 'Ana', 'Elso', 'Erondina',
        );

        $names2 = array(
            'Garcia', 'Gonzalez', 'Rodriguez', 'Fernandez', 'Lopez', 'Martinez',
            'Sanchez', 'Perez', 'Gomez', 'Diaz', 'Dominguez',
        );

        return $names[array_rand($names)].' '.$names2[array_rand($names2)];
    }

    private function getRandomEmail($name)
    {
        $emails = array(
            'hotmail.com', 'gmail.com', 'example.com',
        );

        switch (mt_rand(1, 7)) {
            case 1:
                return sprintf('%s@%s', str_replace(' ', '', $name), $emails[array_rand($emails)]);
            case 2:
                return sprintf('%s@%s', str_replace(' ', '_', $name), $emails[array_rand($emails)]);
            case 3:
                return sprintf('%s@%s', str_replace(' ', '.', $name), $emails[array_rand($emails)]);
            case 4:
                return sprintf('%s%02s@%s', str_replace(' ', '', $name), mt_rand(0, 99), $emails[array_rand($emails)]);
            case 5:
                $names = explode(" ", $name);
                return sprintf('%s.%s@%s', $names[1], $names[0], $emails[array_rand($emails)]);
            case 6:
                $names = explode(" ", $name);
                return sprintf('%s%s@%s', $names[0][0], $names[1], $emails[array_rand($emails)]);
            default :
                return null;
        }
    }
}
