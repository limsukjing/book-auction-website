<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $c1 = new Comment();
        $c1->setAuthor($this->getReference(UserFixtures::BUYER1_REFERENCE));
        $c1->setContent('Lacinia praesent lacus. Nonummy praesent vulputate mauris dui vel, in sit, suspendisse sit donec urna aliquet?');
        $c1->setItem($this->getReference(BookGenreFixtures::BOOK1_REFERENCE));

        $c2 = new Comment();
        $c2->setAuthor($this->getReference(UserFixtures::SELLER1_REFERENCE));
        $c2->setContent('Et dapibus, augue placerat elit blandit ac aenean id, mauris risus fames velit mattis, donec ac, hac pellentesque gravida bibendum quis. Sem aliquam, eu ut porta litora turpis adipiscing, metus nunc, in suscipit libero.');
        $c2->setItem($this->getReference(BookGenreFixtures::BOOK1_REFERENCE));

        $c3 = new Comment();
        $c3->setAuthor($this->getReference(UserFixtures::BUYER2_REFERENCE));
        $c3->setContent('Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam?');
        $c3->setItem($this->getReference(BookGenreFixtures::BOOK1_REFERENCE));

        $c4 = new Comment();
        $c4->setAuthor($this->getReference(UserFixtures::BUYER3_REFERENCE));
        $c4->setContent('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem?');
        $c4->setItem($this->getReference(BookGenreFixtures::BOOK2_REFERENCE));

        $c5 = new Comment();
        $c5->setAuthor($this->getReference(UserFixtures::SELLER2_REFERENCE));
        $c5->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $c5->setItem($this->getReference(BookGenreFixtures::BOOK2_REFERENCE));

        $c6 = new Comment();
        $c6->setAuthor($this->getReference(UserFixtures::SELLER3_REFERENCE));
        $c6->setContent('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.');
        $c6->setItem($this->getReference(BookGenreFixtures::BOOK3_REFERENCE));

        $manager->persist($c1);
        $manager->persist($c2);
        $manager->persist($c3);
        $manager->persist($c4);
        $manager->persist($c5);
        $manager->persist($c6);
        $manager->flush();
    }

    // load fixtures in order
    public function getDependencies()
    {
        return array(
            BookGenreFixtures::class,
        );
    }
}
