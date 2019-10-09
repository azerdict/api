<?php

namespace App\Dictionary;

use App\Repository\Dictionary\EnglishAzerbaijaniRepository;

class EnglishAzerbaijani implements DictionaryInterface
{
    private $repository;

    public function __construct(EnglishAzerbaijaniRepository $englishAzerbaijaniRepository)
    {
        $this->repository = $englishAzerbaijaniRepository;
    }

    public function search(string $term): Result
    {
        $dbResult = $this->repository->search($term);
        $result = new Result();

        foreach ($dbResult as $item) {
            $name = false !== mb_strpos($item['english'], $term) ? 'english_azerbaijani' : 'azerbaijani_english';

            $result->addData($name, $item);
        }

        return $result;
    }
}
