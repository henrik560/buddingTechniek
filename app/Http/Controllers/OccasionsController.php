<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Statamic\Facades\Collection;

class OccasionsController extends Controller
{
    /**
     * Handle an incoming request.
     * 
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('ContentPage', [
            'title' => 'Occasions'
        ]);
    }

    /**
     * Handle an incoming request.
     *
     * @param  string  $slug
     * @return \Inertia\Response
     */
    function show(string $slug): Response
    {
        $vehicle = collect(Collection::findByHandle("vehicles")->queryEntries()->where('slug', $slug)->get())->first();

        return Inertia::render('VehiclePage', [
            'vehicle' => $vehicle
        ]);
    }
}
