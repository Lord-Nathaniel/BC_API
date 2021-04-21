<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;


/** ***********************************Fixture pour les Users*************************************** */
/** 
 * La fixture va permettre de créer les Users, leur passer de fausses données avec phpFaker, 
 * puis de les écrire dans la base de données.
*/
/**
 * Cette fixture n'a pas besoin de références pour être créé !
 */
class UserFixtures extends Fixture
{
    //partie nécessaire pour l'encodage des mots de passe
    private $passwordEncoder;

    public const EMAIL_USER='email_user';

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->encoder = $passwordEncoder;
    }

    /**
     * partie appelée par la commande de terminal : php bin/console doctrine:fixtures:load --append
     * le flag --append permet de ne pas mettre la BDD à zero 
     */
    public function load(ObjectManager $manager)
    {

        $this->manager=$manager;
        $userEmail = 'email';
        $faker = Faker\Factory::create();
        $quantity = 20;
        for($i=0;$i<$quantity;$i++){
            $user = new User();

            //partie encodage du mot de passe
            $plainPassword = $faker->realTextBetween($minNbChars = 5, $maxNbChars = 12, $indexSize = 2);
            $encoded = $this->encoder->encodePassword($user, $plainPassword);

            $firstName=$faker->unique()->firstName();
            $lastName=$faker->lastName();
            $domain=$faker->freeEmailDomain();
            $email=$firstName[0].$lastName.'@'.$domain;

            $user->setEmail($email)
                 ->setPassword($encoded)
                 ->setFirstname($firstName)
                 ->setLastname($lastName)
                 ->setRoles(["ROLE_USER"]);

            $manager->persist($user);      
            //permet de stocker les références pour les Garages
            $this->addReference(self::EMAIL_USER . '_' . $i, $user);
        }

        $manager->flush();

        
    }
}
