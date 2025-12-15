<?php

if (! function_exists('money')) {
    function money($amount)
    {
        $currency = auth()->user()->currency ?? 'IDR';

        return match ($currency) {
            'IDR' => 'Rp ' . number_format($amount, 0, ',', '.'),
            'USD' => '$' . number_format($amount, 2),
            'EUR' => '€' . number_format($amount, 2),
            'JPY' => '¥' . number_format($amount, 0),
            default => number_format($amount, 2),
        };
    }
}
