<?php

namespace App\DataFixtures;

use App\Entity\Webapp\Pagechoice;
use Faker\Factory;
use Faker\Generator;
use App\Entity\Webapp\BlockType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $Arraypc = ['vitrine', 'formation', 'ecommerce', 'gestion', 'contact'];
        $arraybt = ['Jumbotron', 'Team', 'Formulaire de contact', 'Inscription newsletter', 'Galerie', 'Actualités'];

        foreach ($arraybt as $bt){
            $blockType = new BlockType();
            $blockType->setName($bt);
        }
        $blockType = new BlockType();
        $blockType->setName('Jumbotron');

        $manager->flush();
    }
}
