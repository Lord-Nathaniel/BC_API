<?php

namespace App\DataFixtures;


use App\Entity\Garage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;


/** ***********************************Fixture pour les Garages*************************************** */
/** 
 * La fixture va permettre de créer les Garages, leur passer de fausses données avec phpFaker, 
 * puis de les écrire dans la base de données.
*/
/**
 * Cette fixture dépend de User !!!
 */
class GarageFixtures extends Fixture implements DependentFixtureInterface
{

    public const NAME_GARAGE='name_garage';
    /**partie appelée par la commande de terminal : php bin/console doctrine:fixtures:load --append
    *le flag --append permet de ne pas mettre la BDD à zero 
    */
    public function load(ObjectManager $manager)
    {

        $this->manager=$manager;

        $faker = Faker\Factory::create('fr_FR');
        //penser à calquer la quantité de User ici !
        $quantityUser = 20-1;
        $quantity = 30;

        for($i=0;$i<$quantity;$i++){
            $garage = new Garage();


            $garage->setName($faker->words(rand(1,5),true))
                   ->setSiret($faker->optional($weight = 0.95)->numerify('##############'))
                   ->setAdresse($faker->optional($weight = 0.7)->secondaryAddress())
                   ->setPostalcode($faker->optional($weight = 0.7)->numerify('#####'))
                   ->setTown($faker->optional($weight = 0.7)->region())
                   ->setPhone($faker->optional($weight = 0.8)->numerify('0#########')) //$weight = 0.8 correspond à 20% de chance d'être NULL
                   ->setUser($this->getReference(UserFixtures::EMAIL_USER.'_'.rand(0,$quantityUser)));

            $manager->persist($garage); 
            //permet de stocker les références pour les Garages
            $this->addReference(self::NAME_GARAGE . '_' . $i, $garage);      
        }

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
