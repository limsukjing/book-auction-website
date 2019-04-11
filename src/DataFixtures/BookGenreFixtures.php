<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BookGenreFixtures extends Fixture implements DependentFixtureInterface
{
    // user (seller) object reference
    public const BOOK1_REFERENCE = 'b1';
    public const BOOK2_REFERENCE = 'b2';
    public const BOOK3_REFERENCE = 'b3';

    public function load(ObjectManager $manager)
    {
        /* Genre Fixtures */
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

        /* Book Fixtures */
        $b1 = new Book();
        $b1->setTitle('Becoming');
        $b1->setAuthor('Michelle Obama');
        $b1->setImage('book_becoming.png');
        $b1->setISBN(9783442314874);
        $b1->setSummary('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc libero, porttitor eget accumsan at, convallis id orci. Maecenas tristique nisi in rhoncus gravida. Aliquam erat volutpat. Integer rhoncus massa quis aliquam tristique. Nunc eget orci consequat, gravida orci malesuada, consectetur dui. Donec metus nisi, euismod non arcu at, molestie pretium metus. Nam mattis sed nunc id ornare. Pellentesque pharetra ac massa in bibendum. Duis in erat cursus, vehicula orci ac, ullamcorper lacus. Donec pharetra mauris et nisl cursus mattis. Nam vulputate ultricies elit vel condimentum. Vestibulum orci urna, pellentesque vitae mauris sed, sagittis tristique urna. Phasellus gravida vulputate diam nec aliquet. Nunc ac consectetur odio.');
        $b1->setStartingPrice('4.99');
        $b1->setReservePrice('29.99');
        $b1->setGenre($g1);
        $b1->setSeller($this->getReference(UserFixtures::SELLER1_REFERENCE));
        $b1->setStatus('active');

        $b2 = new Book();
        $b2->setTitle('To All the Boys I\'ve Loved Before');
        $b2->setAuthor('Jenny Han');
        $b2->setImage('book_boys.png');
        $b2->setISBN(9782809463675);
        $b2->setSummary('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc libero, porttitor eget accumsan at, convallis id orci. Maecenas tristique nisi in rhoncus gravida. Aliquam erat volutpat. Integer rhoncus massa quis aliquam tristique. Nunc eget orci consequat, gravida orci malesuada, consectetur dui. Donec metus nisi, euismod non arcu at, molestie pretium metus. Nam mattis sed nunc id ornare. Pellentesque pharetra ac massa in bibendum. Duis in erat cursus, vehicula orci ac, ullamcorper lacus. Donec pharetra mauris et nisl cursus mattis. Nam vulputate ultricies elit vel condimentum. Vestibulum orci urna, pellentesque vitae mauris sed, sagittis tristique urna. Phasellus gravida vulputate diam nec aliquet. Nunc ac consectetur odio.');
        $b2->setStartingPrice('0.50');
        $b2->setReservePrice('6.50');
        $b2->setGenre($g8);
        $b2->setSeller($this->getReference(UserFixtures::SELLER2_REFERENCE));
        $b2->setStatus('active');

        $b3 = new Book();
        $b3->setTitle('Gone Girl');
        $b3->setAuthor('Gillian Flynn');
        $b3->setImage('book_gone.png');
        $b3->setISBN(9782809463675);
        $b3->setSummary('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc libero, porttitor eget accumsan at, convallis id orci. Maecenas tristique nisi in rhoncus gravida. Aliquam erat volutpat. Integer rhoncus massa quis aliquam tristique. Nunc eget orci consequat, gravida orci malesuada, consectetur dui. Donec metus nisi, euismod non arcu at, molestie pretium metus. Nam mattis sed nunc id ornare. Pellentesque pharetra ac massa in bibendum. Duis in erat cursus, vehicula orci ac, ullamcorper lacus. Donec pharetra mauris et nisl cursus mattis. Nam vulputate ultricies elit vel condimentum. Vestibulum orci urna, pellentesque vitae mauris sed, sagittis tristique urna. Phasellus gravida vulputate diam nec aliquet. Nunc ac consectetur odio.');
        $b3->setStartingPrice('1.20');
        $b3->setReservePrice('10.20');
        $b3->setGenre($g7);
        $b3->setSeller($this->getReference(UserFixtures::SELLER3_REFERENCE));
        $b3->setStatus('active');

        $b4 = new Book();
        $b4->setTitle('Crazy Rich Asians');
        $b4->setAuthor('Kevin Kwan');
        $b4->setImage('book_asians.png');
        $b4->setISBN(	9780385536974);
        $b4->setSummary('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc libero, porttitor eget accumsan at, convallis id orci. Maecenas tristique nisi in rhoncus gravida. Aliquam erat volutpat. Integer rhoncus massa quis aliquam tristique. Nunc eget orci consequat, gravida orci malesuada, consectetur dui. Donec metus nisi, euismod non arcu at, molestie pretium metus. Nam mattis sed nunc id ornare. Pellentesque pharetra ac massa in bibendum. Duis in erat cursus, vehicula orci ac, ullamcorper lacus. Donec pharetra mauris et nisl cursus mattis. Nam vulputate ultricies elit vel condimentum. Vestibulum orci urna, pellentesque vitae mauris sed, sagittis tristique urna. Phasellus gravida vulputate diam nec aliquet. Nunc ac consectetur odio.');
        $b4->setStartingPrice('2.99');
        $b4->setReservePrice('18.99');
        $b4->setGenre($g5);
        $b4->setSeller($this->getReference(UserFixtures::SELLER1_REFERENCE));
        $b4->setStatus('active');

        $b5 = new Book();
        $b5->setTitle('To Kill a Mockingbird');
        $b5->setAuthor('Harper Lee');
        $b5->setImage('book_mockingbird.png');
        $b5->setISBN(	9780446310789);
        $b5->setSummary('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc libero, porttitor eget accumsan at, convallis id orci. Maecenas tristique nisi in rhoncus gravida. Aliquam erat volutpat. Integer rhoncus massa quis aliquam tristique. Nunc eget orci consequat, gravida orci malesuada, consectetur dui. Donec metus nisi, euismod non arcu at, molestie pretium metus. Nam mattis sed nunc id ornare. Pellentesque pharetra ac massa in bibendum. Duis in erat cursus, vehicula orci ac, ullamcorper lacus. Donec pharetra mauris et nisl cursus mattis. Nam vulputate ultricies elit vel condimentum. Vestibulum orci urna, pellentesque vitae mauris sed, sagittis tristique urna. Phasellus gravida vulputate diam nec aliquet. Nunc ac consectetur odio.');
        $b5->setStartingPrice('15.00');
        $b5->setReservePrice('39.99');
        $b5->setGenre($g2);
        $b5->setSeller($this->getReference(UserFixtures::SELLER1_REFERENCE));
        $b5->setStatus('active');

        $b6 = new Book();
        $b6->setTitle('Pride and Prejudice');
        $b6->setAuthor('Jane Austen');
        $b6->setImage('book_pride.png');
        $b6->setISBN(	9780446310789);
        $b6->setSummary('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc libero, porttitor eget accumsan at, convallis id orci. Maecenas tristique nisi in rhoncus gravida. Aliquam erat volutpat. Integer rhoncus massa quis aliquam tristique. Nunc eget orci consequat, gravida orci malesuada, consectetur dui. Donec metus nisi, euismod non arcu at, molestie pretium metus. Nam mattis sed nunc id ornare. Pellentesque pharetra ac massa in bibendum. Duis in erat cursus, vehicula orci ac, ullamcorper lacus. Donec pharetra mauris et nisl cursus mattis. Nam vulputate ultricies elit vel condimentum. Vestibulum orci urna, pellentesque vitae mauris sed, sagittis tristique urna. Phasellus gravida vulputate diam nec aliquet. Nunc ac consectetur odio.');
        $b6->setStartingPrice('10.50');
        $b6->setReservePrice('50.50');
        $b6->setGenre($g2);
        $b6->setSeller($this->getReference(UserFixtures::SELLER3_REFERENCE));
        $b6->setStatus('active');

        $b7 = new Book();
        $b7->setTitle('The Notebook');
        $b7->setAuthor('Nicholas Sparks');
        $b7->setImage('book_notebook.png');
        $b7->setISBN(	9785170797455);
        $b7->setSummary('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc libero, porttitor eget accumsan at, convallis id orci. Maecenas tristique nisi in rhoncus gravida. Aliquam erat volutpat. Integer rhoncus massa quis aliquam tristique. Nunc eget orci consequat, gravida orci malesuada, consectetur dui. Donec metus nisi, euismod non arcu at, molestie pretium metus. Nam mattis sed nunc id ornare. Pellentesque pharetra ac massa in bibendum. Duis in erat cursus, vehicula orci ac, ullamcorper lacus. Donec pharetra mauris et nisl cursus mattis. Nam vulputate ultricies elit vel condimentum. Vestibulum orci urna, pellentesque vitae mauris sed, sagittis tristique urna. Phasellus gravida vulputate diam nec aliquet. Nunc ac consectetur odio.');
        $b7->setStartingPrice('1.00');
        $b7->setReservePrice('5.00');
        $b7->setGenre($g6);
        $b7->setSeller($this->getReference(UserFixtures::SELLER1_REFERENCE));
        $b7->setStatus('active');

        $b8 = new Book();
        $b8->setTitle('The Fault in Our Stars');
        $b8->setAuthor('John Green');
        $b8->setImage('book_fault.png');
        $b8->setISBN(	9780141345659);
        $b8->setSummary('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc libero, porttitor eget accumsan at, convallis id orci. Maecenas tristique nisi in rhoncus gravida. Aliquam erat volutpat. Integer rhoncus massa quis aliquam tristique. Nunc eget orci consequat, gravida orci malesuada, consectetur dui. Donec metus nisi, euismod non arcu at, molestie pretium metus. Nam mattis sed nunc id ornare. Pellentesque pharetra ac massa in bibendum. Duis in erat cursus, vehicula orci ac, ullamcorper lacus. Donec pharetra mauris et nisl cursus mattis. Nam vulputate ultricies elit vel condimentum. Vestibulum orci urna, pellentesque vitae mauris sed, sagittis tristique urna. Phasellus gravida vulputate diam nec aliquet. Nunc ac consectetur odio.');
        $b8->setStartingPrice('4.00');
        $b8->setReservePrice('15.00');
        $b8->setGenre($g8);
        $b8->setSeller($this->getReference(UserFixtures::SELLER2_REFERENCE));
        $b8->setStatus('active');

        $b9 = new Book();
        $b9->setTitle('Murder on the Orient Express');
        $b9->setAuthor('Agatha Christie');
        $b9->setImage('book_murder.png');
        $b9->setISBN(	9788497571838);
        $b9->setSummary('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc libero, porttitor eget accumsan at, convallis id orci. Maecenas tristique nisi in rhoncus gravida. Aliquam erat volutpat. Integer rhoncus massa quis aliquam tristique. Nunc eget orci consequat, gravida orci malesuada, consectetur dui. Donec metus nisi, euismod non arcu at, molestie pretium metus. Nam mattis sed nunc id ornare. Pellentesque pharetra ac massa in bibendum. Duis in erat cursus, vehicula orci ac, ullamcorper lacus. Donec pharetra mauris et nisl cursus mattis. Nam vulputate ultricies elit vel condimentum. Vestibulum orci urna, pellentesque vitae mauris sed, sagittis tristique urna. Phasellus gravida vulputate diam nec aliquet. Nunc ac consectetur odio.');
        $b9->setStartingPrice('10.00');
        $b9->setReservePrice('66.40');
        $b9->setGenre($g3);
        $b9->setSeller($this->getReference(UserFixtures::SELLER3_REFERENCE));
        $b9->setStatus('active');

        $b10 = new Book();
        $b10->setTitle('The Diary of A Young Girl');
        $b10->setAuthor('Anne Frank');
        $b10->setImage('book_diary.png');
        $b10->setISBN(	9780307832375);
        $b10->setSummary('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc libero, porttitor eget accumsan at, convallis id orci. Maecenas tristique nisi in rhoncus gravida. Aliquam erat volutpat. Integer rhoncus massa quis aliquam tristique. Nunc eget orci consequat, gravida orci malesuada, consectetur dui. Donec metus nisi, euismod non arcu at, molestie pretium metus. Nam mattis sed nunc id ornare. Pellentesque pharetra ac massa in bibendum. Duis in erat cursus, vehicula orci ac, ullamcorper lacus. Donec pharetra mauris et nisl cursus mattis. Nam vulputate ultricies elit vel condimentum. Vestibulum orci urna, pellentesque vitae mauris sed, sagittis tristique urna. Phasellus gravida vulputate diam nec aliquet. Nunc ac consectetur odio.');
        $b10->setStartingPrice('25.00');
        $b10->setReservePrice('193.00');
        $b10->setGenre($g1);
        $b10->setSeller($this->getReference(UserFixtures::SELLER1_REFERENCE));
        $b10->setStatus('active');

        $b11 = new Book();
        $b11->setTitle('My Sister\'s Keeper');
        $b11->setAuthor('Jodi Picoult');
        $b11->setImage('book_keeper.png');
        $b11->setISBN(	9789616588126);
        $b11->setSummary('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc libero, porttitor eget accumsan at, convallis id orci. Maecenas tristique nisi in rhoncus gravida. Aliquam erat volutpat. Integer rhoncus massa quis aliquam tristique. Nunc eget orci consequat, gravida orci malesuada, consectetur dui. Donec metus nisi, euismod non arcu at, molestie pretium metus. Nam mattis sed nunc id ornare. Pellentesque pharetra ac massa in bibendum. Duis in erat cursus, vehicula orci ac, ullamcorper lacus. Donec pharetra mauris et nisl cursus mattis. Nam vulputate ultricies elit vel condimentum. Vestibulum orci urna, pellentesque vitae mauris sed, sagittis tristique urna. Phasellus gravida vulputate diam nec aliquet. Nunc ac consectetur odio.');
        $b11->setStartingPrice('6.60');
        $b11->setReservePrice('17.60');
        $b11->setGenre($g5);
        $b11->setSeller($this->getReference(UserFixtures::SELLER2_REFERENCE));
        $b11->setStatus('active');

        $b12 = new Book();
        $b12->setTitle('Extremely Loud & Incredibly Close');
        $b12->setAuthor('Jonathan Safran Foer');
        $b12->setImage('book_loud.png');
        $b12->setISBN(	9784140056035);
        $b12->setSummary('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nunc libero, porttitor eget accumsan at, convallis id orci. Maecenas tristique nisi in rhoncus gravida. Aliquam erat volutpat. Integer rhoncus massa quis aliquam tristique. Nunc eget orci consequat, gravida orci malesuada, consectetur dui. Donec metus nisi, euismod non arcu at, molestie pretium metus. Nam mattis sed nunc id ornare. Pellentesque pharetra ac massa in bibendum. Duis in erat cursus, vehicula orci ac, ullamcorper lacus. Donec pharetra mauris et nisl cursus mattis. Nam vulputate ultricies elit vel condimentum. Vestibulum orci urna, pellentesque vitae mauris sed, sagittis tristique urna. Phasellus gravida vulputate diam nec aliquet. Nunc ac consectetur odio.');
        $b12->setStartingPrice('11.00');
        $b12->setReservePrice('22.30');
        $b12->setGenre($g5);
        $b12->setSeller($this->getReference(UserFixtures::SELLER1_REFERENCE));
        $b12->setStatus('active');

        $manager->persist($b1);
        $manager->persist($b2);
        $manager->persist($b3);
        $manager->persist($b4);
        $manager->persist($b5);
        $manager->persist($b6);
        $manager->persist($b7);
        $manager->persist($b8);
        $manager->persist($b9);
        $manager->persist($b10);
        $manager->persist($b11);
        $manager->persist($b12);

        $manager->flush();

        // allow other fixtures to access user (seller) object
        $this->addReference(self::BOOK1_REFERENCE, $b1);
        $this->addReference(self::BOOK2_REFERENCE, $b2);
        $this->addReference(self::BOOK3_REFERENCE, $b3);
    }

    // load fixtures in order
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
