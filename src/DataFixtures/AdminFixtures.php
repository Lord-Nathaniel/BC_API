<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


/** ***********************************Fixture pour les Admins*************************************** */
/** 
 * Cette fixture est particulière, car elle ne va créer que deux admin :
 *  celui du client (niveau ADMIN) et le super admin (niveau superadmin)
*/
/**
 * Cette fixture n'a pas besoin de références pour être créé !
 */
class AdminFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $this->manager=$manager;
        $admin = new Admin();
        $superAdmin = new Admin();

        $admin->setEmail('mlodevie@google.com')
              ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$MDdOS1FBYzhVYmhUV1EzLw$xx1nx9uys11JancegM4dFFUIhERrLkWMveIPGLU36BE')
              ->setRoles(["ROLE_ADMIN"])
              ->setFirstname('Monsieur')
              ->setLastname('Lodevie');

        $superAdmin ->setEmail('alozano@outlook.com')
                    ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$WlhIZ0xscEJqQ2d0Rm82bg$eFASPLoHZplT5fQcapvO5qUAPQLgUa/LGe8K1UV1WQI')
                    ->setRoles(["ROLE_SUPERADMIN"])
                    ->setFirstname('Adrien')
                    ->setLastname('Lozano');

        $manager->persist($admin); 
        $manager->persist($superAdmin); 

        $manager->flush();
    }
}