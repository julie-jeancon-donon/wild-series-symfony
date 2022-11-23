<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    const PROGRAM = [
        [
            'title' => 'Vice Versa',
            'synopsis' => 'Au Quartier Général, le centre de contrôle situé dans la tête de la petite Riley, 11 ans, cinq Émotions sont au travail. Lorsque la famille de Riley emménage dans une grande ville, avec tout ce que cela peut avoir d’effrayant, les Émotions ont fort à faire pour guider la jeune fille durant cette difficile transition.',
            'category' => 'Animation',
            'poster' => 'https://m.media-amazon.com/images/I/712XQ+o7JiL._AC_SL1500_.jpg',
            'country' => 'USA',
            'year' => '2015',
        ],
        [   'title' => 'Slasher',
            'synopsis' => "D'ignobles tueurs en série sèment l'effroi tandis que leurs prochaines victimes luttent pour leur survie dans cette terrifiante série d'anthologie.",
            'category' => 'Horreur',
            'poster' => 'https://fr.web.img6.acsta.net/pictures/16/02/23/15/43/145751.jpg',
            'country' => 'USA',
            'year' => '2016',
        ],
        [   'title' => 'Mad Max',
            'synopsis' => "Max est capturé et fait prisonnier dans la Citadelle dirigée par Immortan Joe. C’est alors qu'il se retrouve embarqué dans une course poursuite explosive.",
            'category' => 'Action',
            'poster' => 'https://media.senscritique.com/media/000017108234/300/mad_max_fury_road.jpg',
            'country' => 'USA',
            'year' => '2015',
        ],
        [   'title' => 'Jurassic Park',
            'synopsis' => "Sur une île au large du Costa Rica, des scientifiques, financés par le milliardaire John Hammond, ont réussi à cloner des animaux préhistoriques. Leur découverte a permis de créer un parc d'attractions peuplé de dinosaures. Avant l'ouverture au public, Hammond demande à Alan et Ellie, deux paléontologues de renom, de cautionner son projet. Mais lors de la première inspection, le système de sécurité se détraque.",
            'category' => 'Aventure',
            'poster' => 'https://media.senscritique.com/media/000017589279/300/jurassic_park.jpg',
            'country' => 'USA',
            'year' => '1994',
        ],
        [   'title' => 'Stranger Things',
            'synopsis' => "A Hawkins, en 1983 dans l'Indiana. Lorsque Will Byers disparaît de son domicile, ses amis se lancent dans une recherche semée d’embûches pour le retrouver. Dans leur quête de réponses, les garçons rencontrent une étrange jeune fille en fuite. Les garçons se lient d'amitié avec la demoiselle tatouée du chiffre '11' sur son poignet et au crâne rasé et découvrent petit à petit les détails sur son inquiétante situation. Elle est peut-être la clé de tous les mystères qui se cachent dans cette petite ville en apparence tranquille…",
            'category' => 'Fantastique',
            'poster' => 'https://fr.web.img2.acsta.net/c_310_420/pictures/22/05/18/14/31/5186184.jpg',
            'country' => 'USA',
            'year' => '2016',
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::PROGRAM as $key => $value){
            $program = new Program();
            $program->setTitle($value['title']);
            $program->setSynopsis($value['synopsis']);
            $program->setCategory($this->getReference('category_' . $value['category']));
            $program->setPoster($value['poster']);
            $program->setCountry($value['country']);
            $program->setYear($value['year']);
            $manager->persist($program);
        }
       
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CategoryFixtures::class,
        ];
    }
}
