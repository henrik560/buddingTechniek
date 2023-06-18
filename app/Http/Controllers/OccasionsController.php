<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Statamic\Facades\Collection;

class OccasionsController extends Controller
{
    /**
     * Handle an incoming request.
     */
    public function index(): Response
    {
        return Inertia::render('ContentPage', [
            'title' => 'Occasions',
        ]);
    }

    /**
     * Handle an incoming request.
     */
    public function show(string $slug): Response
    {
        $vehicle = collect(Collection::findByHandle('vehicles')->queryEntries()->where('slug', $slug)->get())->first();

        abort_if(! $vehicle, 404, __('validation.vehicle_not_found'));

        return Inertia::render('VehiclePage', [
            'vehicle' => $vehicle,
        ]);
    }
}
