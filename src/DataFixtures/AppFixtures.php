<?php

namespace App\DataFixtures;

use App\Entity\TextEntry;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        //Demo users
        $user1 = new User();
        $user1->setUsername('adam_migacz');
        $user1->setPassword($this->encoder->encodePassword($user1, 'adam_migacz'));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('robert_maklowicz');
        $user2->setPassword($this->encoder->encodePassword($user2, 'robert_maklowicz'));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('jerzy');
        $user3->setPassword($this->encoder->encodePassword($user3, 'jerzy'));
        $manager->persist($user3);

        $manager->flush();

        //Demo text entries
        $user1_entry1 = new TextEntry();
        $user1_entry1->setContent('Poszukuje pracy jako Junior PHP Dev.');
        $user1_entry1->setCreationDate(new \DateTime());
        $user1_entry1->setUser($user1);
        $manager->persist($user1_entry1);

        $user2_entry1 = new TextEntry();
        $user2_entry1->setContent('Śmieszny piesek jedzący koperek https://www.youtube.com/watch?v=WZzpzONIIF0.');
        $user2_entry1->setCreationDate(new \DateTime());
        $user2_entry1->setUser($user2);
        $manager->persist($user2_entry1);

        $manager->flush();


    }
}
