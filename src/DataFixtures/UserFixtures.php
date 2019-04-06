<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    // user (seller) object reference
    public const SELLER1_REFERENCE = 'seller1';
    public const SELLER2_REFERENCE = 'seller2';
    public const SELLER3_REFERENCE = 'seller3';

    private $passwordEncoder;

    // create $passwordEncoder object
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    private function createUser($username, $plainPassword, $roles = ['ROLE_USER']): User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setRoles($roles);

        // encode password
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);
        return $user;
    }

    public function load(ObjectManager $manager)
    {
        $admin = $this->createUser('admin', 'admin', ['ROLE_ADMIN']);
        $seller1 = $this->createUser('seller', 'seller', ['ROLE_SELLER']);
        $seller2 = $this->createUser('Rachel Seller', 'Rachel Seller', ['ROLE_SELLER']);
        $seller3 = $this->createUser('Caleb Seller', 'Caleb Seller', ['ROLE_SELLER']);
        $buyer1 = $this->createUser('buyer', 'buyer', ['ROLE_BUYER']);
        $buyer2 = $this->createUser('Eleanor Buyer', 'Eleanor Buyer', ['ROLE_BUYER']);
        $buyer3 = $this->createUser('Aidan Buyer', 'Aidan Buyer', ['ROLE_BUYER']);

        $manager->persist($admin);
        $manager->persist($seller1);
        $manager->persist($buyer1);
        $manager->persist($seller2);
        $manager->persist($buyer2);
        $manager->persist($seller3);
        $manager->persist($buyer3);

        $manager->flush();

        // allow other fixtures to access user (seller) object
        $this->addReference(self::SELLER1_REFERENCE, $seller1);
        $this->addReference(self::SELLER2_REFERENCE, $seller2);
        $this->addReference(self::SELLER3_REFERENCE, $seller3);
    }
}
