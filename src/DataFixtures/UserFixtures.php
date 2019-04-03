<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
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
        $userAdmin = $this->createUser('admin', 'admin', ['ROLE_ADMIN']);
        $userSeller = $this->createUser('seller', 'seller', ['ROLE_SELLER']);
        $userBuyer = $this->createUser('buyer', 'buyer', ['ROLE_BUYER']);

        $manager->persist($userAdmin);
        $manager->persist($userSeller);
        $manager->persist($userBuyer);

        $manager->flush();
    }
}
