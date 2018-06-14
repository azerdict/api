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
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $words = json_decode(file_get_contents(__DIR__.'/Data/EnglishAzerbaijani.json'));

        foreach ($words as $word) {
            $englishAzerbaijani = new EnglishAzerbaijani();
            $englishAzerbaijani->setEnglish($word->english);
            $englishAzerbaijani->setAzerbaijani($word->azerbaijani);
            $englishAzerbaijani->setTerminology($word->terminology);
            $englishAzerbaijani->setPartOfSpeech($word->partOfSpeech);
            $englishAzerbaijani->setMeaning($word->meaning);
            $englishAzerbaijani->setSource($word->source);
            $englishAzerbaijani->setExplanation($word->explanation);
            $englishAzerbaijani->setTranscription($word->transcription);

            $manager->persist($englishAzerbaijani);
        }

        $manager->flush();
    }
}
