<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntryRequest;
use App\Http\Requests\UpdateEntryRequest;
use App\Models\Entry;
use App\Services\IemsWp;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type = 'text')
    {
        $languages = \App\Models\Language::all();
        $types = Entry::TYPES;

        if (!array_key_exists($type, $types)) {
            return abort(404);
        }

        return view('entry.create', compact('languages', 'type', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        $languages = \App\Models\Language::all();

        return view('entry.edit', compact('entry', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
