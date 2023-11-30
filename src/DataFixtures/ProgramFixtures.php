<?php
namespace App\DataFixtures;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        ['title' => 'Program 1', 'synopsis' => 'Synopsis 1'],
        ['title' => 'Program 2', 'synopsis' => 'Synopsis 2'],
        ['title' => 'Program 3', 'synopsis' => 'Synopsis 3'],
        ['title' => 'Program 4', 'synopsis' => 'Synopsis 4'],
        ['title' => 'Program 5', 'synopsis' => 'Synopsis 5'],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programData) {
            $program = new Program();
            $program->setTitle($programData['title']);
            $program->setSynopsis($programData['synopsis']);
            $program->setCategory($this->getReference('category_Action'));
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

