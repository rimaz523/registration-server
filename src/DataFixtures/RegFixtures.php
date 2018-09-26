<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RegFixtures extends Fixture implements ContainerAwareInterface
{
    private $encoder;
    private $container;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $em = $this->container->get('doctrine')->getEntityManager('default');
        $loadData = Yaml::parseFile(__DIR__ . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR . 'test_loader.yml');
        foreach ($loadData as $class => $records) {
            foreach ($records as $key => $record) {
                $object = new $class();
                foreach ($record as $column => $value) {
                    $columnAttr = explode("-", $column);
                    if (count($columnAttr) > 1) {
                        $column = $columnAttr[0];
                        switch ($columnAttr[1]) {
                                case 'Password':
                                    $value = $this->encoder->encodePassword($object, $value);
                                    break;
                                case '\App\Entity\RegUsers':
                                    $value = $em->getRepository(\App\Entity\RegUsers::class)->find($value);
                                    break;
                                default:
                                    break;
                            }    
                    }
                    $setter = 'set' . $column;
                    $object->$setter($value);
                }
                $manager->persist($object);
            }
        }
        $manager->flush();
    }
}
