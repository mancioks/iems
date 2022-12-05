<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntryRequest;
use App\Http\Requests\UpdateEntryRequest;
use App\Models\Entry;
use App\Services\IemsWp;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index()
    {
        //
    }

    public function create($type = 'text')
    {
        $languages = \App\Models\Language::all();
        $types = Entry::TYPES;

        if (!array_key_exists($type, $types)) {
            return abort(404);
        }

        return view('entry.create', compact('languages', 'type', 'types'));
    }

    public function store(StoreEntryRequest $request)
    {
        $entry = Entry::query()->create($request->validated() + ['type' => Entry::TYPE_TEXT]);

        $translations = $request->input('translation', []);

        foreach ($translations as $languageId => $translation) {
            if (empty($translation)) {
                continue;
            }

            \App\Models\Translation::query()->create([
                'language_id' => $languageId,
                'entry_id' => $entry->id,
                'translation' => $translation,
            ]);
        }

        IemsWp::update();

        return redirect()->route('home')->with('status', __('Entry created'));
    }

    public function sync()
    {
        IemsWp::update();

        return redirect()->back()->with('status', __('Synced'));
    }

    public function show($id)
    {
        //
    }

    public function edit(Entry $entry)
    {
        $languages = \App\Models\Language::all();

        return view('entry.edit', compact('entry', 'languages'));
    }

    public function update(UpdateEntryRequest $request, Entry $entry)
    {
        $entry->update($request->validated());

        $translations = $request->input('translation', []);

        foreach ($translations as $languageId => $translationValue) {
            if (empty($translationValue)) {
                // delete if exists
                \App\Models\Translation::query()->where('language_id', $languageId)->where('entry_id', $entry->id)->delete();
                continue;
            }

            $translation = \App\Models\Translation::query()->where('language_id', $languageId)->where('entry_id', $entry->id)->first();

            if ($translation) {
                $translation->update(['translation' => $translationValue]);
            } else {
                \App\Models\Translation::query()->create([
                    'language_id' => $languageId,
                    'entry_id' => $entry->id,
                    'translation' => $translationValue,
                ]);
            }
        }

        IemsWp::update();

        return redirect()->route('home')->with('status', __('Entry updated'));
    }

    public function destroy(Entry $entry)
    {
        $entry->delete();

        IemsWp::update();

        return redirect()->route('home')->with('status', __('Entry deleted'));
    }
}
