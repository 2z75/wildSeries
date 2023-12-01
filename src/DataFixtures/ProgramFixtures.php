<?php
namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        ['title' => 'The Wire', 'synopsis' => "La meilleure série de l'histoire"],
        ['title' => 'Oz', 'synopsis' => "Un reportage sur les prisons"],
        ['title' => 'Vikings', 'synopsis' => "Yvaaaaaaar"],
        ['title' => 'The Shield', 'synopsis' => "Enfin un bon policier"],
        ['title' => 'GOT', 'synopsis' => "Mouais"],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programData) {
            $program = new Program();
            $program->setTitle($programData['title']);
            $program->setSynopsis($programData['synopsis']);
            $program->setPoster('Bonjour');
            $program->setCategory($this->getReference('category_action'));
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

