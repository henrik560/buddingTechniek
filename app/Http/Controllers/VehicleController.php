<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Statamic\Facades\Collection;

class VehicleController extends Controller
{
    /**
     * Handle an incoming request.
     */
    public function index(): JsonResponse
    {
        try {
            /** @var Collection|null $vehicles */
            $vehicles = Collection::findByHandle('vehicles')
                ->queryEntries()
                ->get();

            return response()->json([
                'vehicles' => $vehicles,
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Er is iets fout gegaan: '.$e->getMessage()], 422);
        }
    }

    /**
     * Handle an incoming request.
     */
    public function getRecentVehicles(): JsonResponse
    {
        try {
            /** @var Collection|null $vehicles */
            $vehicles = Collection::findByHandle('vehicles')
                ->queryEntries()
                ->orderBy('date', 'desc')
                ->limit(4)
                ->get();

            return response()->json([
                'vehicles' => $vehicles,
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Er is iets fout gegaan: '.$e->getMessage()], 422);
        }
    }
}
