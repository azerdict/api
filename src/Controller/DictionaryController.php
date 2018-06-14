<?php

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace App\Controller;

use App\Entity\Dictionary\EnglishAzerbaijani;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DictionaryController is designed to handle all dictionary searches.
 */
class DictionaryController extends Controller
{
    /**
     * @Route("/english", name="english")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function english(Request $request)
    {
        $result = $this->getDoctrine()
            ->getRepository(EnglishAzerbaijani::class)
            ->search($request->query->get('term'));

        $statusCode = empty($result) ? JsonResponse::HTTP_NOT_FOUND : JsonResponse::HTTP_OK;

        return $this->json($result, $statusCode);
    }
}
