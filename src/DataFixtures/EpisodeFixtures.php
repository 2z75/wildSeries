<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Episode;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach (ProgramFixtures::PROGRAMS as $key => $programData) {
            for ($i= 1; $i <= 5; $i++) {
                for($e = 1; $e <= 5; $e++) {
        $episode = new Episode();
        $episode->setTitle("Titre test")
                ->setNumber($e)
                ->setSynopsis("Résumé de l'episode" . $e )
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