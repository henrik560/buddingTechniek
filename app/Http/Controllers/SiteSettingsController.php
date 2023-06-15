<?php

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Statamic\Facades\GlobalSet;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SiteSettingsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $handle
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(?string $handle): JsonResponse
    {
        if (is_null($handle)) {
            throw new HttpException(404, 'Please provide a global set handler');
        }

        /** @var GlobalSet|null $globals */
        $globals = GlobalSet::findByHandle($handle)->fileData();

        if (!$globals) {
            throw new HttpException(404, 'Global set handler not found!');
        }

        return response()->json([
            'globals' => $globals
        ]);
    }
}
