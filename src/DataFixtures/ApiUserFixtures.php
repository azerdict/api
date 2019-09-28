<?php

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace App\DataFixtures;

use App\Entity\ApiUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ApiUserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new ApiUser();
        $user->setUsername('seferov');
        $user->setApiKey('api_s3cr3t_k3y');

        $manager->persist($user);
        $manager->flush();
    }
}
