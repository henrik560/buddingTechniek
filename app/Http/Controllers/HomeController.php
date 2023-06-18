<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @return Response
     */
    public function index()
    {
        return Inertia::render('ContentPage', [
            'title' => 'Home',
        ]);
    }
}
