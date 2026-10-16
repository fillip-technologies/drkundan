<?php

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

/**
 * Clinic-wide settings and contact details from resources/data/site.json.
 *
 * Every call, WhatsApp, email and booking action on the website reads its
 * value from here. Getters return null when a value is missing, and the CTA
 * components then hide the action instead of showing a placeholder.
 */
class SiteConfig
{
    protected array $data;

    protected ?string $error = null;

    public function __construct(?string $path = null)
    {
        $path ??= resource_path('data/site.json');
        $this->data = JsonFile::read($path, $this->error) ?? [];

        if ($this->error) {
            Log::error("Site config ({$path}): {$this->error}");
        }
    }

    /** Whether an optional site section is switched on in site.json ("features"). Off unless set to true. */
    public function feature(string $name): bool
    {
        return $this->get("features.{$name}") === true;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $value = Arr::get($this->data, $key);

        return $value === null || $value === '' ? $default : $value;
    }

    public function displayName(): string
    {
        return (string) $this->get('displayName', '');
    }

    public function clinicName(): string
    {
        return (string) $this->get('clinicName', $this->displayName());
    }

    public function tagline(): ?string
    {
        return $this->get('tagline');
    }

    public function phoneDisplay(): ?string
    {
        return $this->telUrl() ? $this->get('phone.display', $this->get('phone.number')) : null;
    }

    public function telUrl(): ?string
    {
        $number = preg_replace('/[^\d+]/', '', (string) $this->get('phone.number'));

        return $number ? 'tel:'.$number : null;
    }

    /**
     * WhatsApp click-to-chat link with a generic enquiry message by default.
     * Pass a message only if it contains no personal health details.
     */
    public function whatsappUrl(?string $message = null): ?string
    {
        $number = $this->whatsappNumber();

        if (! $number) {
            return null;
        }

        $message ??= $this->get('whatsapp.message');

        return 'https://wa.me/'.$number.($message ? '?text='.rawurlencode($message) : '');
    }

    public function whatsappNumber(): ?string
    {
        $number = preg_replace('/\D/', '', (string) $this->get('whatsapp.number'));

        return $number ?: null;
    }

    public function email(): ?string
    {
        $email = $this->get('email');

        return is_string($email) && filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : null;
    }

    public function mailtoUrl(): ?string
    {
        return $this->email() ? 'mailto:'.$this->email() : null;
    }

    public function bookingUrl(): ?string
    {
        $url = $this->get('booking.url');

        return is_string($url) ? url($url) : null;
    }

    public function bookingLabel(): string
    {
        return (string) $this->get('booking.label', 'Book Appointment');
    }

    public function emergencyNumber(): ?string
    {
        return $this->get('emergency.number');
    }

    public function emergencyTelUrl(): ?string
    {
        $number = preg_replace('/\D/', '', (string) $this->emergencyNumber());

        return $number ? 'tel:'.$number : null;
    }

    public function emergencyGuidance(): ?string
    {
        return $this->get('emergency.guidance');
    }

    public function address(): ?string
    {
        return $this->get('address.line');
    }

    public function mapUrl(): ?string
    {
        return $this->get('address.mapUrl');
    }

    /** Clinic branches with at least a name. */
    public function branches(): array
    {
        return array_values(array_filter((array) $this->get('branches', []), fn ($branch) => is_array($branch) && ! empty($branch['name'])));
    }

    /** Branch towns as readable text, e.g. "Patna, Ara and Siwan". */
    public function branchCities(): string
    {
        $cities = array_values(array_unique(array_filter(array_column($this->branches(), 'city'))));

        return count($cities) > 1 ? implode(', ', array_slice($cities, 0, -1)).' and '.end($cities) : ($cities[0] ?? '');
    }

    public function doctors(): array
    {
        return array_values(array_filter((array) $this->get('doctors', []), fn ($doctor) => is_array($doctor) && ! empty($doctor['id']) && ! empty($doctor['name'])));
    }

    public function doctor(string $id): ?array
    {
        return Arr::first($this->doctors(), fn ($doctor) => $doctor['id'] === $id);
    }

    /**
     * Settings the website expects but that are missing or invalid.
     */
    public function missing(): array
    {
        $missing = array_keys(array_filter([
            'phone.number' => ! $this->telUrl(),
            'whatsapp.number' => ! $this->whatsappNumber(),
            'email' => ! $this->email(),
            'booking.url' => ! $this->bookingUrl(),
            'emergency.number' => ! $this->emergencyTelUrl(),
            'address.line' => ! $this->address(),
            'branches' => ! $this->branches(),
        ]));

        foreach ($this->doctors() as $doctor) {
            if (empty($doctor['registration'])) {
                $missing[] = "doctors.{$doctor['id']}.registration";
            }
        }

        return $missing;
    }

    /** Notes in site.json ("_review") about values that need confirming. */
    public function reviewNotes(): array
    {
        return array_values(array_filter((array) $this->get('_review', []), 'is_string'));
    }

    public function error(): ?string
    {
        return $this->error;
    }
}
