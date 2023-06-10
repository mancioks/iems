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

        $entriesCollection = self::createCollectionFromEntries($entries);

        $websites = Website::all();

        foreach ($websites as $website) {
            if (!$website->user || !$website->token) {
                continue;
            }

            try {
                Http::withBasicAuth($website->user, $website->token)
                    ->post($website->url . '/wp-json/api/iems', [
                        'entries' => $entriesCollection
                    ]);
            } catch (\Exception $e) {
                Logger::log('website_error', sprintf('%s (%s)', $e->getMessage(), $website->name));
            }
        }
    }

    public static function createCollectionFromEntries(Collection $entries): Collection
    {
        $entriesCollection = new Collection();

        foreach ($entries as $entry) {
            $item = new Collection();
            $item->put('id', $entry->id);
            $item->put('type', $entry->type);
            $item->put('value', $entry->value);

            $translations = new Collection();

            if ($entry->type !== Entry::TYPE_NUMBER) {
                foreach ($entry->translations as $translation) {
                    $translations->put($translation->language->code, $translation->translation);
                }
            }

            $item->put('translations', $translations);

            $entriesCollection->push($item);
        }

        return $entriesCollection;
    }
}
