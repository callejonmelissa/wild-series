<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        ['title' => 'Les 7 vies de Léa', 'category' => 'Aventure'], 
        ['title' => 'Le reste de ta vie', 'category' => 'Fantastique'],
        ['title' => 'Clark', 'category' => 'Action'],
        ['title' => 'Inventing Anna', 'category' => 'Animation'],
        ['title' => 'Dark', 'category' => 'Horreur'],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (SELF::PROGRAMS as $key => $programName) {
        $program = new Program();
        $program->setTitle($programName['title']);
        $program->setSynopsis('Des zombies envahissent la terre'); 
        $program->setCategory($this->getReference('category_' . $programName['category']));
        $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
