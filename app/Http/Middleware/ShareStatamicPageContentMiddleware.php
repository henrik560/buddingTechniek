<?php

namespace App\Http\Middleware;

use App\Services\ContentPageService;
use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShareStatamicPageContentMiddleware
{
    protected $contentPageService;

    public function __construct(ContentPageService $contentPageService)
    {
        $this->contentPageService = $contentPageService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  \App\Services\ContentPageService  $contentPageService
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //* Add content blocks from statamic to vue pages as inertia prop
        Inertia::share([
            'content' => $this->contentPageService->getContent($request),
        ]);

        return $next($request);
    }
}
