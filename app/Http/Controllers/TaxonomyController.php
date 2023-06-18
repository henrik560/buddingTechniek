<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Statamic\Facades\Taxonomy;

class TaxonomyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $handle): JsonResponse
    {
        $taxonomy = Taxonomy::findByHandle($handle);

        if (! $taxonomy) {
            return response()->json(['error' => 'Taxonomy not found'], 404);
        }

        // Find all terms within the taxonomy
        $terms = $taxonomy->queryTerms()->get(['title', 'tag_icon', 'id']);

        return response()->json([
            'taxonomy' => $terms,
        ]);
    }
}
