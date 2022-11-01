<?php

namespace App\Services;

use App\Models\Entry;
use App\Models\Website;
use Illuminate\Support\Facades\Http;

class IemsWp
{
    public static function update()
    {
        $entries = Entry::all();
        $websites = Website::all();

        foreach ($websites as $website) {
            if (!$website->user || !$website->token) {
                continue;
            }

            Http::withBasicAuth($website->user, $website->token)
                ->post($website->url . '/wp-json/api/iems', [
                    'entries' => $entries
                ]);
        }
    }
}
