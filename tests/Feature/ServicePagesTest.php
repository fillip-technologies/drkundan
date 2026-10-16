<?php

namespace Tests\Feature;

use App\Support\ServiceCatalog;
use App\Support\SiteConfig;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ServicePagesTest extends TestCase
{
    public function test_service_data_has_no_validation_problems(): void
    {
        $this->assertSame([], app(ServiceCatalog::class)->errors());
        $this->assertNull(app(SiteConfig::class)->error());
    }

    public function test_master_page_lists_every_published_entry_and_hides_unconfirmed_services(): void
    {
        $catalog = app(ServiceCatalog::class);
        $response = $this->get('/services')->assertOk();

        foreach ($catalog->all() as $entry) {
            if ($entry['isPublished']) {
                $response->assertSee($catalog->url($entry), false);
            } elseif ($entry['optionalService']) {
                $response->assertDontSee('>'.$entry['title'].'<', false);
            }
        }
    }

    public function test_every_published_page_renders_with_unique_seo_metadata(): void
    {
        $catalog = app(ServiceCatalog::class);
        $site = app(SiteConfig::class);
        $titles = [];

        foreach ($catalog->all() as $entry) {
            if (! $entry['isPublished'] || $entry['pageType'] === 'link') {
                continue;
            }

            $html = $this->get($catalog->url($entry))->assertOk()
                ->assertSee('<h1', false)
                ->assertSee(e($entry['heading']), false)
                ->assertSee('<meta name="description" content="'.e($entry['seoDescription']).'">', false)
                ->assertSee('href="'.$site->bookingUrl().'"', false)
                ->assertSee('href="'.$site->telUrl().'"', false)
                ->assertSee('href="'.e($site->whatsappUrl()).'"', false)
                ->getContent();

            $this->assertSame(1, substr_count($html, '<h1'), "{$entry['id']} should have one main heading");
            preg_match('/<title>(.*?)<\/title>/s', $html, $title);
            $titles[$entry['id']] = trim($title[1]);
        }

        $this->assertGreaterThan(40, count($titles));
        $this->assertSame(count($titles), count(array_unique($titles)), 'Page titles must be unique');
    }

    public function test_unpublished_and_unknown_pages_return_404(): void
    {
        $this->get('/services/video-eeg')->assertNotFound();
        $this->get('/services/pediatric-neurology')->assertNotFound();
        $this->get('/patient-resources/health-library')->assertNotFound();
        $this->get('/conditions/eeg')->assertNotFound();
        $this->get('/services/does-not-exist')->assertNotFound();
    }

    public function test_existing_pages_still_work(): void
    {
        foreach (['/', '/about', '/clinics', '/contact', '/services/orthopedics', '/services/general-surgery'] as $path) {
            $this->get($path)->assertOk();
        }

        $this->get('/conditions')->assertRedirect('/services#conditions');
    }

    public function test_related_services_only_link_to_published_pages(): void
    {
        $catalog = app(ServiceCatalog::class);

        $related = array_column($catalog->related($catalog->find('eeg')), 'id');

        $this->assertNotContains('video-eeg', $related);
        $this->assertContains('epilepsy-clinic', $related);
    }

    public function test_cta_buttons_read_central_config_and_hide_when_values_are_missing(): void
    {
        $path = $this->tempJson('site.json', [
            'displayName' => 'Test Clinic',
            'phone' => ['number' => '+91 11111 22222', 'display' => '+91 11111 22222'],
            'booking' => ['url' => '/contact#book-appointment'],
        ]);
        $this->app->instance(SiteConfig::class, new SiteConfig($path));

        $this->assertStringContainsString('href="tel:+911111122222"', Blade::render('<x-cta.call-clinic />'));
        $this->assertStringContainsString('/contact#book-appointment', Blade::render('<x-cta.book-appointment />'));
        $this->assertSame('', trim(Blade::render('<x-cta.whatsapp-clinic />')));
        $this->assertSame('', trim(Blade::render('<x-cta.email-clinic />')));
        $this->assertContains('whatsapp.number', app(SiteConfig::class)->missing());
    }

    public function test_testimonials_are_hidden_unless_switched_on(): void
    {
        $this->get('/')->assertOk()->assertDontSee('What Our Patients Say');

        $path = $this->tempJson('site.json', ['displayName' => 'Test Clinic', 'features' => ['testimonials' => true]]);
        $this->app->instance(SiteConfig::class, new SiteConfig($path));

        $this->get('/')->assertOk()->assertSee('What Our Patients Say');
    }

    public function test_invalid_records_are_skipped_without_breaking_the_catalog(): void
    {
        $directory = sys_get_temp_dir().'/catalog-test-'.uniqid();
        File::ensureDirectoryExists($directory);
        File::put($directory.'/catalog.json', json_encode(['categories' => [
            ['id' => 'specialities', 'label' => 'Specialities', 'file' => 'specialities.json', 'path' => 'services'],
            ['id' => 'diagnostics', 'label' => 'Diagnostics', 'file' => 'broken.json', 'path' => 'services'],
        ]]));
        File::put($directory.'/broken.json', '{ not valid json');
        File::put($directory.'/specialities.json', json_encode([
            ['id' => 'good', 'slug' => 'good', 'title' => 'Good', 'shortDescription' => 'Fine.', 'introduction' => ['Intro.'], 'whatToExpect' => ['Step.'], 'isPublished' => true],
            ['id' => 'Bad Id', 'slug' => 'bad', 'title' => 'Bad'],
            ['id' => 'empty', 'slug' => 'empty', 'title' => 'Empty page', 'isPublished' => true],
            'not an object',
        ]));

        $catalog = new ServiceCatalog($directory);
        File::deleteDirectory($directory);

        $this->assertTrue($catalog->find('good')['isPublished']);
        $this->assertNull($catalog->find('Bad Id'));
        $this->assertFalse($catalog->find('empty')['isPublished'], 'Pages without content must not be published');
        $this->assertCount(4, $catalog->errors());
    }

    public function test_missing_catalog_file_does_not_take_the_site_down(): void
    {
        $this->app->instance(ServiceCatalog::class, new ServiceCatalog(sys_get_temp_dir().'/no-such-catalog'));

        $this->get('/services')->assertOk();
        $this->get('/')->assertOk();
        $this->get('/services/eeg')->assertNotFound();
    }

    private function tempJson(string $name, array $data): string
    {
        $path = sys_get_temp_dir().'/'.uniqid().'-'.$name;
        File::put($path, json_encode($data));
        $this->beforeApplicationDestroyed(fn () => File::delete($path));

        return $path;
    }
}
