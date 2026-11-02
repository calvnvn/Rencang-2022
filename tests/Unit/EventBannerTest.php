<?php

namespace Tests\Unit;

use App\Support\EventBanner;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\TestCase;

class EventBannerTest extends TestCase
{
    public function test_active_before_the_deadline(): void
    {
        $now = Carbon::parse('2022-02-24 17:59:59');

        $this->assertTrue(EventBanner::isActive('2022-02-24 18:00:00', $now));
    }

    public function test_inactive_at_and_after_the_deadline(): void
    {
        $this->assertFalse(EventBanner::isActive('2022-02-24 18:00:00', Carbon::parse('2022-02-24 18:00:00')));
        $this->assertFalse(EventBanner::isActive('2022-02-24 18:00:00', Carbon::parse('2026-11-02 10:00:00')));
    }

    public function test_inactive_when_the_deadline_is_empty_or_invalid(): void
    {
        $now = Carbon::parse('2022-01-01 00:00:00');

        $this->assertFalse(EventBanner::isActive(null, $now));
        $this->assertFalse(EventBanner::isActive('', $now));
        $this->assertFalse(EventBanner::isActive('bukan tanggal', $now));
        $this->assertFalse(EventBanner::isActive('2022-02-24', $now), 'Jam wajib ditulis');
    }
}
