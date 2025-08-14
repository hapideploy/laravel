<?php

use App\Models\Quote;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('inspire')->everyFiveMinutes();

Artisan::command('inspire', function () {
    $content = Inspiring::quotes()->random();

    Quote::create([
        'content' => $content,
        'actor' => 'scheduler',
    ]);

    $this->comment($content);

    // $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
