<?php

namespace App\Http\Controllers;

use App\Support\ServiceCatalog;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Master page listing every published service, condition and patient resource.
     */
    public function index(ServiceCatalog $catalog): View
    {
        return view('services.index', ['catalog' => $catalog]);
    }

    /**
     * A single page from the service catalog, e.g. /services/eeg or /conditions/stroke.
     */
    public function show(ServiceCatalog $catalog, string $section, string $slug): View
    {
        $entry = $catalog->findPage($section, $slug);

        abort_unless($entry, 404);

        return view('services.show', [
            'catalog' => $catalog,
            'entry' => $entry,
            'category' => $catalog->category($entry['category']),
        ]);
    }
}
