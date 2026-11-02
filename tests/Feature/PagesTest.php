<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PagesTest extends TestCase
{
    /**
     * Semua halaman publik beserta judul <title> yang diharapkan.
     * Tambahkan baris di sini setiap kali menambah halaman baru.
     *
     * @return array<string, array{string, string}>
     */
    public static function pages(): array
    {
        return [
            'beranda' => ['/', 'Rencang'],
            'what we do' => ['/what-we-do', 'Rencang - What We Do'],
            'who we are' => ['/who-we-are', 'Rencang - Who We Are'],
            'event' => ['/event', 'Rencang - Event'],
            'gedurasi' => ['/gedurasi', 'Rencang - Gedurasi'],
            'sentera' => ['/sentera', 'Rencang - Sentera'],
            'sharing caring helping' => ['/sharing-caring-helping', 'Rencang - SCH'],
            'rencang cepat tanggap' => ['/rencang-cepat-tanggap', 'Rencang - RCT'],
            'keakraban' => ['/keakraban', 'Rencang - Keakraban'],
            'coming soon' => ['/soon', 'Coming Soon'],
        ];
    }

    #[DataProvider('pages')]
    public function test_public_page_renders_with_its_title(string $url, string $title): void
    {
        $this->get($url)
            ->assertOk()
            ->assertSee("<title>{$title}</title>", false);
    }

    #[DataProvider('pages')]
    public function test_every_local_asset_referenced_by_a_page_exists(string $url): void
    {
        $html = $this->get($url)->getContent();
        $base = rtrim(url('/'), '/');

        preg_match_all('/(?:src|href)="([^"]+\.(?:css|js|png|jpe?g|gif|svg|webp|ico))"/i', $html, $matches);

        $missing = collect($matches[1])
            ->filter(fn (string $ref) => str_starts_with($ref, $base))
            ->map(fn (string $ref) => rawurldecode(substr($ref, strlen($base))))
            ->unique()
            ->reject(fn (string $path) => is_file(public_path($path)))
            ->values()
            ->all();

        $this->assertSame([], $missing, "Aset tidak ditemukan di halaman {$url}");
    }

    public function test_unknown_url_shows_the_404_page(): void
    {
        $this->get('/halaman-yang-tidak-ada')
            ->assertNotFound()
            ->assertSee('Halaman tidak ditemukan');
    }

    public function test_unused_endpoints_from_the_old_app_are_gone(): void
    {
        $this->getJson('/api/user')->assertNotFound();
        $this->get('/up')->assertNotFound();
    }

    public function test_event_banner_is_shown_before_its_deadline(): void
    {
        config(['rencang.event_banner.ends_at' => now()->addDay()->format('Y-m-d H:i:s')]);

        $this->get('/')
            ->assertOk()
            ->assertSee('id="register-btn"', false);
    }

    public function test_event_banner_is_hidden_after_its_deadline(): void
    {
        config(['rencang.event_banner.ends_at' => now()->subMinute()->format('Y-m-d H:i:s')]);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('id="register-btn"', false);
    }

    public function test_footer_shows_the_current_year(): void
    {
        $this->get('/')->assertSee('&copy; '.now()->year.' Rencang Aye UMN', false);
    }
}
