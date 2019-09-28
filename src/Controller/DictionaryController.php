<?php

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace App\Controller;

use App\Dictionary\DictionaryInterface;
use App\Dictionary\EnglishAzerbaijani;
use Symfony\Component\HttpFoundation\{JsonResponse,Request};
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dictionary")
 *
 * Class DictionaryController is designed to handle all dictionary searches.
 */
class DictionaryController extends BaseController
{
    /**
     * @Route("/english-azerbaijani", name="english")
     */
    public function english(Request $request, EnglishAzerbaijani $dictionary) : JsonResponse
    {
        if (!$request->query->has('term')) {
            return $this->errors([
                'term' => 'required',
            ]);
        }

        $result = $dictionary->search($request->query->get('term'));

        $statusCode = $result->hasResult() ? JsonResponse::HTTP_OK : JsonResponse::HTTP_NOT_FOUND;

        return $this->json($result->getResult(), $statusCode);
    }
}
