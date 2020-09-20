<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encode;
    public function __construct(UserPasswordEncoderInterface $encoderInterface)
    {
        $this->encode = $encoderInterface;
    }
    public function load(ObjectManager $manager)
    {
         $user = new User();
         $user->setEmail('cosmovelox@gmail.com');
         $user->setFirstname('Impiccichè');
         $user->setLastname('Giuseppe');
         $user->setAddress('Test test');
         $user->setPhone('65824188');
         $user->setPassword($this->encode->encodePassword($user,'123456789'));
         $user->setRoles(['ROLE_USER']);
         $user->setVerify(true);
         $user->setCreatedAt(new \DateTime());
         $user->setAvatar('');
         $user->setBirthday(new \DateTime('12/03/2020'));

         $manager->persist($user);

        $manager->flush();
    }
}
