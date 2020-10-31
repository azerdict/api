<?php

namespace App\Dictionary;

use App\Repository\Dictionary\EnglishAzerbaijaniRepository;
use Symfony\Contracts\Translation\TranslatorInterface;

class EnglishAzerbaijani implements DictionaryInterface
{
    private $repository;
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(
        EnglishAzerbaijaniRepository $englishAzerbaijaniRepository,
        TranslatorInterface $translator
    ) {
        $this->repository = $englishAzerbaijaniRepository;
        $this->translator = $translator;
    }

    public function search(string $term): Result
    {
        $dbResult = $this->repository->search($term);
        $result = new Result();

        foreach ($dbResult as $item) {
            $name = false !== mb_strpos($item['english'], $term) ? 'english_azerbaijani' : 'azerbaijani_english';
            $item['terminology'] = $this->translator->trans('terminology.'.$item['terminology']);
            $item['partOfSpeech'] = $this->translator->trans('pos.'.$item['partOfSpeech']);
            $result->addData($name, $item);
        }

        return $result;
    }
}
