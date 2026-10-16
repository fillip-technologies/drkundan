<?php

use App\Support\ServiceCatalog;
use App\Support\SiteConfig;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('services:check', function (ServiceCatalog $catalog, SiteConfig $site) {
    $this->info('Service catalog (resources/data/services)');

    foreach ($catalog->categories() as $category) {
        $entries = $catalog->inCategory($category['id']);
        $published = count(array_filter($entries, fn ($entry) => $entry['isPublished']));
        $this->line(sprintf('  %-18s %2d records, %2d published', $category['label'], count($entries), $published));
    }

    $problems = $catalog->errors();

    foreach ($catalog->all() as $entry) {
        foreach ($entry['doctorIds'] as $doctorId) {
            if (! $site->doctor($doctorId)) {
                $problems[] = "{$entry['id']}: doctorIds refers to unknown doctor \"{$doctorId}\"";
            }
        }
    }

    $this->newLine();
    $this->info('Data problems');
    $problems ? collect($problems)->each(fn ($problem) => $this->error("  {$problem}")) : $this->line('  None');

    $this->newLine();
    $this->info('Unpublished optional services (need clinic confirmation)');
    foreach ($catalog->all() as $entry) {
        if ($entry['optionalService'] && ! $entry['isPublished']) {
            $this->line("  {$entry['title']} ({$entry['id']})");
        }
    }

    $this->newLine();
    $this->info('Content needing clinical or administrative review');
    foreach ($catalog->all() as $entry) {
        foreach ($entry['requiresVerification'] as $note) {
            $this->line("  {$entry['id']}: {$note}");
        }
    }

    $this->newLine();
    $this->info('Site configuration (resources/data/site.json)');
    if ($site->error()) {
        $this->error("  {$site->error()}");
    }
    foreach ($site->missing() as $key) {
        $this->warn("  Missing: {$key}");
    }
    foreach ($site->reviewNotes() as $note) {
        $this->line("  Review: {$note}");
    }

    return $problems || $site->error() ? 1 : 0;
})->purpose('Validate the service JSON data and list items that need clinic confirmation');
