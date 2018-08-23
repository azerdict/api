<?php

namespace App\Dictionary;

interface DictionaryInterface
{
    public function search(string $term) : Result;
}
