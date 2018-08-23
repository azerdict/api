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

    public function search(string $term)
    {
        return $this->repository->search($term);
    }
}
