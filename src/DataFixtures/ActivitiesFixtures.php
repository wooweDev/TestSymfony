<?php

namespace App\DataFixtures;

use App\Entity\Activities;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActivitiesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
            for ($i = 1; $i <= 10; $i++) {
                $activity = new Activities();
                $activity->setTitle('Activity ' . $i);
                $activity->setStartDate(new \DateTime('2024-09-01'));
                $activity->setEndDate(new \DateTime('2024-09-10'));
                $activity->setMinimumAge(18);
                $activity->setParticipantLimit(50);

                $manager->persist($activity);

            $manager->flush();
        }
    }
}
