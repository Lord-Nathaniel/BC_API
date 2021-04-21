<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;


/** ***********************************Fixture pour les Cars*************************************** */
/** 
 * La fixture va permettre de créer les Cars, leur passer de fausses données avec phpFaker, 
 * puis de les écrire dans la base de données.
*/
/**
 * Cette fixture dépend de Energy, de Garage (dépendant de User), de Modele (dépendant de Marque)  !!!
 */
class CarFixtures extends Fixture implements DependentFixtureInterface
{

    public const NAME_CAR='name_car';

    /**partie appelée par la commande de terminal : php bin/console doctrine:fixtures:load --append
    *le flag --append permet de ne pas mettre la BDD à zero 
    */
    public function load(ObjectManager $manager): void
    {
    
        $this->manager=$manager;

        $faker = Faker\Factory::create('fr_FR');
        //penser à calquer la quantité de Garage, de Modele et de Energy ici !
        $quantityModele=620-1;
        $quantityEnergy=4-1;
        $quantityGarage = 20-1;
        $quantity = 200;

        for($i=0;$i<$quantity;$i++){
            $car = new Car();

            $randModele=rand(0,$quantityModele);            
            $randGarage=rand(0,$quantityGarage);
            $randEnergy=rand(0,$quantityEnergy);
            $randEtat=rand(0,5);
            $ListModele = [
                '500','Grande Punto','124',
                'Giulietta','MiTo','Stelvio','Giulia','159','147','Brera','GT','GTV','Spider','156','166','4C',
                'A110',
                'Vantage','DB9','Rapide','Vanquish','DB11','Cygnet','DBS','Virage',
                'A3','A4','A1','Q5','Q3','A5','A5 Sportback','A6','A7','A8','e-tron','Q2','Q7','Q8','R8','TT',
                'Continental','Coupe','Continental Flying S','Arnage','Azure','Brooklands','Mulsanne',
                'Serie 1','Serie 2','Serie 3','Serie 4','Serie 5','Serie 6','Serie 7','Serie 8','X1','X2','X3','X4','X5','X6','X7','i3','i8','Z4',
                'B3','B5','B6','B7','D3','D5',
                'Escalade','SRX','BLS','ATS','CT6','CTS','STS','XLR',
                'Aveo','Spark','Captiva','Cruze','Orlando','Trax','Camaro','Corvette','Epica','Evanda','Kalos','Lacetti','Malibu','Matiz','Nubira','Rezzo','Volt',
                'Grand voyager','300 C','PT Cruiser','Crossfire','Sebring','Voyager',
                'C1','C2','C3','C3 Aircross','C3 Picasso','C4','C4 Picasso','C4 Aircross','C5','C5 Aircross','C6','C8','C-Zero','C-Crosser','C-Elysee','DS3','DS4','DS5','Berlingo','Jumper','Jumpy','Mehari','Nemo','Picasso','SpaceTourer','Xsara',
                'Ateca',
                'Sandero','Duster','Logan','Lodgy','Dokker',
                'Terios','Trevis','Copen','Sirion','Charade','Cuore','Materia','Yrv',
                'Berlingo 4x4','Berlingo Silhouette','Partner Silhouette','Partner 4x4',
                'Nitro','Journey','Caliber','Avenger',
                'DS3','DS4','DS5','DS7',
                'F430','California','599 GTB','FF','GTC4Lusso','458','F12','488','612 Scaglietti',
                '500','Panda','Punto','Tipo','Grande Punto','Scudo','Barchetta','Bravo','Croma','Doblo','Ducato','Fiorino Qubo','Freemont','Idea','Multipla','Sedici','Seicento','Stilo','Talento','Ulysse','124',
                'Karma',
                'Fiesta','Focus','Kuga','C-Max','Mondeo','S-Max','B-Max','Custom','EcoSport','Edge','Explorer','Fusion','Galaxy','Ka','Ka+','Mustang','Puma','Streetka','Tourneo','Tourneo Connect','Tourneo Courier','Transit','Transit 2T',
                'Civic','CR-V','Jazz','HR-V','Accord','FR-V','CR-Z','Honda e','Legend','S2000',
                'Tucson','i20','ix35','i30','i10','Santa','Accent','Atos','Coupe','Elantra','Genesis','Getz','Grandeur','Ioniq','ix20','ix55','i40','Kona','Matrix','Nexo','Satellite','Sonata','Terracan','Trajet','Veloster',
                'Q30','Q50','FX','QX70','QX30','Q70','EX','G','M','QX50','Q60',
                'XF','F-Pace','XE','E-Pace','F-Type','XK8','I-Pace','S-Type','XJ','X-Type',
                'Renegade','Wrangler','Grand Cherokee','Compass','Cherokee','Commander','Patriot',
                'Sportage','Cee\'d','Picanto','Rio','Niro','Venga','Carens','Carnival','Cerato','Magentis','Opirus','Optima','Sorento','Soul','Stinger','Stonic','XCeed',
                'Niva','Priora','Granta','Kalina','111','1118','112',
                'Huracan','Gallardo','Aventador','Murcielago',
                'Ypsilon','Delta','Grand Voyager','Musa','Phedra','Thesis','Flavia Cabriolet','Thema',
                'Range Rover','Discovery Sport','Discovery','Freelander','Defender',
                'NX','RX','CT','IS','GS','UX','ES','LC','LS','RC','SC',
                'Elise','Evora',
                'Goa','Bolero',
                'Ghibli','Quattroporte','Levante','Gran Turismo','Coupe','Spyder',
                'CX-3','CX-5','CX-7','CX-30','MX-5','MX-30','Mazda 2','Mazda 3','Mazda 5','Mazda 6','Rx-8',
                'Classe A','Classe B','Clases C','Classe E','Classe G','Classe GL','Classe R','Classe S','Classe V','AMG','Citan','CL','CLA','CLK','CLS','EQC','GLA','GLB','GLC','GLE','GLK','GLS','ML','SL','SLC','SLK','SLS','Sprinter','Viano','Vito',
                'Mia',
                'Mini','Countryman','Paceman',
                'ASX','Outlander PHEV','Pajero','Outlander','Space Star','Lancer','Colt','Eclipse','Grandis','i-Miev','Pajero Pinin',
                'Morgan',
                'Qashqai','Juke','Micra','X-Trail','Note','Leaf','Almera','Almera Tino','Cube','GT-R','Interstar','Murano','NV200','NV300','NV400','Pathfinder','Patrol','Pixo','Primastar','Primera','Pulsar','Terrano','350Z','370Z',
                'Corsa','Astra','Mokka','Zafira','Meriva','Insignia','Adam','Agila','Ampera','Antara','Cascada','Combo','Crossland X','Grandland X','Karl','Movano Combi','Signum','Tigra Twintop','Vectra','Vivaro Combi','Zafira Life',
                '107','1007','108','206','207','208','2008','308','3008','407','4007','408','4008','508','5008','607','807','Bipper Tepee','Boxer','Expert','iOn','Partner','RCZ','Rifter','Traveller',
                'Speedster II',
                'Macan','Cayenne','911','Panamera','Cayman','Boxster','Taycan',
                'Clio','Scenic','Megane','Twingo','Captur','Kadjar','Espace','Fluence','Kangoo','Koleos','Laguna','Latitude','Master','Modus','Talisman','Trafic','Vel Satis','Wind','Zoe',
                'Rolls Royce',
                '9.3','9.5','9-4 X','9-7 X',
                'S300',
                'Ibiza','Leon','Ateca','Arona','Alhambra','Altea','Cordoba','Exeo','Mii','Tarraco','Toledo',
                'Octavia','Fabia','Superb','Yeti','Kodiaq','Karoq','Citigo','Kamiq','Rapid','Roomster','Scala',
                'Fortwo Coupe','Fortwo Cabriolet','Forfour','Smart Roadster','Smart Roadster Coupe',
                'Korando','Rexton','Rodius','Tivoli','Kyron','Actyon',
                'Forester','XV','Outback','Impreza','Legacy','Levorg','BRZ','B9 Tribeca','Justy','Trezia',
                'Swift','Vitara','Jimny','SX4 S-Cross','Ignis','Grand Vitara','Alto','Baleno','Celerio','Kizashi','Liana','Splash','SX4','Wagon',
                'Model 3','Model S','Model X',
                'Yaris','RAV4','Auris','Aygo','C-HR','Prius','Avensis','Camry','Celica','Corolla','GR Supra','GT 86','HiAce','iQ','Land cruiser','Mirai','MR','Previa','Proace','Proace City','Urban Cruiser','Verso',
                'Fetish',
                'Golf','Polo','Tiguan','Touran','Passat','T-Roc','Arteon','Beetle','Bora','Caddy','California','Caravelle','Coccinelle','Combi','Crafter','Eos','Fox','Golf Plus','Golf Sportsvan','Jetta','LT','Multivan','Phaeton','Scirocco','Sharan','T-Cross','Touareg','Up',
                'C30','C70','S40','S60','S80','S90','v4à','V50','V60','V70','V90','XC40','XC60','XC70','XC90',
                'personnalisé'];
            $ListEnergy=['moteur diesel','moteur essence','moteur à gaz','moteur electrique'];
            $ListEtats=['neuve','comme neuve','peu utilisée','très utilisée','ancienne','de collection'];
            
            [
                'dateObject' => $dateObject, 
                'dateString' => $dateString
            ] = $this->generateRandomDate('01/01/2020','01/05/2021');

            $car->setName('Voiture '.$ListEnergy[$randEnergy].' '.$ListEtats[$randEtat].', modèle '.$ListModele[$randModele])
                ->setDescription($faker->optional($weight = 0.7)->paragraph())
                ->setAdDate($dateObject)
                ->setPrice($faker->optional($weight = 0.7)->randomNumber(5, true))
                ->setKm($faker->optional($weight = 0.7)->randomNumber(5, true))
                ->setYear($faker->optional($weight = 0.8)->numberBetween(2000, 2020)) //$weight = 0.8 correspond à 20% de chance d'être NULL
                ->setIsSold(false)
                ->setModele($this->getReference(ModeleFixtures::NAME_MODELE.'_'.$randModele))
                ->setGarage($this->getReference(GarageFixtures::NAME_GARAGE.'_'.$randGarage))
                ->setEnergy($this->getReference(EnergyFixtures::NAME_ENERGY.'_'.$randEnergy));

            $manager->persist($car); 
            //permet de stocker les références pour les Images
            $this->addReference(self::NAME_CAR . '_' . $i, $car);
        }

        $manager->flush();
    }    

    private function generateRandomDate(string $start, string $end):array
    {
        $startDateTimestamp =(\Datetime::createFromFormat('d/m/Y', $start))->getTimestamp();
        $endDateTimestamp =(\Datetime::createFromFormat('d/m/Y', $end))->getTimestamp();
        $randomTimestamp =mt_rand($startDateTimestamp, $endDateTimestamp);
        $dateTimeImmutable = (new \DateTimeImmutable())->setTimestamp($randomTimestamp);

        return [
            'dateObject' => $dateTimeImmutable,
            'dateString' => $dateTimeImmutable->format('d-m-Y')
        ];
    }

    public function getDependencies()
    {
        return [
            GarageFixtures::class,
            ModeleFixtures::class,
            EnergyFixtures::class,
        ];
    }

}