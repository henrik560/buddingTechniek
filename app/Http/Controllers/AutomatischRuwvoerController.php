<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class AutomatischRuwvoerController extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @return Response
     */
    function index(): Response
    {
        return Inertia::render('ContentPage', [
            'title' => 'Automatisch Ruwvoer'
        ]);
    }
}
