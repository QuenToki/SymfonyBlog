<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $toto)
    {
        $this->encoder = $toto;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 10; $i++) { 
            $user = new User();
            $user->setEmail('robin' . $i . '@hotmail.fr');
            $user->setPassword($this->encoder->encodePassword($user, 'user'));
            $user->setRoles(['ROLE_USER']);

            $this->setReference('user_' . $i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
