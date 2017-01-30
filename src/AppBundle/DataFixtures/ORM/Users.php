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
            'Luis', 'Silvia', 'Mauro', 'Mateo', 'Gisela', 'César', 'Laura',
            'Ignacio', 'Ángel', 'Mirta', 'Antonio', 'Yolanda', 'Ana', 'Elso',
            'Erondina', 'Javier', 'José Manuel', 'Francisco', 'Juan', 'David',
            'Alejandra', 'Luciana', 'María', 'Fernanda', 'Pablo', 'Nicolás',
        );

        $lastName = array(
            'García', 'González', 'Rodríguez', 'Fernández', 'López', 'Sánchez',
            'Martínez', 'Pérez', 'Gómez', 'Díaz', 'Domínguez', 'Ortiz',
        );

        return $firstName[array_rand($firstName)].' '.$lastName[array_rand($lastName)];
    }

    private function getRandomEmail($name)
    {
        $regName = $this->convertAccents($name);
        $names = explode(' ', $regName);

        $emails = array(
            'gmail.com', 'hotmail.com', 'arnet.com.ar', $names[1].'.com', $names[1].'.com.ar',
        );

        switch (mt_rand(1, 10)) {
            case 1:
                return sprintf('%s@%s', str_replace(' ', '', $regName), $emails[array_rand($emails)]);
            case 2:
                return sprintf('%s@%s', str_replace(' ', '_', $regName), $emails[array_rand($emails)]);
            case 3:
                return sprintf('%s@%s', str_replace(' ', '.', $regName), $emails[array_rand($emails)]);
            case 4:
                return sprintf('%s%02s@%s', str_replace(' ', '', $regName), mt_rand(0, 99), $emails[array_rand($emails)]);
            case 5:
                return sprintf('%s.%s@%s', $names[1], $names[0], $emails[array_rand($emails)]);
            case 6:
                return sprintf('%s%s@%s', $names[0][0], $names[1], $emails[array_rand($emails)]);
            default:
                return null;
        }
    }

    private function convertAccents($str)
    {
        $preStr = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $postStr = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $str = utf8_decode($str);
        $str = strtr($str, utf8_decode($preStr), $postStr);
        $str = strtolower($str);

        return utf8_encode($str);
    }
}
