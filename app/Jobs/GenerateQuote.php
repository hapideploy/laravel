<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Inspiring;
use Illuminate\Foundation\Queue\Queueable;

class GenerateQuote implements ShouldQueue
{
    use Queueable;

    public function __construct(protected \App\Models\User $user) {}

    public function handle(): void
    {
        $content = Inspiring::quotes()->random();

        $this->user->quotes()->create([
            'content' => $content,
            'actor' => 'job',
        ]);
    }
}
