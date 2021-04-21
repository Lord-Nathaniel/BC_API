<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

/** ***********************************Fixture pour les Marques*************************************** */
/** 
 * La fixture va permettre de créer les Marques, dont les données sont fixées ici, 
 * puis de les écrire dans la base de données.
*/
/**
 * Cette fixture n'a pas besoin de références pour être créé !
 */
class MarqueFixtures extends Fixture
{

    public const NAME_MARQUE='name_marque';

    /**partie appelée par la commande de terminal : php bin/console doctrine:fixtures:load --append
    *le flag --append permet de ne pas mettre la BDD à zero 
    */
    public function load(ObjectManager $manager)
    {

        $this->manager=$manager;

        $allList = ['abarth','alfa-romeo','alpine','aston-martin','audi','bentley','bmw','bmw-alpina','cadillac','chevrolet','chrysler','citroen','cupra','dacia','daihatsu','dangel','dodge','ds','ferrari','fiat','fisker','ford','honda','hyundai','infiniti','jaguar','jeep','kia','lada','lamborghini','lancia','land-rover','lexus','lotus','mahindra','maserati','mazda','mercedes-benz','mia-electric','mini','mitsubishi','morgan','nissan','opel','peugeot','pgo','porsche','renault','rolls-royce','saab','santana','seat','skoda','smart','ssangyong','subaru','suzuki','tesla','toyota','venturi','volkswagen','volvo','personnalisé'];
        $commonList =['audi','bmw','citroen','dacia','fiat','ford','hyundai','kia','land-rover','mercedes-benz','mini','nissan','opel','peugeot','renault','seat','skoda','toyota','volkswagen','volvo'];

        //choix de la liste s'effectue ici :
        $activeList = $allList;
        $quantity = count($activeList);

        for($i=0;$i<$quantity;$i++){
            $marque = new Marque();
            $nameMarque = $activeList[$i];

            $marque->setName($nameMarque);
            $marque->setLogoUrl('img/'.$nameMarque.'.png');
            if(in_array($nameMarque,$commonList)){
                $marque->setIsCommon(true);
            } else {
                $marque->setIsCommon(false);
            }

            $manager->persist($marque);
            //permet de stocker les références pour les Garages
            $this->addReference(self::NAME_MARQUE . '_' . $i, $marque);       
        }

        $manager->flush();

    }
}
    