<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
//use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Yaml\Yaml;

class RegFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $loadData = Yaml::parseFile(__DIR__ . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR . 'test_loader.yml');
        foreach ($loadData as $class => $records) {
            foreach ($records as $key => $record) {
                $object = new $class();
                foreach ($record as $column => $value) {
                    if ($column == 'Password') {
                        $value = $this->encoder->encodePassword($object, 'Admin!23');
                    }
                    $setter = 'set' . $column;
                    $object->$setter($value);
                }
                $manager->persist($object);
            }
        }
        $manager->flush();
//        die;
//        $user = new User();
//        $user->setUserName('admin');
//        $user->setEmail('testadmin@orangehrm.us.com');
//        $user->setPassword($this->encoder->encodePassword($user, 'Admin!23'));
//        $manager->persist($user);
//
//        $manager->flush();
    }
}
