<?php

namespace App\Services;

use Illuminate\Http\Request;
use Statamic\Entries\Entry;
use Statamic\Facades\Collection;

class ContentPageService
{
    public function getContent(Request $request): Entry|null
    {
        /** @var Collection|null $entry */
        return collect(Collection::findByHandle('pages')->queryEntries()->where('slug', $request->route()->getName())->with('content_blocks')->get())->first();
    }
}
