<?php

namespace App\DataFixtures;

use App\Entity\Desenvolvedor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $desenvolvedor = new Desenvolvedor();
            $desenvolvedor->setNome($faker->name);
            $desenvolvedor->setSexo($faker->randomElement($array = array ('M', 'F')));
            $desenvolvedor->setIdade($faker->numberBetween(0,100));
            $desenvolvedor->setHobby($faker->realText);
            $date = new \DateTime($faker->date);
            $desenvolvedor->setDatanascimento($date);
            $manager->persist($desenvolvedor);
        }

        $manager->flush();
    }
}
