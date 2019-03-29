<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $g1 = new Genre();
        $g1->setType('Biography');
        $g1->setImage('genre_biography.png');

        $g2 = new Genre();
        $g2->setType('Classic');
        $g2->setImage('genre_classic.png');

        $g3 = new Genre();
        $g3->setType('Crime');
        $g3->setImage('genre_crime.png');

        $g4 = new Genre();
        $g4->setType('History');
        $g4->setImage('genre_history.png');

        $g5 = new Genre();
        $g5->setType('Novel');
        $g5->setImage('genre_novel.png');

        $g6 = new Genre();
        $g6->setType('Romance');
        $g6->setImage('genre_romance.png');

        $g7 = new Genre();
        $g7->setType('Thriller');
        $g7->setImage('genre_thriller.png');

        $g8 = new Genre();
        $g8->setType('Young Adult Fiction');
        $g8->setImage('genre_yaf.png');

        $manager->persist($g1);
        $manager->persist($g2);
        $manager->persist($g3);
        $manager->persist($g4);
        $manager->persist($g5);
        $manager->persist($g6);
        $manager->persist($g7);
        $manager->persist($g8);

        $manager->flush();
    }
}
