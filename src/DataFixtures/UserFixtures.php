<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    //constantes utilisées comme clés pour retrouver ces utilisateurs depuis VideoFixtures
    public const USER_GOKU_REFERENCE = 'user_goku';
    public const USER_SEIYA_REFERENCE = 'user_seiya';
    public const USER_SIMBA_REFERENCE = 'user_simba';

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
        //service Symfony injecté automatiquement, utilisé pour hacher les mots de passe
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $goku = new User();
        $goku->setEmail('goku@test.com');
        $goku->setFirstname('Goku');
        $goku->setLastname('Son');
        $goku->setRoles([]); //tableau vide accepté, Symfony ajoute ROLE_USER automatiquement à la lecture
        $goku->setIsVerified(true);
        $goku->setPassword($this->passwordHasher->hashPassword($goku, 'Motdepasse123!'));
        //hashPassword() a besoin de l'objet $goku pour connaître l'algorithme lié à sa classe
        $manager->persist($goku); //place l'entité en attente d'insertion, rien n'est écrit en base ici
        $this->addReference(self::USER_GOKU_REFERENCE, $goku);
        //enregistre une référence mémoire vers cet objet, réutilisable sans nouvelle requête

        $seiya = new User();
        $seiya->setEmail('seiya@test.com');
        $seiya->setFirstname('Seiya');
        $seiya->setLastname('Pegasus');
        $seiya->setRoles([]);
        $seiya->setIsVerified(true);
        $seiya->setPassword($this->passwordHasher->hashPassword($seiya, 'Motdepasse123!'));
        $manager->persist($seiya);
        $this->addReference(self::USER_SEIYA_REFERENCE, $seiya);

        $simba = new User();
        $simba->setEmail('simba@test.com');
        $simba->setFirstname('Simba');
        $simba->setLastname('Roi Lion');
        $simba->setRoles([]);
        $simba->setIsVerified(true);
        $simba->setPassword($this->passwordHasher->hashPassword($simba, 'Motdepasse123!'));
        $manager->persist($simba);
        $this->addReference(self::USER_SIMBA_REFERENCE, $simba);

        $test = new User();
        $test->setEmail('test@test.com');
        $test->setFirstname('Test');
        $test->setLastname('Utilisateur');
        $test->setRoles([]);
        $test->setIsVerified(false); //aucune référence ajoutée : cet utilisateur ne recevra pas de vidéo
        $test->setPassword($this->passwordHasher->hashPassword($test, 'Motdepasse123!'));
        $manager->persist($test);

        $manager->flush(); //un seul flush regroupé, plus performant que 4 flush séparés
    }
}