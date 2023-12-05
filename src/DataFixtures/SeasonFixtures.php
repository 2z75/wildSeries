<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Season;
use Faker\Factory;
class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();


        // Assume that 'program_existing' is the reference for your existing program
        foreach (ProgramFixtures::PROGRAMS as $key => $programData) {
            for ($i= 1; $i <= 5; $i++) {
        $season = new Season();
        $season ->setNumber($faker->numberBetween(1, 5))
                ->setYear($faker->year())
                ->setDescription($faker->paragraphs(3, true))
                ->setProgram($this->getReference('program_' . $key));
        $this->addReference('season_' . $i . '_' . $key, $season);
        $manager->persist($season);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
        ProgramFixtures::class,
        ];
    }
}