<?php

namespace App\Services;

use App\Models\Entry;
use App\Models\Website;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class IemsWp
{
    public static function update()
    {
        $entries = Entry::all();

        $entriesCollection = new Collection();

        foreach ($entries as $entry) {
            $item = new Collection();
            $item->put('id', $entry->id);
            $item->put('type', $entry->type);
            $item->put('value', $entry->value);

            $translations = new Collection();

            foreach ($entry->translations as $translation) {
                $translations->put($translation->language->code, $translation->translation);
            }

            $item->put('translations', $translations);

            $entriesCollection->push($item);
        }

        $websites = Website::all();

        foreach ($websites as $website) {
            if (!$website->user || !$website->token) {
                continue;
            }

            Http::withBasicAuth($website->user, $website->token)
                ->post($website->url . '/wp-json/api/iems', [
                    'entries' => $entriesCollection
                ]);
        }
    }
}
