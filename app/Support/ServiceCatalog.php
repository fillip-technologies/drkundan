<?php

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

/**
 * Service, condition and patient-resource pages from resources/data/services.
 *
 * catalog.json lists the categories in display order and the file holding
 * each category's records. Records are validated as they load: an invalid
 * record is skipped (or unpublished) and reported, so one bad entry never
 * breaks the rest of the website.
 */
class ServiceCatalog
{
    private const SLUG = '/^[a-z0-9]+(?:-[a-z0-9]+)*$/';

    private const PAGE_TYPES = ['service', 'resource', 'link'];

    private const SECTION_STYLES = ['checklist', 'steps', 'list', 'links', 'alert', 'branches'];

    /** Fields holding a list of plain-text items. */
    private const LIST_FIELDS = [
        'introduction', 'symptomsOrReasons', 'whatToExpect', 'whoMayBenefit', 'preparation',
        'nextSteps', 'relatedServiceIds', 'doctorIds', 'requiresVerification',
    ];

    /** Optional single-line text fields. */
    private const TEXT_FIELDS = [
        'heading', 'icon', 'image', 'menuDescription', 'shortDescription', 'urgentNotice',
        'availabilityNote', 'url', 'seoTitle', 'seoDescription',
    ];

    protected array $categories = [];

    protected array $entries = [];

    protected array $sectionLabels = [];

    protected array $defaults = [];

    protected array $homepage = [];

    protected array $errors = [];

    public function __construct(?string $directory = null)
    {
        $directory ??= resource_path('data/services');
        $catalog = JsonFile::read($directory.'/catalog.json', $error);

        if ($catalog === null) {
            $this->report("catalog.json: {$error}");
        } else {
            $this->load($catalog, $directory);
        }

        foreach ($this->errors as $message) {
            Log::warning("Service catalog: {$message}");
        }
    }

    public function categories(): array
    {
        return $this->categories;
    }

    /** Published entries chosen for the homepage services section ("homepage.featured"). */
    public function featured(): array
    {
        return array_values(array_filter(array_map(
            fn ($id) => ($entry = $this->find((string) $id)) && $entry['isPublished'] ? $entry : null,
            (array) ($this->homepage['featured'] ?? [])
        )));
    }

    /** Categories linked from the homepage services section, with their published entry counts. */
    public function featuredCategories(): array
    {
        return array_values(array_filter(array_map(function ($id) {
            $category = $this->category((string) $id);
            $count = $category ? count($this->inCategory($category['id'], true)) : 0;

            return $count ? $category + ['count' => $count] : null;
        }, (array) ($this->homepage['categories'] ?? []))));
    }

    public function category(string $id): ?array
    {
        return $this->categories[$id] ?? null;
    }

    public function all(): array
    {
        return $this->entries;
    }

    public function find(string $id): ?array
    {
        return $this->entries[$id] ?? null;
    }

    public function inCategory(string $categoryId, bool $publishedOnly = false): array
    {
        return array_values(array_filter(
            $this->entries,
            fn ($entry) => $entry['category'] === $categoryId && (! $publishedOnly || $entry['isPublished'])
        ));
    }

    /**
     * A category's entries split into its groups (e.g. condition categories),
     * or a single unlabelled group when the category has none.
     */
    public function groups(string $categoryId, bool $publishedOnly = false): array
    {
        $entries = $this->inCategory($categoryId, $publishedOnly);
        $groups = $this->categories[$categoryId]['groups'] ?? [];

        if (! $groups) {
            return $entries ? [['id' => null, 'label' => null, 'icon' => null, 'entries' => $entries]] : [];
        }

        return array_values(array_filter(array_map(fn ($group) => $group + [
            'entries' => array_values(array_filter($entries, fn ($entry) => $entry['group'] === $group['id'])),
        ], $groups), fn ($group) => $group['entries']));
    }

    /** The published page at /{path}/{slug}, if there is one. */
    public function findPage(string $path, string $slug): ?array
    {
        return Arr::first($this->entries, fn ($entry) => $entry['isPublished']
            && $entry['pageType'] !== 'link'
            && $entry['slug'] === $slug
            && $this->categories[$entry['category']]['path'] === $path);
    }

    /** URL of a published entry; null while it is unpublished. */
    public function url(array $entry): ?string
    {
        if (! $entry['isPublished']) {
            return null;
        }

        return $entry['pageType'] === 'link'
            ? url($entry['url'])
            : url($this->categories[$entry['category']]['path'].'/'.$entry['slug']);
    }

    /** Published entries listed in relatedServiceIds, in the order given. */
    public function related(array $entry): array
    {
        return array_values(array_filter(array_map(
            fn ($id) => ($related = $this->find($id)) && $related['isPublished'] && $id !== $entry['id'] ? $related : null,
            $entry['relatedServiceIds']
        )));
    }

    /** The entry's own preparation items followed by the shared defaults. */
    public function preparation(array $entry): array
    {
        if (! ($this->categories[$entry['category']]['showPreparation'] ?? true)) {
            return [];
        }

        return array_values(array_unique([...$entry['preparation'], ...$this->list($this->defaults['preparation'] ?? [], 'catalog.json', 'defaults.preparation')]));
    }

    /** Published guide pages linked from an entry's preparation section. */
    public function preparationLinks(array $entry): array
    {
        $ids = $this->categories[$entry['category']]['preparationLinks'] ?? $this->defaults['preparationLinks'] ?? [];

        return array_values(array_filter(array_map(
            fn ($id) => ($page = $this->find((string) $id)) && $page['isPublished'] && $page['id'] !== $entry['id'] ? $page : null,
            (array) $ids
        )));
    }

    public function sectionLabel(array $entry, string $section): string
    {
        return $this->categories[$entry['category']]['sectionLabels'][$section]
            ?? $this->sectionLabels[$section]
            ?? $section;
    }

    public function defaults(string $key, mixed $default = null): mixed
    {
        return Arr::get($this->defaults, $key, $default);
    }

    /** Problems found while loading the data files. */
    public function errors(): array
    {
        return $this->errors;
    }

    protected function load(array $catalog, string $directory): void
    {
        $this->sectionLabels = (array) ($catalog['sectionLabels'] ?? []);
        $this->defaults = (array) ($catalog['defaults'] ?? []);
        $this->homepage = (array) ($catalog['homepage'] ?? []);

        foreach ((array) ($catalog['categories'] ?? []) as $index => $category) {
            if (! is_array($category) || ! is_string($category['id'] ?? null) || ! is_string($category['file'] ?? null)
                || ! is_string($category['label'] ?? null) || ! preg_match(self::SLUG, (string) ($category['path'] ?? ''))) {
                $this->report("catalog.json categories[{$index}]: needs id, label, file and a lowercase path");

                continue;
            }

            $this->categories[$category['id']] = $category + ['groups' => [], 'sectionLabels' => [], 'showPreparation' => true, 'icon' => null, 'description' => null];
        }

        foreach ($this->categories as $category) {
            $records = JsonFile::read($directory.'/'.$category['file'], $error);

            if ($records === null || ! array_is_list($records)) {
                $this->report("{$category['file']}: ".($error ?? 'expected a list of records'));

                continue;
            }

            foreach ($records as $index => $record) {
                if ($entry = $this->normalise($record, $category, "{$category['file']}[{$index}]")) {
                    $this->entries[$entry['id']] = $entry;
                }
            }
        }

        $this->checkReferences();
    }

    protected function normalise(mixed $record, array $category, string $where): ?array
    {
        if (! is_array($record)) {
            return $this->skip($where, 'record must be a JSON object');
        }

        foreach (['id', 'slug', 'title'] as $field) {
            if (! is_string($record[$field] ?? null) || trim($record[$field]) === '') {
                return $this->skip($where, "missing \"{$field}\"");
            }
        }

        $where .= " ({$record['id']})";

        if (! preg_match(self::SLUG, $record['id']) || ! preg_match(self::SLUG, $record['slug'])) {
            return $this->skip($where, 'id and slug must be lowercase words separated by hyphens');
        }

        if (isset($this->entries[$record['id']])) {
            return $this->skip($where, 'duplicate id');
        }

        if (($record['category'] ?? $category['id']) !== $category['id']) {
            return $this->skip($where, "category does not match {$category['file']}");
        }

        foreach ($this->entries as $other) {
            if ($other['slug'] === $record['slug'] && $this->categories[$other['category']]['path'] === $category['path']) {
                return $this->skip($where, "URL /{$category['path']}/{$record['slug']} is already used by \"{$other['id']}\"");
            }
        }

        $entry = [
            'id' => $record['id'],
            'slug' => $record['slug'],
            'title' => trim($record['title']),
            'category' => $category['id'],
            'group' => null,
            'pageType' => in_array($record['pageType'] ?? 'service', self::PAGE_TYPES, true) ? ($record['pageType'] ?? 'service') : 'service',
            'faqs' => $this->faqs($record['faqs'] ?? [], $where),
            'sections' => $this->sections($record['sections'] ?? [], $where),
            'isPublished' => ($record['isPublished'] ?? false) === true,
            'optionalService' => ($record['optionalService'] ?? false) === true,
        ];

        foreach (self::TEXT_FIELDS as $field) {
            $entry[$field] = is_string($record[$field] ?? null) && trim($record[$field]) !== '' ? trim($record[$field]) : null;
        }

        foreach (self::LIST_FIELDS as $field) {
            $entry[$field] = $this->list($record[$field] ?? [], $where, $field);
        }

        $entry['heading'] ??= $entry['title'];
        $entry['icon'] ??= $category['icon'];
        $entry['seoTitle'] ??= $entry['heading'];
        $entry['seoDescription'] ??= $entry['shortDescription'];

        if ($category['groups']) {
            if (in_array($record['group'] ?? null, array_column($category['groups'], 'id'), true)) {
                $entry['group'] = $record['group'];
            } else {
                return $this->skip($where, 'unknown or missing "group"');
            }
        }

        if ($entry['isPublished'] && ($problem = $this->publishingProblem($entry))) {
            $this->report("{$where}: not published because {$problem}");
            $entry['isPublished'] = false;
        }

        return $entry;
    }

    /** Why a record marked as published cannot be shown, if anything. */
    protected function publishingProblem(array $entry): ?string
    {
        if (! $entry['shortDescription']) {
            return 'it has no shortDescription';
        }

        return match ($entry['pageType']) {
            'link' => $entry['url'] && (str_starts_with($entry['url'], '/') || str_starts_with($entry['url'], 'https://')) ? null : 'it has no valid url',
            'resource' => $entry['introduction'] && $entry['sections'] ? null : 'it needs an introduction and at least one section',
            default => $entry['introduction'] && ($entry['symptomsOrReasons'] || $entry['whatToExpect']) ? null : 'it needs an introduction and symptomsOrReasons or whatToExpect',
        };
    }

    protected function checkReferences(): void
    {
        foreach ($this->entries as $entry) {
            foreach ($entry['relatedServiceIds'] as $id) {
                if (! isset($this->entries[$id])) {
                    $this->report("{$entry['id']}: relatedServiceIds refers to unknown id \"{$id}\"");
                }
            }

            foreach ($entry['sections'] as $section) {
                foreach ($section['items'] as $item) {
                    if ($item['serviceId'] && ! isset($this->entries[$item['serviceId']])) {
                        $this->report("{$entry['id']}: section \"{$section['heading']}\" refers to unknown id \"{$item['serviceId']}\"");
                    }
                }
            }
        }
    }

    protected function list(mixed $value, string $where, string $field): array
    {
        if (! is_array($value)) {
            $this->report("{$where}: \"{$field}\" must be a list");

            return [];
        }

        $items = array_values(array_filter(array_map(fn ($item) => is_string($item) ? trim($item) : null, $value), fn ($item) => $item !== null && $item !== ''));

        if (count($items) !== count($value)) {
            $this->report("{$where}: \"{$field}\" contains items that are not text");
        }

        return $items;
    }

    protected function faqs(mixed $value, string $where): array
    {
        if (! is_array($value)) {
            $this->report("{$where}: \"faqs\" must be a list");

            return [];
        }

        $faqs = [];

        foreach ($value as $index => $faq) {
            if (is_string($faq['question'] ?? null) && is_string($faq['answer'] ?? null) && trim($faq['question']) !== '' && trim($faq['answer']) !== '') {
                $faqs[] = ['question' => trim($faq['question']), 'answer' => trim($faq['answer'])];
            } else {
                $this->report("{$where}: faqs[{$index}] needs a question and an answer");
            }
        }

        return $faqs;
    }

    protected function sections(mixed $value, string $where): array
    {
        if (! is_array($value)) {
            $this->report("{$where}: \"sections\" must be a list");

            return [];
        }

        $sections = [];

        foreach ($value as $index => $section) {
            $style = $section['style'] ?? 'list';

            if (! is_string($section['heading'] ?? null) || ! in_array($style, self::SECTION_STYLES, true)) {
                $this->report("{$where}: sections[{$index}] needs a heading and a style of ".implode(', ', self::SECTION_STYLES));

                continue;
            }

            $items = [];

            foreach ((array) ($section['items'] ?? []) as $item) {
                if (is_string($item) && trim($item) !== '') {
                    $items[] = ['text' => trim($item), 'serviceId' => null];
                } elseif (is_string($item['text'] ?? null) && trim($item['text']) !== '') {
                    $items[] = ['text' => trim($item['text']), 'serviceId' => is_string($item['serviceId'] ?? null) ? $item['serviceId'] : null];
                } else {
                    $this->report("{$where}: sections[{$index}] has an item without text");
                }
            }

            if (! $items && $style !== 'branches') {
                $this->report("{$where}: sections[{$index}] has no items");

                continue;
            }

            $sections[] = [
                'heading' => trim($section['heading']),
                'style' => $style,
                'intro' => is_string($section['intro'] ?? null) ? trim($section['intro']) : null,
                'items' => $items,
            ];
        }

        return $sections;
    }

    protected function skip(string $where, string $problem): null
    {
        $this->report("{$where}: skipped, {$problem}");

        return null;
    }

    protected function report(string $message): void
    {
        $this->errors[] = $message;
    }
}
