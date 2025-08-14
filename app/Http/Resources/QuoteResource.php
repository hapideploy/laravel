<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class QuoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\Quote $quote */
        $quote = $this->resource;

        $content = $quote->content;

        $pos = strrpos($content, '-');

        $message = substr($content, 0, $pos - 1);
        $who = substr($content, $pos + 2);

        $actor = Str::ucfirst($quote->actor);

        return [
            'id' => $quote->id,
            'message' => $message,
            'who' => $who,
            'actor' => $actor,
            'createdAt' => $quote->created_at->format('D, M jS Y g:ia e'),
        ];
    }
}
