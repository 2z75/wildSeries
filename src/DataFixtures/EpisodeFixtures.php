<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Episode;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();


        foreach (ProgramFixtures::PROGRAMS as $key => $programData) {
            for ($i= 1; $i <= 5; $i++) {
                for($e = 1; $e <= 10; $e++) {
        $episode = new Episode();
        $episode->setTitle($faker->word())
                ->setNumber($faker->numberBetween(1, 10))
                ->setSynopsis($faker->paragraphs(3, true) . $e )
                ->setSeason($this->getReference('season_' .$i . '_' . $key));

        $manager->persist($episode);
                }
            }
        }
        $manager->flush();
    }
    

    public function getDependencies()
    {
        return [
        SeasonFixtures::class,
        ];
    }
}