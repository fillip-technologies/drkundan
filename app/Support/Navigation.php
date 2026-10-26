<?php

namespace App\Support;

/**
 * Builds the header and footer menus from config/navigation.php.
 *
 * Menus with a 'category' list that category's entries from the service
 * catalog, so labels, descriptions, icons, links and publishing state come
 * from the same JSON as the pages. Contact actions read site.json.
 */
class Navigation
{
    protected array $menus = [];

    protected ?array $currentEntry;

    public function __construct(protected ServiceCatalog $catalog, protected SiteConfig $site)
    {
        $section = request()->route()?->parameter('section');
        $slug = request()->route()?->parameter('slug');
        $this->currentEntry = is_string($section) && is_string($slug) ? $catalog->findPage($section, $slug) : null;
    }

    /** Top-level header links, in display order. */
    public function main(): array
    {
        return array_map(function (array $link) {
            if (isset($link['menu'])) {
                $menu = config("navigation.menus.{$link['menu']}", []);
                $link['active'] = (isset($link['active']) && request()->is(...(array) $link['active']))
                    || (isset($menu['category']) && $this->currentEntry && $this->currentEntry['category'] === $menu['category']);
            } else {
                $link['href'] = url($link['url']);
                $link['active'] = $this->isCurrent($link['href']);
            }

            return $link;
        }, config('navigation.main', []));
    }

    /** Resolved menus used by the header, keyed by menu name. */
    public function menus(): array
    {
        return array_map(fn ($key) => $this->menu($key), array_column(config('navigation.main', []), 'menu', 'menu'));
    }

    public function menu(string $key): ?array
    {
        if (! array_key_exists($key, $this->menus)) {
            $config = config("navigation.menus.{$key}");
            $this->menus[$key] = is_array($config) ? $this->resolve($config) : null;
        }

        return $this->menus[$key];
    }

    /** All items of a menu in order, without group headings (used by the footer). */
    public function items(string $key): array
    {
        return array_merge([], ...array_column($this->menu($key)['groups'] ?? [], 'items'));
    }

    protected function resolve(array $menu): array
    {
        $groups = [];

        if (isset($menu['category'])) {
            $categoryGroups = $this->catalog->groups($menu['category']);
            $priority = array_flip($menu['priority'] ?? []);

            foreach ($categoryGroups as $group) {
                if ($priority) {
                    usort($group['entries'], fn ($a, $b) => ($priority[$a['id']] ?? PHP_INT_MAX) <=> ($priority[$b['id']] ?? PHP_INT_MAX));
                }

                $items = array_values(array_filter(array_map(fn ($entry) => $this->entryItem($entry), $group['entries'])));

                if (($menu['itemIcons'] ?? true) === false) {
                    $items = array_map(fn ($item) => array_replace($item, ['icon' => null]), $items);
                }

                if ($items) {
                    $groups[] = ['heading' => $group['label'], 'icon' => $group['icon'], 'items' => $items];
                }
            }
        } else {
            foreach ($menu['groups'] ?? [] as $group) {
                $items = array_values(array_filter(array_map(fn ($item) => $this->configItem($item), $group['items'] ?? [])));

                if ($items) {
                    $groups[] = ['heading' => $group['heading'] ?? null, 'icon' => $group['icon'] ?? null, 'items' => $items];
                }
            }
        }

        $columns = $menu['columns'] ?? max(1, count($groups));
        $flat = count($groups) === 1 && ! $groups[0]['heading'];

        return [
            'type' => $menu['type'] ?? 'mega',
            'align' => $menu['align'] ?? 'left',
            'groups' => $groups,
            'profile' => $this->profile($menu['profile'] ?? null),
            'gridClass' => [1 => 'grid-cols-1', 2 => 'grid-cols-2', 3 => 'grid-cols-3', 4 => 'grid-cols-4', 5 => 'grid-cols-5'][min(5, $columns)],
            // Ungrouped lists flow down each column first, so reading order matches the source order.
            'rows' => $flat ? 'grid-rows-[repeat('.(int) ceil(count($groups[0]['items']) / $columns).',auto)]' : null,
        ];
    }

    /** A catalog entry as a menu item; hidden while it is an unconfirmed optional service. */
    protected function entryItem(array $entry): ?array
    {
        if ($entry['optionalService'] && ! $entry['isPublished']) {
            return null;
        }

        $href = $this->catalog->url($entry);

        return [
            'label' => $entry['title'],
            'description' => $entry['menuDescription'],
            'icon' => $entry['icon'],
            'href' => $href,
            'current' => $href && $this->isCurrent($href),
        ];
    }

    /** An item defined in config/navigation.php. */
    protected function configItem(array $item): ?array
    {
        if (isset($item['optional']) && ! config("navigation.optional_items.{$item['optional']}")) {
            return null;
        }

        $href = match ($item['action'] ?? null) {
            'call' => $this->site->telUrl(),
            'whatsapp' => $this->site->whatsappUrl(),
            'email' => $this->site->mailtoUrl(),
            default => isset($item['url']) ? url($item['url']) : null,
        };

        // A contact action is hidden rather than shown without a working link.
        if (isset($item['action']) && ! $href) {
            return null;
        }

        return [
            'label' => $item['label'],
            'description' => $item['description'] ?? null,
            'icon' => $item['icon'] ?? null,
            'href' => $href,
            'current' => $href && $this->isCurrent($href),
        ];
    }

    protected function profile(?array $profile): ?array
    {
        $doctor = $profile ? $this->site->doctor($profile['doctor'] ?? '') : null;

        if (! $doctor) {
            return null;
        }

        return [
            'name' => $doctor['name'],
            'role' => $doctor['role'] ?? null,
            'image' => $doctor['image'] ?? null,
            'url' => isset($doctor['profileUrl']) ? url($doctor['profileUrl']) : null,
            'items' => array_values(array_filter(array_map(fn ($item) => $this->configItem($item), $profile['items'] ?? []))),
        ];
    }

    /** Whether $url is the current page (links to a section of a page are not). */
    protected function isCurrent(string $url): bool
    {
        if (parse_url($url, PHP_URL_FRAGMENT) || ! str_starts_with($url, url('/'))) {
            return false;
        }

        return rtrim((string) parse_url($url, PHP_URL_PATH), '/') === rtrim('/'.request()->path(), '/');
    }
}
