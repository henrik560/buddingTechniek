<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ZonnepanelenController extends Controller
{
    /**
     * Handeling the incomming request.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('ContentPage', [
            'title' => 'Zonnepanelen'
        ]);
    }
}
