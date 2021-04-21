<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;


/** ***********************************Fixture pour les Images*************************************** */
/** 
 * La fixture va permettre de créer les Images, leur passer de fausses données avec phpFaker, 
 * puis de les écrire dans la base de données.
*/
/**
 * Cette fixture dépend de Car !!!
 */
class ImageFixtures extends Fixture implements DependentFixtureInterface
{

    /**partie appelée par la commande de terminal : php bin/console doctrine:fixtures:load --append
    *le flag --append permet de ne pas mettre la BDD à zero 
    */
    public function load(ObjectManager $manager)
    {

        $this->manager=$manager;

        $faker = Faker\Factory::create('fr_FR');
        //penser à calquer la quantité de Car ici !
        $quantityCar = 200-1;
        $quantity = 30;

        for($i=0;$i<$quantity;$i++){
            $image = new Image();


            $image->setImageUrl('img/cars/'.$i.'.png')
                  ->setCar($this->getReference(CarFixtures::NAME_CAR.'_'.rand(0,$quantityCar)));

            $manager->persist($image);       
        }

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            CarFixtures::class,
        ];
    }
}
