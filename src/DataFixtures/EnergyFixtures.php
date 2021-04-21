<?php

namespace App\DataFixtures;

use App\Entity\Energy;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;


/** ***********************************Fixture pour les Energy*************************************** */
/** 
 * La fixture va permettre de créer les Energy, dont les données sont fixées ici, 
 * puis de les écrire dans la base de données.
*/
/**
 * Cette fixture n'a pas besoin de références pour être créé !
 */
class EnergyFixtures extends Fixture
{
    public const NAME_ENERGY='name_energy';

    /**partie appelée par la commande de terminal : php bin/console doctrine:fixtures:load --append
    *le flag --append permet de ne pas mettre la BDD à zero 
    */
    public function load(ObjectManager $manager)
    {

        $this->manager=$manager;

        $detailedList = ['B7 : Gazole', 'B10 : Nouveau gazole', 'XTL : Gazole de synthèse','E10 : Essence SP95 E10','E5 : Essence SP95 98','E85 : Bioéthanol','Electrique','LNG : Gaz naturel liquéfié','H2 : Hydrogène','CNG : Gaz Naturel Comprimé', 'LPG : GPL-c'];
        $commonList = ['Diesel','Essence','Gaz','Electrique'];

        //choix de la liste s'effectue ici :
        $activeList = $commonList;
        $quantity = count($activeList);

        for($i=0;$i<$quantity;$i++){
            $energy = new Energy();

            $energy->setName($activeList[$i]);

            $manager->persist($energy);       
            //permet de stocker les références pour les Garages
            $this->addReference(self::NAME_ENERGY . '_' . $i, $energy);
        }
        $manager->flush();

    }
}