<?php

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace App\DataFixtures;

use App\Entity\Dictionary\EnglishAzerbaijani;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EnglishAzerbaijaniFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $words = json_decode(file_get_contents(__DIR__.'/Data/EnglishAzerbaijani.json'));

        foreach ($words as $word) {
            $englishAzerbaijani = new EnglishAzerbaijani($word->english, $word->azerbaijani, $word->terminology, $word->partOfSpeech);
            $englishAzerbaijani->setMeaning($word->meaning);
            $englishAzerbaijani->setExplanation($word->explanation);
            $englishAzerbaijani->setTranscription($word->transcription);

            $manager->persist($englishAzerbaijani);
        }

        $manager->flush();
    }
}
