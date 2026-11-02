<?php

namespace App\Support;

use Illuminate\Support\Carbon;

class EventBanner
{
    /**
     * Format batas waktu yang diterima, misalnya "2026-12-01 23:59:00".
     */
    public const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * Banner tampil selama waktu sekarang belum melewati batas akhirnya.
     * Batas kosong atau tidak sesuai DATE_FORMAT dianggap banner tidak aktif.
     *
     * Waktu dibaca dalam zona waktu default PHP, yang oleh Laravel
     * disamakan dengan config app.timezone (Asia/Jakarta).
     */
    public static function isActive(?string $endsAt, ?Carbon $now = null): bool
    {
        if ($endsAt === null || trim($endsAt) === '') {
            return false;
        }

        try {
            $deadline = Carbon::createFromFormat(self::DATE_FORMAT, $endsAt);
        } catch (\Throwable) {
            return false;
        }

        return ($now ?? Carbon::now())->lt($deadline);
    }
}
