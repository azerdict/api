<?php

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseController extends Controller
{
    protected function errors(iterable $errors) : JsonResponse
    {
        return $this->json([
            'errors' => $errors,
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}
