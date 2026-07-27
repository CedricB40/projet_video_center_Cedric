<?php

namespace App\DataFixtures;

use App\DataFixtures\UserFixtures;
use App\Entity\User;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VideoFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            ['Vice Versa', '8n-cJDFQELA', false, UserFixtures::USER_GOKU_REFERENCE],            
            ['Le Roi Lion (2019)', 'tvvQitXftGk', false, UserFixtures::USER_SEIYA_REFERENCE],
            ['Aladdin (1992)', 'NZqFRTbi7IE', false, UserFixtures::USER_SIMBA_REFERENCE],
            ['Toy Story (1995)', 'q_1wTx-qIpk', false, UserFixtures::USER_GOKU_REFERENCE],
            ['Toy Story 2 (1999)', 'FBkecaF2Jtg', false, UserFixtures::USER_SEIYA_REFERENCE],
            ['Shrek (2001)', 'Qz2Xklx9vIQ', false, UserFixtures::USER_SIMBA_REFERENCE],
            ['Shrek 2 (2004)', 'gUmvgMUC3Wg', false, UserFixtures::USER_SIMBA_REFERENCE],
            ['Le Monde de Narnia : Chapitre 1 (2005)', 'ztFix1KQmSI', false, UserFixtures::USER_SIMBA_REFERENCE],
            ['Small Soldiers (1998)', 'I5wBxwnQzYA', false, UserFixtures::USER_GOKU_REFERENCE],
            ['Jumanji (1995)', '9P6TZcCk0MM', false, UserFixtures::USER_GOKU_REFERENCE],
            ['Hook (1991)', '9CO9Ax9SUto', false, UserFixtures::USER_SEIYA_REFERENCE],
            ['Karaté Kid (1984)', 'r_8Rw16uscg', false, UserFixtures::USER_SEIYA_REFERENCE],
            ['Les 3 Ninjas (1992)', 'wACe6uzBNeo', false, UserFixtures::USER_SIMBA_REFERENCE],
            ["Chérie, j'ai rétréci les gosses (1989)", 'hwmHwx5kZ8A', false, UserFixtures::USER_GOKU_REFERENCE],
            ['Les Goonies (1985)', 'VWo5MKznBwM', false, UserFixtures::USER_SIMBA_REFERENCE],

            ['Vice Versa - Bande-annonce bonus', 'Ppli1jdJ2wE', true, UserFixtures::USER_GOKU_REFERENCE],
            ['Le Roi Lion (2019) - Teaser officiel VF', 'gQVnhLGdS6c', true, UserFixtures::USER_SEIYA_REFERENCE],
            ['Toy Story (1995) - Spot 30 ans du film', 'zSM0HVks_xo', true, UserFixtures::USER_SIMBA_REFERENCE],
            ['Toy Story 2 (1999) - Bande-annonce alternative', '2FlAUxq1MUU', true, UserFixtures::USER_SEIYA_REFERENCE],
            ['Shrek (2001) - Bande-annonce DVD VF', 'q67Dtb7fKmI', true, UserFixtures::USER_SIMBA_REFERENCE],
            ['Le Monde de Narnia (2005) - VOST', 'ICJ52dYwtns', true, UserFixtures::USER_SIMBA_REFERENCE],
            ['Jumanji (1995) - VOST', 'cU5qiliNWBU', true, UserFixtures::USER_GOKU_REFERENCE],
            ['Hook (1991) - VOSTFR', 'pX__DhWO3g4', true, UserFixtures::USER_GOKU_REFERENCE],
            ['Les Goonies (1985) - VOST', 'nZYjDoxeyvo', true, UserFixtures::USER_SEIYA_REFERENCE],
        ];

        foreach ($data as [$title, $youtubeId, $premium, $authorReference]) {
            $video = new Video();
            $video->setTitle($title);
            $video->setVideoLink('https://www.youtube.com/embed/' . $youtubeId);
            $video->setDescription($title);
            $video->setPremiumVideo($premium);
            $video->setAuteur($this->getReference($authorReference, User::class));
            $manager->persist($video);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [UserFixtures::class];
    }
}