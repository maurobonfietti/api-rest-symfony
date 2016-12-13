<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Users;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; ++$i) {
            $data = new Users();
            $data->setName($this->getRandomName());
            $manager->persist($data);
            $manager->flush();
        }
    }

    private function getRandomName()
    {
        $names = array(
            'Luis', 'Silvia', 'Mauro', 'Mateo', 'Gisela', 'Cesar', 
            'Laura', 'Ignacio', 'Ángel', 'Mirta', 'Antonio', 
            'Yolanda', 'Ana', 'Elso', 'Erondina'
        );
        return $names[array_rand($names)];
    }
}