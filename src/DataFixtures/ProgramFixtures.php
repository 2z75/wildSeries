<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    const PROGRAMS = [
        'The Wire' => [
            'synopsis' => "La meilleure série de l'histoire",
            'category' => "action"],
        'Oz' => [ 
            'synopsis' => "Un reportage sur les prisons", 
            'category' => "action"],
        'Vikings' => [
            'synopsis' => "Yvaaaaaaar", 
            'category' => "fantastique"],
        'The Shield' => [
            'synopsis' => "Enfin un bon policier", 
            'category' => "horreur"],
        'GOT' => [
            'synopsis' => "Mouais", 
            'category' => "action"],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programData => $programDetails) {
            $program = new Program();
            $program->setTitle($programData)
                    ->setSynopsis($programDetails['synopsis'])
                    ->setPoster('Bonjour')
                    ->setCategory($this->getReference('category_' . $programDetails['category']));
                    $this->setReference('program_' . $programData, $program);
            $manager->persist($program);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
        CategoryFixtures::class,
        ];
    }

}

